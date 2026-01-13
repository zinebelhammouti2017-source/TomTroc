<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-editer-livre">
  <section class="bloc-formulaire">




    <a class="lien-retour" href="/projet4/public/?page=mon-compte">← retour</a>
    <h1>Modifier les informations</h1>

    <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0) { ?>
      <div class="message-erreur">
        <ul>
          <?php foreach ($erreurs as $erreur) { ?>
            <li><?php echo htmlspecialchars($erreur); ?></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>

    <div class="livre-form-layout">

      <!-- COLONNE GAUCHE : PHOTO -->
      <div class="livre-form-photo">
        <p class="livre-form-label">Photo</p>

        <div class="livre-form-photo-cadre">
          <?php
            // IMPORTANT : adapte le chemin si besoin
            // Si ton image en BDD est déjà un chemin (ex: "uploads/livres/xxx.jpg"), tu fais juste:
            // $srcImage = "/projet4/public/" . $valeurs['image'];
            $srcImage = "/projet4/public/images/" . $valeurs['image'];
          ?>
          <img
            class="livre-form-photo-img"
            src="<?php echo htmlspecialchars($srcImage); ?>"
            alt="Photo du livre"
          >
        </div>

        <!-- input file caché + label cliquable -->
        <input
          type="file"
          id="image"
          name="image"
          accept="image/*"
          class="livre-form-photo-input"
        >
        <label for="image" class="livre-form-photo-action">Modifier la photo</label>
      </div>

      <!-- COLONNE DROITE : FORM -->
      <div class="livre-form-champs">

        <form
          method="post"
          enctype="multipart/form-data"
          action="/projet4/public/?page=editer-livre&id=<?php echo (int) $idLivre; ?>"
          class="livre-form-formulaire"
        >
          <label for="title">Titre</label>
          <input id="title" name="title" type="text" value="<?php echo htmlspecialchars($valeurs['title']); ?>">

          <label for="author">Auteur</label>
          <input id="author" name="author" type="text" value="<?php echo htmlspecialchars($valeurs['author']); ?>">

          <label for="description">Commentaire</label>
          <textarea id="description" name="description"><?php echo htmlspecialchars($valeurs['description']); ?></textarea>

          <label for="status">Disponibilité</label>
          <select id="status" name="status">
            <option value="1" <?php if ((int)$valeurs['status'] === 1) { echo 'selected'; } ?>>Disponible</option>
            <option value="0" <?php if ((int)$valeurs['status'] === 0) { echo 'selected'; } ?>>Non disponible</option>
          </select>

          <button type="submit">Valider</button>
        </form>

      </div>

    </div>
  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
