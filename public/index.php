<?php
require_once __DIR__ . '/../Controllers/AccueilController.php';
require_once __DIR__ . '/../Controllers/LivreController.php';
require_once __DIR__ . '/../Controllers/LivresController.php';
require_once __DIR__ . '/../Controllers/ConnexionController.php';
require_once __DIR__ . '/../Controllers/InscriptionController.php';


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

    

  default:
    echo "Page non trouvée";
}
