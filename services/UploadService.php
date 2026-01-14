<?php

class UploadService
{
    private string $dossierUploadAbsolu;
    private string $dossierUploadRelatif;

    public function __construct()
    {
        // dossier réel sur le disque
        $this->dossierUploadAbsolu = __DIR__ . '/../public/uploads/livres/';

        // chemin qu’on stocke en BDD (et qu’on met dans <img src="">)
        $this->dossierUploadRelatif = 'uploads/livres/';
    }

    /**
     * Traite l'upload d'une image de livre.
     * Retour : chemin relatif à stocker en BDD (ex: uploads/livres/abc.jpg)
     * Lance une Exception si erreur (le contrôleur/service transformera en message utilisateur).
     */
    public function televerserImageLivre(array $fichier): string
    {
        // 1) erreurs PHP
        if (!isset($fichier['error']) || $fichier['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur lors du téléchargement de l'image.");
        }

        // 2) taille max (2 Mo)
        $tailleMax = 5 * 1024 * 1024;
        if (!isset($fichier['size']) || (int)$fichier['size'] > $tailleMax) {
            throw new Exception("L'image est trop lourde (max 5 Mo).");
        }

        // 3) vérifier que c’est un vrai fichier uploadé
        if (!isset($fichier['tmp_name']) || !is_uploaded_file($fichier['tmp_name'])) {
            throw new Exception("Fichier invalide.");
        }

        // 4) vérifier le type MIME (plus fiable que l'extension)
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($fichier['tmp_name']);

        $mimesAutorises = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];

        if (!isset($mimesAutorises[$mime])) {
            throw new Exception("Format d'image non autorisé (jpg, png, webp).");
        }

        $extension = $mimesAutorises[$mime];

        // 5) créer le dossier si besoin
        if (!is_dir($this->dossierUploadAbsolu)) {
            mkdir($this->dossierUploadAbsolu, 0775, true);
        }

        // 6) nom unique
        $nomFichier = bin2hex(random_bytes(16)) . '.' . $extension;

        // 7) déplacer le fichier
        $cheminAbsolu = $this->dossierUploadAbsolu . $nomFichier;
        if (!move_uploaded_file($fichier['tmp_name'], $cheminAbsolu)) {
            throw new Exception("Impossible d'enregistrer l'image sur le serveur.");
        }

        // 8) chemin relatif à stocker en BDD
        return $this->dossierUploadRelatif . $nomFichier;
    }
}
