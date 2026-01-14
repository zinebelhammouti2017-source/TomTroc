<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-ajouter-livre">
  <section class="bloc-formulaire">

    <a class="lien-retour" href="/projet4/public/?page=mon-compte">← retour</a>
    <h1>Ajouter un livre</h1>

    <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0) { ?>
      <div class="message-erreur">
        <ul>
          <?php foreach ($erreurs as $erreur) { ?>
            <li><?php echo htmlspecialchars($erreur); ?></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>

    <!-- ✅ UN SEUL FORM qui englobe PHOTO + CHAMPS -->
    <form
      method="post"
      enctype="multipart/form-data"
      action="/projet4/public/?page=ajouter-livre"
      class="livre-form-layout"
    >
      <!-- COLONNE GAUCHE : PHOTO (placeholder) -->
      <div class="livre-form-photo">
        <p class="livre-form-label">Photo</p>

        <div class="livre-form-photo-cadre">
          <div class="livre-form-photo-placeholder">Aucune photo</div>
        </div>

        <input
          type="file"
          id="image"
          name="image"
          accept="image/*"
          class="livre-form-photo-input"
        >
        <label for="image" class="livre-form-photo-action">Ajouter la photo</label>
      </div>

      <!-- COLONNE DROITE : CHAMPS -->
      <div class="livre-form-champs livre-form-formulaire">
        <label for="title">Titre</label>
        <input id="title" name="title" type="text" value="<?php echo htmlspecialchars($valeurs['title'] ?? ''); ?>">

        <label for="author">Auteur</label>
        <input id="author" name="author" type="text" value="<?php echo htmlspecialchars($valeurs['author'] ?? ''); ?>">

        <label for="description">Description</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($valeurs['description'] ?? ''); ?></textarea>

        <label for="status">Disponibilité</label>
        <select id="status" name="status">
          <option value="1" <?php if ((int)($valeurs['status'] ?? 1) === 1) { echo 'selected'; } ?>>Disponible</option>
          <option value="0" <?php if ((int)($valeurs['status'] ?? 1) === 0) { echo 'selected'; } ?>>Non disponible</option>
        </select>

        <button type="submit">Ajouter</button>
      </div>

    </form>

  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
