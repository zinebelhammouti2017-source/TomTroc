<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TomTroc</title>
  <link rel="stylesheet" href="/projet4/public/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="site-header-contenu">

    <a class="site-logo" href="/projet4/public/?page=accueil" aria-label="Retour à l'accueil">
      <span class="site-logo-badge">Tt</span>
      <span class="site-logo-texte">Tom Troc</span>
    </a>

    <nav class="site-nav">
      <a class="site-nav-lien" href="/projet4/public/?page=accueil">Accueil</a>
      <a class="site-nav-lien" href="/projet4/public/?page=livres">Nos livres à l’échange</a>
    </nav>

    <nav class="site-nav-droite">
      <a class="site-nav-lien" href="/projet4/public/?page=messagerie">Messagerie</a>
      <a class="site-nav-lien" href="/projet4/public/?page=mon-compte">Mon compte</a>

      <?php if (isset($_SESSION['utilisateur'])): ?>
        <a class="site-nav-lien" href="/projet4/public/?page=deconnexion">Déconnexion</a>
      <?php else: ?>
        <a class="site-nav-lien" href="/projet4/public/?page=connexion">Connexion</a>
      <?php endif; ?>
    </nav>

  </div>
</header>
