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

        <!-- Ligne-->
        <hr class="mon-compte-separateur">

        <p class="mon-compte-pseudo">nathalie</p>

        <p class="mon-compte-info">Membre depuis 1 an</p>

        <!-- Bloc BIBLIOTHÈQUE-->
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

    <!-- TABLEAU : MES LIVRES -->
<div class="mon-compte-tableau">

  <div class="mon-compte-tableau-entete">
    <div>Photo</div>
    <div>Titre</div>
    <div>Auteur</div>
    <div>Description</div>
    <div>Disponibilité</div>
    <div>Action</div>
  </div>

  <!-- Ligne 1 -->
  <div class="mon-compte-ligne">
    <div class="col-photo">
      <img src="/projet4/public/images/livre1.jpg" alt="Couverture du livre" class="mon-compte-livre-img">
    </div>

    <div class="col-texte">The Kinfolk Table</div>
    <div class="col-texte">Nathan Williams</div>

    <div class="col-description">
      J’ai récemment plongé dans les pages de “The Kinfolk Table” et j’ai été enchanté p...
    </div>

    <div class="col-statut">
      <span class="badge badge-disponible">disponible</span>
    </div>

    <div class="col-actions">
      <a href="#" class="action-editer">Éditer</a>
      <a href="#" class="action-supprimer">Supprimer</a>
    </div>
  </div>

  <!-- Ligne 2 -->
  <div class="mon-compte-ligne mon-compte-ligne-alt">
    <div class="col-photo">
      <img src="/projet4/public/images/livre2.jpg" alt="Couverture du livre" class="mon-compte-livre-img">
    </div>

    <div class="col-texte">The Kinfolk Table</div>
    <div class="col-texte">Nathan Williams</div>

    <div class="col-description">
      J’ai récemment plongé dans les pages de “The Kinfolk Table” et j’ai été enchanté p...
    </div>

    <div class="col-statut">
      <span class="badge badge-nondispo">non dispo.</span>
    </div>

    <div class="col-actions">
      <a href="#" class="action-editer">Éditer</a>
      <a href="#" class="action-supprimer">Supprimer</a>
    </div>
  </div>

  <!-- Tu peux dupliquer encore 2 lignes si tu veux comme la maquette -->

</div>


  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
