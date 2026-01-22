<?php

class DeconnexionController
{
    public function deconnecter(): void
    {
        // Si une session existe, on la vide
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vider les variables de session
        $_SESSION = [];

        // Supprimer le cookie de session (optionnel mais propre)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Détruire la session
        session_destroy();

        // Redirection
        header('Location: /projet4/public/?page=accueil');
        exit;
    }
}
