<?php

require_once __DIR__ . '/../config/bdd.php';


class ConversationManager
{
    public function findByUserId(int $idUtilisateur): array
    {
        $pdo = getPDO();

        $sql = "
            SELECT
                c.id AS conversation_id,
                c.created_at,

                CASE
                    WHEN c.user1_id = :id THEN c.user2_id
                    ELSE c.user1_id
                END AS other_user_id,

                u.pseudo AS other_pseudo

            FROM conversation c
            JOIN user u
                ON u.id = (
                    CASE
                        WHEN c.user1_id = :id THEN c.user2_id
                        ELSE c.user1_id
                    END
                )

            WHERE c.user1_id = :id OR c.user2_id = :id
            ORDER BY c.created_at DESC
        ";

        $requete = $pdo->prepare($sql);
        $requete->execute([
            'id' => $idUtilisateur
        ]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneById(int $conversationId): ?array
{
    $pdo = getPDO();

    $sql = "
        SELECT id, user1_id, user2_id, created_at
        FROM conversation
        WHERE id = :id
        LIMIT 1
    ";

    $requete = $pdo->prepare($sql); // ($stmt)
    $requete->execute([
        'id' => $conversationId
    ]);

    $conversation = $requete->fetch(PDO::FETCH_ASSOC);

    if ($conversation !== false) {
        return $conversation;
    }

    return null;
}

public function findOrCreateConversation(int $userA, int $userB): int
{
    $pdo = getPDO();

    // 1) chercher une conversation existante entre A et B (dans les 2 sens)
    $sqlSelect = "
        SELECT id
        FROM conversation
        WHERE (user1_id = :userA AND user2_id = :userB)
           OR (user1_id = :userB AND user2_id = :userA)
        LIMIT 1
    ";

    $requete = $pdo->prepare($sqlSelect);
    $requete->execute([
        'userA' => $userA,
        'userB' => $userB
    ]);

    $row = $requete->fetch(PDO::FETCH_ASSOC);

    if ($row !== false && isset($row['id'])) {
        return (int) $row['id'];
    }

    // 2) sinon créer la conversation (ordre stable)
    $user1 = min($userA, $userB);
    $user2 = max($userA, $userB);

    $sqlInsert = "
        INSERT INTO conversation (user1_id, user2_id, created_at)
        VALUES (:user1, :user2, NOW())
    ";

    $requeteInsert = $pdo->prepare($sqlInsert);
    $requeteInsert->execute([
        'user1' => $user1,
        'user2' => $user2
    ]);

    return (int) $pdo->lastInsertId();
}


}

    
