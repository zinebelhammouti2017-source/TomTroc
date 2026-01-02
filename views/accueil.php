<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-accueil">

  <!-- 1) HERO (statique) -->
  <section class="accueil-hero">
    <div class="hero-contenu">
      <h1>Rejoignez nos lecteurs passionnés</h1>
      <p>
        Donnez une nouvelle vie à vos livres en les échangeant avec d’autres amoureux de la lecture.
        Nous croyons en la magie du partage de connaissances et d’histoires à travers les livres.
      </p>

      <a class="bouton bouton-principal" href="#derniers-livres">
        Découvrir
      </a>
    </div>

    <div class="hero-image">
      <img src="/projet4/public/images/accueil.jpg" alt="Pile de livres">
    </div>
  </section>

  <!-- 2) DERNIERS LIVRES (dynamique) -->
  <section class="accueil-derniers-livres" id="derniers-livres" >
    <h2>Les derniers livres ajoutés</h2>

    <div class="livres-grille">
      <?php foreach ($livres as $livre): ?>
        <article class="livre-carte">
          <?php if (!empty($livre['image'])): ?>
            <img
              class="couverture-livre"
              src="/projet4/public/images/<?= htmlspecialchars($livre['image']) ?>"
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

    <a class="bouton bouton-principal" href="/projet4/public/?page=livres">
      Voir tous les livres
    </a>

  </section>

  <!-- 3) COMMENT ÇA MARCHE (statique) -->
<section class="accueil-fonctionnement">
  <h2>Comment ça marche ?</h2>
  <p class="accueil-fonctionnement-texte">
    Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
  </p>

  <div class="fonctionnement-grille">
    <article class="fonctionnement-carte">
      <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
    </article>

    <article class="fonctionnement-carte">
      <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
    </article>

    <article class="fonctionnement-carte">
      <p>Parcourez les livres disponibles chez d'autres membres.</p>
    </article>

    <article class="fonctionnement-carte">
      <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
    </article>
  </div>

  <a class="bouton bouton-secondaire" href="/projet4/public/?page=livres">
    Voir tous les livres
  </a>
</section>


  <!-- 4) NOS VALEURS (statique) -->
  <section class="accueil-valeurs">
    <div class="valeurs-image">
      <img src="/projet4/public/images/bas.jpg" alt="Bibliothèque">
    </div>

    <div class="valeurs-contenu">
      <h2>Nos valeurs</h2>
      <p>
       Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. 
       Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs.
        Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br>

       Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.<br> 

       Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter,
       de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.<br></p>
       <p class="valeurs-signature">L’équipe Tom Troc</p>
        <div class="valeurs-coeur" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="122" height="104" viewBox="0 0 122 104" fill="none">
        <path d="M1 96.2239C2.29696 95.8231 6.2879 96.4857 7.64535 96.4799C34.2391 96.3671 77.2911 74.6938 96.4064 56.0077C109.127 40.7678 119.928 7.80676 85.8057 2.24498C65.0283 -1.14163 50.1873 26.798 62.0601 33.1479C66.0177 35.2646 78.258 25.6127 65.0283 12.4049C51.7986 -0.802991 39.7279 0.128338 35.3463 2.24498C15.417 7.74826 2.27208 42.7152 71.8127 87.7573C96.4064 103.687 121 102.997 121 102.997" stroke="#00AC66" stroke-width="2" stroke-linecap="round"/>
        </svg></div>
       </div>

      
      

  </section>

</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
