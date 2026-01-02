<?php

require_once __DIR__ . '/../services/UserService.php';

class ConnexionController
{
    public function afficher(): void
    {
        $erreurs = array();

        // Si le formulaire est envoyé (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 1) Récupérer les champs du formulaire
            $email = '';
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }

            $motdepasse = '';
            if (isset($_POST['motdepasse'])) {
                $motdepasse = $_POST['motdepasse'];
            }

            // 2) Appeler le service
            $userService = new UserService();
            $erreurs = $userService->connecterUtilisateur($email, $motdepasse);

            // 3) Si pas d’erreurs → ici, on redirige (la session viendra juste après)
            if (empty($erreurs)) {
                header('Location: /projet4/public/?page=accueil');
                exit;
            }
        }

        // 4) Afficher la vue (GET ou POST avec erreurs)
        require_once __DIR__ . '/../views/connexion.php';
    }
}
