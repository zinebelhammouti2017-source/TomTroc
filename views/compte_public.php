<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-compte-public">
  <section class="compte-public-layout">

    <div class="compte-public-col-gauche">
      <div class="compte-public-carte-profil">

         <img
          src="/projet4/public/images/imgProfil.png"
          alt="Photo de profil"
          class="mon-compte-avatar"
        >

        <a href="#" class="mon-compte-modifier">modifier</a>


        <hr class="compte-public-separateur">

        <h1 class="compte-public-pseudo"><?php echo htmlspecialchars($utilisateur['pseudo']); ?></h1>
        <p class="compte-public-membre">Membre depuis 1 an</p>

        <p class="compte-public-biblio">
          <span class="compte-public-biblio-label">BIBLIOTHÈQUE</span><br>
          <?php echo count($livres); ?> livre(s)
        </p>

        <a class="bouton bouton-principal compte-public-bouton"
           href="/projet4/public/?page=demarrer-conversation&user_id=<?php echo (int)$utilisateur['id']; ?>">
          Écrire un message
        </a>
      </div>
    </div>

    <div class="compte-public-col-droite">
      <div class="compte-public-tableau">

        <div class="compte-public-entete">
          <div>Photo</div>
          <div>Titre</div>
          <div>Auteur</div>
          <div>Description</div>
        </div>

        <?php if (!empty($livres)) : ?>
          <?php foreach ($livres as $livre) : ?>
            <a class="compte-public-ligne"
               href="/projet4/public/?page=livre&id=<?php echo (int)$livre['id']; ?>">

              <div class="compte-public-cell photo">
                <?php if (!empty($livre['image'])) : ?>
                  <img src="/projet4/public/<?php echo htmlspecialchars($livre['image']); ?>" alt="">
                <?php endif; ?>
              </div>

              <div class="compte-public-cell"><?php echo htmlspecialchars($livre['title']); ?></div>
              <div class="compte-public-cell"><?php echo htmlspecialchars($livre['author']); ?></div>
              <div class="compte-public-cell description">
                <?php echo htmlspecialchars(mb_strimwidth($livre['description'] ?? '', 0, 120, '…')); ?>
              </div>

            </a>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Aucun livre.</p>
        <?php endif; ?>

      </div>
    </div>

  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
