<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-mon-compte">
  <section class="mon-compte-layout">

    <h1 class="mon-compte-titre">Mon compte</h1>

    <div class="mon-compte-blocs">

      <!-- BLOC PROFIL -->
      <div class="mon-compte-profil">

        <img
          src="/projet4/public/images/imgProfil.png"
          alt="Photo de profil"
          class="mon-compte-avatar"
        >

        <a href="#" class="mon-compte-modifier">modifier</a>

        <!-- Ligne comme la maquette -->
        <hr class="mon-compte-separateur">

        <p class="mon-compte-pseudo">nathalie</p>

        <p class="mon-compte-info">Membre depuis 1 an</p>

        <!-- Bloc BIBLIOTHÈQUE comme la maquette -->
        <div class="mon-compte-biblio">
          <p class="mon-compte-biblio-titre">BIBLIOTHÈQUE</p>

          <div class="mon-compte-biblio-ligne">
            <span class="mon-compte-biblio-icone">📚</span>
            <span class="mon-compte-biblio-nombre">4 livres</span>
          </div>
        </div>

      </div>

      <!-- BLOC INFOS PERSONNELLES -->
      <div class="mon-compte-infos">

        <h2 class="mon-compte-sous-titre">Vos informations personnelles</h2>

        <label class="champ-label" for="email">Adresse email</label>
        <input class="champ-input" id="email" type="email" value="nathalie@email.com" disabled>

        <label class="champ-label" for="motdepasse">Mot de passe</label>
        <input class="champ-input" id="motdepasse" type="password" value="********" disabled>

        <label class="champ-label" for="pseudo">Pseudo</label>
        <input class="champ-input" id="pseudo" type="text" value="nathalie">

        <button class="bouton bouton-principal bouton-plein" type="button">
          Enregistrer
        </button>

      </div>

    </div>

  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
