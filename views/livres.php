<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-livres">
  <section class="livres-section">

    <!-- ENTÊTE : titre + barre de recherche -->
    <div class="livres-entete">
      <h1>Nos livres à l'échange</h1>

      <form class="recherche-form" method="get" action="/projet4/public/">
        <input type="hidden" name="page" value="livres">

        <input
          class="recherche-input"
          type="search"
          name="recherche"
          placeholder="Rechercher un livre"
          value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>"
        >
      </form>
    </div>

    <?php if (empty($livres)) : ?>
      <p>Aucun livre disponible pour le moment.</p>
     <p><a class="lien-voir-tous" href="/projet4/public/?page=livres">Voir tous les livres</a></p>


    <?php else : ?>
      <div class="livres-grille">
        <?php foreach ($livres as $livre) : ?>
          <article class="livre-carte">
            <?php if (!empty($livre['image'])) : ?>
              <img
                src="/projet4/public/<?= htmlspecialchars($livre['image']) ?>"
                  
                alt="Couverture du livre <?= htmlspecialchars($livre['title']) ?>"
              >
            <?php endif; ?>

            <h3><?= htmlspecialchars($livre['title']) ?></h3>
            <p><?= htmlspecialchars($livre['author']) ?></p>
            <p class="livre-pseudo">Vendu par : <?= htmlspecialchars($livre['owner_pseudo']) ?></p>

            <a href="/projet4/public/?page=livre&id=<?= (int) $livre['id'] ?>">
              Voir le livre
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
