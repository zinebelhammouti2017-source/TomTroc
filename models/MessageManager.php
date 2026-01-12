<?php

require_once __DIR__ . '/../config/bdd.php';

class MessageManager
{
    public function findByConversationId(int $idConversation): array
    {
        $pdo = getPDO();

        $sql = "
            SELECT
                m.id,
                m.created_at,
                m.content,
                m.sender_id
            FROM message m
            WHERE m.conversation_id = :id_conversation
            ORDER BY m.created_at ASC
        ";

        $requete = $pdo->prepare($sql); // ($stmt)
        $requete->execute([
            'id_conversation' => $idConversation
        ]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insererMessage(int $conversationId, int $senderId, string $contenu): bool
    {
        $pdo = getPDO();

        $sql = "
            INSERT INTO message (conversation_id, sender_id, content, created_at)
            VALUES (:conversation_id, :sender_id, :content, NOW())
        ";

        $requete = $pdo->prepare($sql); // ($stmt)

        return $requete->execute([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'content' => $contenu
        ]);
    }
}
