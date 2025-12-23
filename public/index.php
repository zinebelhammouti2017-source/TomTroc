
<?php
require_once '../Controllers/AccueilController.php';
require_once '../Controllers/LivreController.php';



// 1. Récupérer la page demandée
$page = $_GET['page'] ?? 'accueil';

// 2. Router vers la bonne page
switch ($page) {
    case 'accueil':
        $controller = new AcceuilController ();
        $controller-> afficher();

        break;
         case 'livre':
        $controller = new LivreController ();
        $controller-> afficherLivre();

        break;

    

    default:
        echo "Page non trouvée";
}
