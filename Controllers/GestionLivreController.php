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

    public function editer(): void
{
    // 1) Protection : connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: /projet4/public/?page=connexion');
        exit;
    }

    $idUtilisateur = (int) $_SESSION['user_id'];

    // 2) Récupérer l'id du livre
    $idLivre = 0;
    if (isset($_GET['id'])) {
        $idLivre = (int) $_GET['id'];
    }

    if ($idLivre <= 0) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    // 3) Charger le livre (pour pré-remplir)
    require_once __DIR__ . '/../models/BookManager.php';
    $bookManager = new BookManager();
    $livre = $bookManager->findOneById($idLivre);

    if ($livre === null) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    // 4) Sécurité : seul le propriétaire
    if ((int) $livre['owner_id'] !== $idUtilisateur) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    // 5) Valeurs pour la vue
    $erreurs = [];
    $valeurs = array(
        'title' => $livre['title'] ?? '',
        'author' => $livre['author'] ?? '',
        'description' => $livre['description'] ?? '',
        'image' => $livre['image'] ?? '',
        'status' => isset($livre['status']) ? (int) $livre['status'] : 1
    );

    // 6) Si POST : enregistrer les modifications
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valeurs['title'] = $_POST['title'] ?? '';
        $valeurs['author'] = $_POST['author'] ?? '';
        $valeurs['description'] = $_POST['description'] ?? '';
        $valeurs['image'] = $_POST['image'] ?? '';
        $valeurs['status'] = isset($_POST['status']) ? (int) $_POST['status'] : 1;

        require_once __DIR__ . '/../services/BookService.php';
        $service = new BookService();

        $resultat = $service->modifierLivre(
            $idLivre,
            $idUtilisateur,
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

    // 7) Afficher la vue
    require_once __DIR__ . '/../views/editer_livre.php';
}

public function supprimer(): void
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: /projet4/public/?page=connexion');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    $idLivre = 0;
    if (isset($_POST['id_livre'])) {
        $idLivre = (int) $_POST['id_livre'];
    }

    if ($idLivre <= 0) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    $idUtilisateur = (int) $_SESSION['user_id'];

    // Sécurité : vérifier propriétaire via findOneById
    require_once __DIR__ . '/../models/BookManager.php';
    $bookManager = new BookManager();
    $livre = $bookManager->findOneById($idLivre);

    if ($livre === null) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    if ((int) $livre['owner_id'] !== $idUtilisateur) {
        header('Location: /projet4/public/?page=mon-compte');
        exit;
    }

    // Action : soft delete
    $ok = $bookManager->supprimerLivre($idLivre, $idUtilisateur);

    header('Location: /projet4/public/?page=mon-compte');
    exit;
}


}
