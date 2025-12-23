<?php

require_once __DIR__ . '/../config/bdd.php';

class BookManager
{
    /**
     * Récupère les derniers livres disponibles (status = 1).
     * Retour : tableau de livres (même si vide).
     */
    public function findLastAvailableBooks(int $limite = 4): array
    {
        $pdo = getPDO();

        $sql = "
            SELECT id, title, author, image, created_at
            FROM book
            WHERE status = 1
            ORDER BY created_at DESC
            LIMIT :limite
        ";

        $requete = $pdo->prepare($sql); // (courant en entreprise : $stmt)
        $requete->bindValue(':limite', $limite, PDO::PARAM_INT);
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère 1 livre par son id + le pseudo du propriétaire.
     * Retour : tableau associatif si trouvé, sinon null.
     */
    public function findOneById(int $id): ?array
    {
        $pdo = getPDO();

        $sql = "
            SELECT
                b.id,
                b.title,
                b.author,
                b.image,
                b.description,
                b.created_at,
                u.id AS owner_id,
                u.pseudo AS owner_pseudo
            FROM book b
            JOIN users u ON u.id = b.user_id
            WHERE b.id = :id
            LIMIT 1
        ";
        $requete = $pdo->prepare($sql);
        $requete->execute(['id' => $id]);

        $livre = $requete->fetch(PDO::FETCH_ASSOC);
        if ($livre) {
          return $livre;
          }
          return null;

    }
}
