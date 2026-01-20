<?php
require_once __DIR__ . '/../models/BookManager.php';

class LivreController
{
    public function afficherLivre(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $bookManager = new BookManager();
        $livre = $bookManager->findOneById($id);

        if ($livre === null) {
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        require_once __DIR__ . '/../views/livre.php';
    }
}
