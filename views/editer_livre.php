<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-editer-livre">
    <section class="bloc-formulaire">

        <h1>Éditer un livre</h1>

        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0) { ?>
            <div class="message-erreur">
                <ul>
                    <?php foreach ($erreurs as $erreur) { ?>
                        <li><?php echo htmlspecialchars($erreur); ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <form method="post" action="/projet4/public/?page=editer-livre&id=<?php echo (int) $idLivre; ?>">

            <label for="title">Titre</label>
            <input id="title" name="title" type="text" value="<?php echo htmlspecialchars($valeurs['title']); ?>">

            <label for="author">Auteur</label>
            <input id="author" name="author" type="text" value="<?php echo htmlspecialchars($valeurs['author']); ?>">

            <label for="description">Description</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($valeurs['description']); ?></textarea>

            <label for="image">Image (nom du fichier dans /public/images)</label>
            <input id="image" name="image" type="text" value="<?php echo htmlspecialchars($valeurs['image']); ?>">

            <label for="status">Disponibilité</label>
            <select id="status" name="status">
                <option value="1" <?php if ((int)$valeurs['status'] === 1) { echo 'selected'; } ?>>Disponible</option>
                <option value="0" <?php if ((int)$valeurs['status'] === 0) { echo 'selected'; } ?>>Non disponible</option>
            </select>

            <button type="submit">Enregistrer</button>
        </form>

    </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
