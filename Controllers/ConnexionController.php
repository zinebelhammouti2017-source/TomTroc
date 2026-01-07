<?php

require_once __DIR__ . '/../services/UserService.php';

class ConnexionController
{
    public function afficher(): void
    {
        $erreurs = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = '';
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }

            $motdepasse = '';
            if (isset($_POST['motdepasse'])) {
                $motdepasse = $_POST['motdepasse'];
            }

            $userService = new UserService();
            $resultat = $userService->connecterUtilisateur($email, $motdepasse);

            $erreurs = $resultat['erreurs'];

            if (count($erreurs) === 0) {

                $utilisateur = $resultat['utilisateur'];

                // On met l'utilisateur dans la session
                $_SESSION['user_id'] = $utilisateur['id'];
                $_SESSION['pseudo'] = $utilisateur['pseudo'];
                $_SESSION['email'] = $utilisateur['email'];

                // Redirection
                header('Location: /projet4/public/?page=mon-compte');
                exit;
            }
        }

        require_once __DIR__ . '/../views/connexion.php';
    }
}
