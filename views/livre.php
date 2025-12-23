<?php require_once __DIR__ . '/templates/header.php'; ?>





<h1>MON livre </h1>

<div>

        <article class="livre-carte">
            <h3><?php echo htmlspecialchars($livre['title']); ?></h3>
            <p><?php echo htmlspecialchars($livre['author']); ?></p>
            <p><?php echo htmlspecialchars($livre['description']); ?></p>
            

            <?php if (!empty($livre['image'])): ?>
                <img class="couverture-livre"
                    src="/projet4/public/images/<?php echo htmlspecialchars($livre['image']); ?>"
                    alt="Couverture du livre <?php echo htmlspecialchars($livre['title']); ?>"
                    style="max-width:150px;"
                >
            <?php else: ?>
                <p><em>Aucune image</em></p>
            <?php endif; ?>

            <p>Ajouté le <?php echo htmlspecialchars($livre['created_at']); ?></p>
              <p>Par <?php echo htmlspecialchars ($livre['owner_pseudo']); ?></p>
        </article>
    
</div>


<?php require_once __DIR__ . '/templates/footer.php';