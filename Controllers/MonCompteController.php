<?php

require_once __DIR__ . '/../models/BookManager.php';

class MonCompteController
{
    public function afficher(): void
    {
        $bookManager = new BookManager();

        // TEMPORAIRE pour tester avant les sessions :
        // plus tard on remplacera par l'id de l'utilisateur connecté via $_SESSION
        $idUtilisateur = 1;

        $livresUtilisateur = $bookManager->findByUserId($idUtilisateur);

        require_once __DIR__ . '/../views/mon_compte.php';
    }
}
