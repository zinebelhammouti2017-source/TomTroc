<?php

require_once __DIR__ . '/../models/BookManager.php';
require_once __DIR__ . '/../services/UploadService.php';


class BookService
{
    private BookManager $bookManager;
    private UploadService $uploadService;

    public function __construct()

    {
    $this->bookManager = new BookManager();
    $this->uploadService = new UploadService();
    }

    public function creerLivre(
    int $idUtilisateur,
    string $titre,
    string $auteur,
    string $description,
    array $fichierImage,
    int $status
): array {
    $erreurs = [];

    $titre = trim($titre);
    $auteur = trim($auteur);
    $description = trim($description);

    if ($titre === '') $erreurs[] = "Le titre est obligatoire.";
    if ($auteur === '') $erreurs[] = "L'auteur est obligatoire.";
    if ($status !== 0 && $status !== 1) $erreurs[] = "Le statut du livre est invalide.";

    // image obligatoire à l'ajout
    if (!isset($fichierImage['name']) || $fichierImage['name'] === '') {
        $erreurs[] = "L'image est obligatoire.";
    }

    if (!empty($erreurs)) {
        return ['succes' => false, 'erreurs' => $erreurs];
    }

    // upload
    try {
        $cheminImage = $this->uploadService->televerserImageLivre($fichierImage);
    } catch (Exception $e) {
        return ['succes' => false, 'erreurs' => [$e->getMessage()]];
    }

    $ok = $this->bookManager->insererLivre(
        $idUtilisateur,
        $titre,
        $auteur,
        $description,
        $cheminImage,
        $status
    );

    return $ok
        ? ['succes' => true, 'erreurs' => []]
        : ['succes' => false, 'erreurs' => ["Une erreur est survenue lors de l'ajout du livre."]];
}

    
  public function modifierLivre(
    int $idLivre,
    int $idUtilisateur,
    string $titre,
    string $auteur,
    string $description,
    array $fichierImage,
    string $imageActuelle,
    int $status
): array {
    $erreurs = [];

    $titre = trim($titre);
    $auteur = trim($auteur);
    $description = trim($description);

    if ($idLivre <= 0) $erreurs[] = "Livre invalide.";
    if ($titre === '') $erreurs[] = "Le titre est obligatoire.";
    if ($auteur === '') $erreurs[] = "L'auteur est obligatoire.";
    if ($status !== 0 && $status !== 1) $erreurs[] = "Le statut est invalide.";

    if (!empty($erreurs)) {
        return ['succes' => false, 'erreurs' => $erreurs];
    }

    // par défaut : on garde l'image actuelle
    $cheminImage = $imageActuelle;

    // si nouveau fichier => upload
    if (isset($fichierImage['name']) && $fichierImage['name'] !== '') {
        try {
            $cheminImage = $this->uploadService->televerserImageLivre($fichierImage);
        } catch (Exception $e) {
            return ['succes' => false, 'erreurs' => [$e->getMessage()]];
        }
    }

    $ok = $this->bookManager->mettreAJourLivre(
        $idLivre,
        $idUtilisateur,
        $titre,
        $auteur,
        $description,
        $cheminImage,
        $status
    );

    return $ok
        ? ['succes' => true, 'erreurs' => []]
        : ['succes' => false, 'erreurs' => ["Erreur lors de la modification du livre."]];
}




}
