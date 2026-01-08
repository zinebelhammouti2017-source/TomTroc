<?php

require_once __DIR__ . '/../services/BookService.php';

class GestionLivreController
{
    public function ajouter(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /projet4/public/?page=connexion');
            exit;
        }

        $erreurs = [];
        $valeurs = array(
            'title' => '',
            'author' => '',
            'description' => '',
            'image' => '',
            'status' => 1
        );

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $valeurs['title'] = $_POST['title'] ?? '';
            $valeurs['author'] = $_POST['author'] ?? '';
            $valeurs['description'] = $_POST['description'] ?? '';
            $valeurs['image'] = $_POST['image'] ?? '';
            $valeurs['status'] = isset($_POST['status']) ? (int) $_POST['status'] : 1;

            $service = new BookService();
            $resultat = $service->creerLivre(
                (int) $_SESSION['user_id'],
                $valeurs['title'],
                $valeurs['author'],
                $valeurs['description'],
                $valeurs['image'],
                $valeurs['status']
            );

            if ($resultat['succes'] === true) {
                header('Location: /projet4/public/?page=mon-compte');
                exit;
            }

            $erreurs = $resultat['erreurs'];
        }

        require_once __DIR__ . '/../views/ajouter_livre.php';
    }
}
