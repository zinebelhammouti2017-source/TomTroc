<?php

require_once __DIR__ . '/../models/UserManager.php';
require_once __DIR__ . '/../models/BookManager.php';

class ComptePublicController
{
    public function afficher(): void
    {
        $idUtilisateur = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($idUtilisateur <= 0) {
            header('Location: /projet4/public/');
            exit;
        }

        $userManager = new UserManager();
        $bookManager = new BookManager();

        // ✅ ta méthode s'appelle trouverParId
        $utilisateur = $userManager->trouverParId($idUtilisateur);
        if ($utilisateur === null) {
            // si tu as une vraie route 404, tu peux y rediriger
            header('Location: /projet4/public/?page=404');
            exit;
        }

        // Livres de l'utilisateur
        $livres = $bookManager->findByUserId($idUtilisateur);

        require_once __DIR__ . '/../views/compte_public.php';
    }
}
