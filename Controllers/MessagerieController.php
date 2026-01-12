<?php

require_once __DIR__ . '/../services/MessagerieService.php';
require_once __DIR__ . '/../models/ConversationManager.php';
require_once __DIR__ . '/../models/MessageManager.php';
require_once __DIR__ . '/../models/UserManager.php';

class MessagerieController
{
    /**
     * Affiche la page Messagerie :
     * - colonne gauche : liste des conversations
     * - colonne droite : messages + formulaire si une conversation est sélectionnée
     */
    public function afficher(): void
    {
        // 1) Protection : utilisateur connecté ?
        if (!isset($_SESSION['user_id'])) {
            header('Location: /projet4/public/?page=connexion');
            exit;
        }

        // 2) Utilisateur connecté
        $userId = (int) $_SESSION['user_id'];

        // 3) Récupérer les conversations (colonne gauche)
        $messagerieService = new MessagerieService();
        $donnees = $messagerieService->recupererConversations($userId);
        $conversations = $donnees['conversations'];

        // 4) Conversation sélectionnée ?
        $conversationId = 0;
        if (isset($_GET['conversation_id'])) {
            $conversationId = (int) $_GET['conversation_id'];
        }

        // Variables pour la vue (colonne droite)
        $messages = [];
        $pseudoConversation = '';

        // 5) Si une conversation est sélectionnée
        if ($conversationId > 0) {

            $conversationManager = new ConversationManager();
            $conversation = $conversationManager->findOneById($conversationId);

            if ($conversation !== null) {

                // Vérifier que l'utilisateur fait partie de la conversation
                $user1 = (int) $conversation['user1_id'];
                $user2 = (int) $conversation['user2_id'];

                $estParticipant = false;

                if ($userId === $user1 || $userId === $user2) {
                    $estParticipant = true;
                }

                if ($estParticipant === true) {

                    // Déterminer l'autre utilisateur
                    if ($userId === $user1) {
                        $otherUserId = $user2;
                    } else {
                        $otherUserId = $user1;
                    }

                    // Récupérer son pseudo
                    $userManager = new UserManager();
                    $otherUser = $userManager->trouverParId($otherUserId);

                    if ($otherUser !== null && isset($otherUser['pseudo'])) {
                        $pseudoConversation = $otherUser['pseudo'];
                    }

                    // Charger les messages
                    $messageManager = new MessageManager();
                    $messages = $messageManager->findByConversationId($conversationId);
                } else {
                    // Sécurité : accès refusé
                    $conversationId = 0;
                }
            } else {
                // Conversation inexistante
                $conversationId = 0;
            }
        }

        // 6) Affichage de la vue unique
        require_once __DIR__ . '/../views/messagerie.php';
    }

    /**
     * Traitement de l'envoi d'un message (POST)
     */
    public function envoyerMessage(): void
    {
        // 1) Utilisateur connecté ?
        if (!isset($_SESSION['user_id'])) {
            header('Location: /projet4/public/?page=connexion');
            exit;
        }

        // 2) Méthode POST obligatoire
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /projet4/public/?page=messagerie');
            exit;
        }

        $userId = (int) $_SESSION['user_id'];

        // 3) Données du formulaire
        $conversationId = isset($_POST['conversation_id']) ? (int) $_POST['conversation_id'] : 0;
        $contenu = isset($_POST['content']) ? trim($_POST['content']) : '';

        if ($conversationId <= 0 || $contenu === '') {
            header('Location: /projet4/public/?page=messagerie');
            exit;
        }

        // 4) Vérifier que l'utilisateur appartient à la conversation
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->findOneById($conversationId);

        if ($conversation === null) {
            header('Location: /projet4/public/?page=messagerie');
            exit;
        }

        $user1 = (int) $conversation['user1_id'];
        $user2 = (int) $conversation['user2_id'];

        if ($userId !== $user1 && $userId !== $user2) {
            header('Location: /projet4/public/?page=messagerie');
            exit;
        }

        // 5) Insertion du message
        $messageManager = new MessageManager();
        $messageManager->insererMessage($conversationId, $userId, $contenu);

        // 6) Redirection vers la conversation
        header('Location: /projet4/public/?page=messagerie&conversation_id=' . $conversationId);
        exit;
    }

    public function demarrerConversation(): void
{
    // 1) connecté ?
    if (!isset($_SESSION['user_id'])) {
        header('Location: /projet4/public/?page=connexion');
        exit;
    }

    $userId = (int) $_SESSION['user_id'];

    // 2) récupérer l'id du destinataire
    $otherUserId = 0;
    if (isset($_GET['user_id'])) {
        $otherUserId = (int) $_GET['user_id'];
    }

    if ($otherUserId <= 0) {
        header('Location: /projet4/public/?page=messagerie');
        exit;
    }

    // éviter conversation avec soi-même
    if ($otherUserId === $userId) {
        header('Location: /projet4/public/?page=messagerie');
        exit;
    }

    // 3) trouver ou créer la conversation
    $conversationManager = new ConversationManager();
    $conversationId = $conversationManager->findOrCreateConversation($userId, $otherUserId);

    // 4) rediriger vers la messagerie sur la bonne conversation
    header('Location: /projet4/public/?page=messagerie&conversation_id=' . $conversationId);
    exit;
}

}
