<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-connexion">
  <section class="connexion-layout-full">
    <div class="connexion-layout">

      <div class="connexion-colonne">
        <h1 class="connexion-titre">Inscription</h1>

        <?php if (!empty($erreurs)): ?>
          <div class="message-erreur">
            <?php foreach ($erreurs as $erreur): ?>
              <p><?= htmlspecialchars($erreur) ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <form class="connexion-form" method="post" action="/projet4/public/?page=inscription">

          <label class="champ-label" for="pseudo">Pseudo</label>
          <input
            class="champ-input"
            type="text"
            id="pseudo"
            name="pseudo"
            required
            value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>"
            autocomplete="nickname"
          >

          <label class="champ-label" for="email">Adresse email</label>
          <input
            class="champ-input"
            type="email"
            id="email"
            name="email"
            required
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            autocomplete="email"
          >

          <label class="champ-label" for="motdepasse">Mot de passe</label>
          <input
            class="champ-input"
            type="password"
            id="motdepasse"
            name="motdepasse"
            required
            autocomplete="new-password"
          >

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
