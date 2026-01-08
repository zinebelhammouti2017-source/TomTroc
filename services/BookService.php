<?php

require_once __DIR__ . '/../models/BookManager.php';

class BookService
{
    private BookManager $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
    }

    public function creerLivre(int $idUtilisateur, string $titre, string $auteur, string $description, string $image, int $status): array
    {
        $erreurs = [];

        $titre = trim($titre);
        $auteur = trim($auteur);
        $description = trim($description);
        $image = trim($image);

        if ($titre === '') {
            $erreurs[] = "Le titre est obligatoire.";
        }

        if ($auteur === '') {
            $erreurs[] = "L'auteur est obligatoire.";
        }

        if ($image === '') {
            $erreurs[] = "L'image est obligatoire.";
        }

        if ($status !== 0 && $status !== 1) {
            $erreurs[] = "Le statut du livre est invalide.";
        }

        if (count($erreurs) > 0) {
            return array(
                'succes' => false,
                'erreurs' => $erreurs
            );
        }

        $ok = $this->bookManager->insererLivre(
            $idUtilisateur,
            $titre,
            $auteur,
            $description,
            $image,
            $status
        );

        if ($ok) {
            return array(
                'succes' => true,
                'erreurs' => []
            );
        }

        return array(
            'succes' => false,
            'erreurs' => ["Une erreur est survenue lors de l'ajout du livre."]
        );
    }
}
