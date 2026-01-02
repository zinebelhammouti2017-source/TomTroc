<?php

require_once __DIR__ . '/../models/UserManager.php';

class UserService
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    /**
     * Retourne un tableau d'erreurs (vide si OK)
     */
    public function inscrireUtilisateur(string $pseudo, string $email, string $motdepasse): array
    {
        $erreurs = [];

        $pseudo = trim($pseudo);
        $email = trim($email);

        if ($pseudo === '' || mb_strlen($pseudo) < 3) {
            $erreurs[] = "Le pseudo doit contenir au moins 3 caractères.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "Adresse email invalide.";
        }

        if (mb_strlen($motdepasse) < 8) {
            $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }


        if (empty($erreurs) && $this->userManager->emailExiste($email)) {
            $erreurs[] = "Cet email est déjà utilisé.";
        }

        if (empty($erreurs) && $this->userManager->pseudoExiste($pseudo)) {
            $erreurs[] = "Ce pseudo est déjà utilisé.";
        }

        if (!empty($erreurs)) {
            return $erreurs;
        }

        $motDePasseHash = password_hash($motdepasse, PASSWORD_DEFAULT);

        $ok = $this->userManager->creerUtilisateur($pseudo, $email, $motDePasseHash);
        if (!$ok) {
            $erreurs[] = "Erreur lors de l’inscription. Merci de réessayer.";
        }

        return $erreurs;
    }
}
