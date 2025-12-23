<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-livre">
  <section class="livre-layout">

    <div class="livre-image">
  <?php if (!empty($livre['image'])) : ?>
    <img
      class="livre-image-img"
      src="/projet4/public/images/<?= htmlspecialchars($livre['image']) ?>"
      alt="Couverture du livre <?= htmlspecialchars($livre['title']) ?>"
    >
  <?php else : ?>
    <p class="livre-image-absente">Aucune image</p>
  <?php endif; ?>
</div>


    <!-- Colonne droite : contenu -->
    <div class="livre-contenu">

      <h1 class="livre-titre"><?= htmlspecialchars($livre['title']) ?></h1>
      <p class="livre-auteur">par <?= htmlspecialchars($livre['author']) ?></p>

      <hr class="livre-separateur">

      <h2 class="livre-sous-titre">Description</h2>
      <p class="livre-description">
        <?= nl2br(htmlspecialchars($livre['description'])) ?>
      </p>

      <div class="livre-proprietaire">
        <p class="livre-proprietaire-label">Proposé par</p>

        <div class="livre-proprietaire-carte">
          <div class="livre-avatar" aria-hidden="true"></div>
          <span class="livre-pseudo"><?= htmlspecialchars($livre['owner_pseudo']) ?></span>
        </div>
      </div>

      <a class="bouton bouton-principal" href="#">
        Envoyer un message
      </a>

    </div>
  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
