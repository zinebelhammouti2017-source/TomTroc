<?php
require_once __DIR__ . '/../models/BookManager.php';

class LivresController
{
    public function afficherLivres(): void
    {
        $recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';

        $bookManager = new BookManager();

        if ($recherche === '') {
            $livres = $bookManager->findAll();
        } else {
            $livres = $bookManager->findByRecherche($recherche);
        }

        require_once __DIR__ . '/../views/livres.php';
    }
}
