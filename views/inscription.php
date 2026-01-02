<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-connexion">
  <section class="connexion-layout-full">
    <div class="connexion-layout">

      <div class="connexion-colonne">
        <h1 class="connexion-titre">Inscription</h1>

        <form class="connexion-form" method="post" action="#">
          <label class="champ-label" for="pseudo">Pseudo</label>
          <input class="champ-input" type="text" id="pseudo" name="pseudo" required>

          <label class="champ-label" for="email">Adresse email</label>
          <input class="champ-input" type="email" id="email" name="email" required>

          <label class="champ-label" for="motdepasse">Mot de passe</label>
          <input class="champ-input" type="password" id="motdepasse" name="motdepasse" required>

          <button class="bouton bouton-principal bouton-plein" type="submit">
            S’inscrire
          </button>

          <p class="connexion-texte">
            Déjà inscrit ?
            <a class="connexion-lien" href="/projet4/public/?page=connexion">Connectez-vous</a>
          </p>
        </form>
      </div>

      <div class="connexion-image">
        <img src="/projet4/public/images/connexion.png" alt="Bibliothèque">
      </div>

    </div>
  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
