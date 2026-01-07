<?php


require_once __DIR__ . '/../models/BookManager.php';

class MonCompteController
{

    public function afficher(): void
{
    // Protection : si pas connecté -> retour connexion
    if (!isset($_SESSION['user_id'])) {
        header('Location: /projet4/public/?page=connexion');
        exit;
    }

    $bookManager = new BookManager();
    $idUtilisateur = $_SESSION['user_id'];

    $livresUtilisateur = $bookManager->findByUserId($idUtilisateur);

    require_once __DIR__ . '/../views/mon_compte.php';
}

}
