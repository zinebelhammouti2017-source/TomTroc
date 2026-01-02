<?php

require_once __DIR__ . '/../services/UserService.php';

class InscriptionController
{
    public function afficher(): void
    {
        $erreurs = [];

        // Par défaut, les champs sont vides (utile pour GET et pour POST incomplet)
        $pseudo = '';
        $email = '';
        $motdepasse = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1) Récupération des champs du formulaire (en évitant les erreurs si absent)
            $pseudo = $this->recupererPost('pseudo');
            $email = $this->recupererPost('email');
            $motdepasse = $this->recupererPost('motdepasse');

            // 2) Logique métier
            $userService = new UserService();
            $erreurs = $userService->inscrireUtilisateur($pseudo, $email, $motdepasse);

            // 3) Redirection si OK
            if (empty($erreurs)) {
                header('Location: /projet4/public/?page=connexion');
                exit;
            }
        }

        // 4) Affichage de la vue
        require_once __DIR__ . '/../views/inscription.php';
    }

    /**
     * Récupère une valeur POST.
     * Si le champ n'existe pas, renvoie une chaîne vide.
     */
    private function recupererPost(string $nomChamp): string
    {
        if (isset($_POST[$nomChamp])) {
            return $_POST[$nomChamp];
        }
        return '';
    }
}
