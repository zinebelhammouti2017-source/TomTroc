<?php

require_once __DIR__ . '/../models/ConversationManager.php';

class MessagerieService
{
    private ConversationManager $conversationManager;

    public function __construct()
    {
        $this->conversationManager = new ConversationManager();
    }

    /**
     * Récupère la liste des conversations de l'utilisateur connecté
     */
    public function recupererConversations(int $userId): array
    {
        $conversations = $this->conversationManager->findByUserId($userId);

        return array(
            'conversations' => $conversations
        );
    }
}
