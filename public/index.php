<?php
session_start();

require_once __DIR__ . '/../Controllers/AccueilController.php';
require_once __DIR__ . '/../Controllers/LivreController.php';
require_once __DIR__ . '/../Controllers/LivresController.php';
require_once __DIR__ . '/../Controllers/ConnexionController.php';
require_once __DIR__ . '/../Controllers/InscriptionController.php';
require_once __DIR__ . '/../Controllers/MonCompteController.php';
require_once __DIR__ . '/../Controllers/GestionLivreController.php';

$page = $_GET['page'] ?? 'accueil';

switch ($page) {
    case 'accueil':
        $controller = new AccueilController();
        $controller->afficher();
        break;

    case 'livre':
        $controller = new LivreController();
        $controller->afficherLivre();
        break;

    case 'livres':
        $controller = new LivresController();
        $controller->afficherLivres();
        break;

    case 'connexion':
        $controller = new ConnexionController();
        $controller->afficher();
        break;

    case 'inscription':
        $controller = new InscriptionController();
        $controller->afficher();
        break;

    case 'mon-compte':
        $controller = new MonCompteController();
        $controller->afficher();
        break;

    case 'ajouter-livre':
        $controller = new GestionLivreController();
        $controller->ajouter();
        break;

    case 'editer-livre':
        $controller = new GestionLivreController();
        $controller->editer();
        break;

    case 'supprimer-livre':
        $controller = new GestionLivreController();
        $controller->supprimer();
        break;

    case 'changer-disponibilite':
        $controller = new GestionLivreController();
        $controller->changerDisponibilite();
        break;

    default:
        echo "Page non trouvée";
        break;
}
