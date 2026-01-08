<?php

require_once __DIR__ . '/../services/MonCompteService.php';

class MonCompteController
{
    public function afficher(): void
    {
        // 1) Protection : si pas connecté -> connexion
        if (!isset($_SESSION['user_id'])) {
            header('Location: /projet4/public/?page=connexion');
            exit;
        }

        // 2) Récupérer l'id utilisateur depuis la session
        $userId = (int) $_SESSION['user_id'];

        // 3) Appeler le service
        $service = new MonCompteService();
        $donnees = $service->recupererDonneesMonCompte($userId);

        // 4) Variables envoyées à la vue
        $utilisateur = $donnees['utilisateur'];
        $livresUtilisateur = $donnees['livresUtilisateur'];
        $nombreLivres = $donnees['nombreLivres'];

        // 5) Afficher la vue
        require_once __DIR__ . '/../views/mon_compte.php';
    }
}
