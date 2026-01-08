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

        <p class="mon-compte-pseudo">
          <?php
          if (isset($_SESSION['pseudo'])) {
              echo htmlspecialchars($_SESSION['pseudo']);
             }
          ?>
       </p>


        <p class="mon-compte-info">Membre depuis 1 an</p>

        <!-- Bloc BIBLIOTHÈQUE-->
        <div class="mon-compte-biblio">
          <p class="mon-compte-biblio-titre">BIBLIOTHÈQUE</p>

          <div class="mon-compte-biblio-ligne">
            <span class="mon-compte-biblio-icone">📚</span>
           <span class="mon-compte-biblio-nombre">
             <?php
              $nombreLivres = 0;
              if (isset($livresUtilisateur) && is_array($livresUtilisateur)) {
              $nombreLivres = count($livresUtilisateur);
            }

              echo $nombreLivres . " livres";
              ?>
           </span>
          </div>
        </div>

      </div>

      <!-- BLOC INFOS PERSONNELLES -->
      <div class="mon-compte-infos">

        <h2 class="mon-compte-sous-titre">Vos informations personnelles</h2>

        <label class="champ-label" for="email">Adresse email</label>
         
        <?php
         $valEmail = '';
         if (isset($_SESSION['email'])) {
         $valEmail = htmlspecialchars($_SESSION['email']);
         }
        ?>
        <input class="champ-input" id="email" type="email" value="<?php echo $valEmail; ?>" disabled>  


        <label class="champ-label" for="motdepasse">Mot de passe</label>
        <input class="champ-input" id="motdepasse" type="password" value="********" disabled>

        <label class="champ-label" for="pseudo">Pseudo</label>
        <?php
         $valPseudo = '';
         if (isset($_SESSION['pseudo'])) {
         $valPseudo = htmlspecialchars($_SESSION['pseudo']);
         }
        ?>
        <input class="champ-input" id="pseudo" type="text" value="<?php echo $valPseudo; ?>">


        <button class="bouton bouton-principal bouton-plein" type="button">
          Enregistrer
        </button>

      </div>

    </div>

    <!-- TABLEAU : MES LIVRES -->
<div class="mon-compte-tableau">
  <a class="bouton" href="/projet4/public/?page=ajouter-livre">Ajouter un livre</a>


  <div class="mon-compte-tableau-entete">
    <div>Photo</div>
    <div>Titre</div>
    <div>Auteur</div>
    <div>Description</div>
    <div>Disponibilité</div>
    <div>Action</div>
  </div>
<?php
$indexLigne = 0;

if (isset($livresUtilisateur) && is_array($livresUtilisateur) && count($livresUtilisateur) > 0) {

  foreach ($livresUtilisateur as $livre) {

?>
    <div class="mon-compte-ligne">
      <div class="col-photo">
        <img
          src="/projet4/public/images/<?php echo htmlspecialchars($livre['image']); ?>"
          alt="Couverture du livre"
          class="mon-compte-livre-img"
        >
      </div>

      <div class="col-texte"><?php echo htmlspecialchars($livre['title']); ?></div>
      <div class="col-texte"><?php echo htmlspecialchars($livre['author']); ?></div>

      <div class="col-description">
      <?php
       $description = '';
       if (isset($livre['description'])) {
      $description = $livre['description'];
      }

  echo htmlspecialchars($description);
  ?>
</div>


   <div class="col-statut">
  <form method="post" action="/projet4/public/?page=changer-disponibilite">
    <input type="hidden" name="id_livre" value="<?php echo (int) $livre['id']; ?>">

    <select name="status">
      <option value="1" <?php if ((int)$livre['status'] === 1) { echo 'selected'; } ?>>Disponible</option>
      <option value="0" <?php if ((int)$livre['status'] === 0) { echo 'selected'; } ?>>Non disponible</option>
    </select>

    <button type="submit">OK</button>
  </form>
</div>


      <div class="col-actions">
       <a href="/projet4/public/?page=editer-livre&id=<?php echo (int) $livre['id']; ?>" class="action-editer">Éditer</a>

        <form method="post" action="/projet4/public/?page=supprimer-livre" style="display:inline;">
         <input type="hidden" name="id_livre" value="<?php echo (int) $livre['id']; ?>">
         <button type="submit" class="action-supprimer" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
        </form>

      </div>
    </div>
<?php
    $indexLigne++;
  }

} else {
?>
  <div style="padding: 18px 24px; color:#666;">
    Vous n’avez encore aucun livre dans votre bibliothèque.
  </div>
<?php
}
?>


</div>


  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
