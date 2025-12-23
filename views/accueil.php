<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1>Accueil</h1>
<p>Bienvenue sur TomTroc</p>


<h2>Derniers livres disponibles</h2>


<div>
    <?php foreach ($livres as $livre): ?>
        <article class="livre-carte">
            <h3><?php echo htmlspecialchars($livre['title']); ?></h3>
            <p><?php echo htmlspecialchars($livre['author']); ?></p>

            <?php if (!empty($livre['image'])): ?>
                <img class="couverture-livre"
                    src="/projet4/public/images/<?php echo htmlspecialchars($livre['image']); ?>"
                    alt="Couverture du livre <?php echo htmlspecialchars($livre['title']); ?>"
                    style="max-width:150px;"
                >
            <?php else: ?>
                <p><em>Aucune image</em></p>
            <?php endif; ?>

            <p>
                <a href="/projet4/public/?page=livre&id=<?php echo (int) $livre['id']; ?>">
                    Voir le livre
                </a>
            </p>
        </article>
    <?php endforeach; ?>
</div>


<?php require_once __DIR__ . '/templates/footer.php';
// Le __DIR__ est important : il garantit que le chemin marche même quand la vue est appelée depuis un contrôleur.
?> 
