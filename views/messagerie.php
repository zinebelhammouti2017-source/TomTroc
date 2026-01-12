<?php require_once __DIR__ . '/templates/header.php'; ?>

<main class="page-messagerie<?php echo ((int)$conversationId > 0) ? ' mobile-conversation-active' : ''; ?>">

  <section class="messagerie-layout">

    <h1 class="messagerie-titre">Messagerie</h1>

    <div class="messagerie-grille">

      <!-- COLONNE GAUCHE : LISTE DES CONVERSATIONS -->
      <aside class="messagerie-liste">

        <?php if (!empty($conversations)) : ?>

          <?php foreach ($conversations as $conversation) : ?>

            <?php
              $estActif = false;
              if (isset($conversationId) && (int)$conversationId > 0) {
                if ((int)$conversation['conversation_id'] === (int)$conversationId) {
                  $estActif = true;
                }
              }

              $classeActive = $estActif ? ' liste-conversation-active' : '';
            ?>

            <a
              class="liste-conversation<?php echo $classeActive; ?>"
              href="/projet4/public/?page=messagerie&conversation_id=<?php echo (int) $conversation['conversation_id']; ?>"
            >
              <div class="conversation-ligne">

                <img
                  class="conversation-avatar"
                  src="/projet4/public/images/imgProfil.png"
                  alt="Avatar"
                >

                <div class="conversation-texte">
                  <p class="conversation-pseudo">
                    <?php echo htmlspecialchars($conversation['other_pseudo']); ?>
                  </p>

                  <p class="conversation-date">
                    <?php echo htmlspecialchars($conversation['created_at']); ?>
                  </p>
                </div>

              </div>
            </a>

          <?php endforeach; ?>

        <?php else : ?>

          <p class="messagerie-vide">
            Vous n’avez encore aucune conversation.
          </p>

        <?php endif; ?>

      </aside>

      <!-- COLONNE DROITE : CONVERSATION -->
      <section class="messagerie-conversation">

        <?php if (isset($conversationId) && (int)$conversationId > 0) : ?>

          <!-- Header conversation (avatar + pseudo) -->
          <div class="conversation-header">
            <a class="conversation-retour" href="/projet4/public/?page=messagerie">← retour</a>


            <img
              class="conversation-avatar"
              src="/projet4/public/images/imgProfil.png"
              alt="Avatar"
            >

            <p class="conversation-nom">
              <?php
                if (isset($pseudoConversation) && $pseudoConversation !== '') {
                  echo htmlspecialchars($pseudoConversation);
                } else {
                  echo 'Conversation';
                }
              ?>
            </p>

          </div>

          <!-- Liste messages -->
          <div class="messages-liste">

            <?php if (!empty($messages)) : ?>

              <?php foreach ($messages as $message) : ?>

                <?php
                  $classeMessage = 'message-item';
                  if (isset($_SESSION['user_id'])) {
                    if ((int)$message['sender_id'] === (int)$_SESSION['user_id']) {
                      $classeMessage .= ' message-moi';
                    } else {
                      $classeMessage .= ' message-autre';
                    }
                  }
                ?>

                <article class="<?php echo $classeMessage; ?>">
                  <p class="message-contenu">
                    <?php echo htmlspecialchars($message['content']); ?>
                  </p>
                  <p class="message-date">
                    <small><?php echo htmlspecialchars($message['created_at']); ?></small>
                  </p>
                </article>

              <?php endforeach; ?>

            <?php else : ?>

              <p class="message-vide">Aucun message dans cette conversation.</p>

            <?php endif; ?>

          </div>

          <!-- Formulaire envoi -->
          <form class="message-form" method="post" action="/projet4/public/?page=envoyer-message">

            <input
              type="hidden"
              name="conversation_id"
              value="<?php echo (int) $conversationId; ?>"
            >

            <textarea
              class="message-text"
              name="content"
              placeholder="Tapez votre message ici"
              required
            ></textarea>

            <button class="envoyer_message" type="submit">
              Envoyer
            </button>

          </form>

        <?php else : ?>

          <p class="message-selection">
            Sélectionnez une conversation pour afficher les messages.
          </p>

        <?php endif; ?>

      </section>

    </div>

  </section>
</main>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
