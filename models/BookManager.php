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
        SELECT
            b.id,
            b.title,
            b.author,
            b.image,
            b.created_at,
            b.deleted_at,
            u.pseudo AS owner_pseudo
        FROM book b
        JOIN user u ON u.id = b.user_id
        WHERE b.status = 1 AND b.deleted_at IS NULL
        ORDER BY b.created_at DESC
        LIMIT :limite
    ";

    $requete = $pdo->prepare($sql); // ($stmt)
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
                b.status,
                u.id AS owner_id,
                u.pseudo AS owner_pseudo
            FROM book b
            JOIN user u ON u.id = b.user_id
            WHERE b.id = :id AND b.deleted_at IS NULL
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

    public function findAll(): array
    {
         $pdo = getPDO();
           $sql = "
            SELECT
                b.id,
                b.title,
                b.author,
                b.image,
                u.id AS owner_id,
                u.pseudo AS owner_pseudo
            FROM book b
            JOIN user u ON u.id = b.user_id 
            WHERE b.status=1 AND b.deleted_at IS NULL
            ORDER BY b.created_at DESC";
            $requete= $pdo->prepare($sql);
            $requete->execute();  
            
        $livres = $requete->fetchAll(PDO::FETCH_ASSOC);
        if ($livres) {
          return $livres;
          }
          return []; 

    }  
public function findByRecherche(string $recherche): array
{
    $pdo = getPDO();

   $sql = "
    SELECT 
        b.id,
        b.title,
        b.author,
        b.image,
        u.pseudo AS owner_pseudo
    FROM book b
    JOIN user u ON u.id = b.user_id
    WHERE (b.title LIKE :recherche OR b.author LIKE :recherche)
      AND b.deleted_at IS NULL
    ORDER BY b.created_at DESC";


    $requete = $pdo->prepare($sql);
   // $motRecherche = '%' . $recherche . '%';

    //$requete->execute([
    //'recherche' => $motRecherche
    //]);


    $requete->execute([
        'recherche' => '%' . $recherche . '%'
    ]);

    $livres = $requete->fetchAll(PDO::FETCH_ASSOC);

    return $livres ?: [];
}

public function findByUserId(int $idUtilisateur): array
{
    $pdo = getPDO();

    $sql = "
        SELECT
            b.id,
            b.title,
            b.author,
            b.image,
            b.description,
            b.status,
            b.created_at
        FROM book b
        WHERE b.user_id = :idUtilisateur
        AND b.deleted_at IS NULL
        ORDER BY b.created_at DESC
    ";

    $requete = $pdo->prepare($sql); // ($stmt)
    $requete->execute([
        'idUtilisateur' => $idUtilisateur
    ]);

    $livres = $requete->fetchAll(PDO::FETCH_ASSOC);

    if ($livres) {
        return $livres;
    }

    return [];
}

public function insererLivre(int $idUtilisateur, string $titre, string $auteur, string $description, string $image, int $status): bool
{
    $pdo = getPDO();

    $sql = "
        INSERT INTO book (title, author, description, image, status, user_id, created_at)
        VALUES (:title, :author, :description, :image, :status, :user_id, NOW())
    ";

    $requete = $pdo->prepare($sql); // ($stmt)

    return $requete->execute([
        'title'       => $titre,
        'author'      => $auteur,
        'description' => $description,
        'image'       => $image,
        'status'      => $status,
        'user_id'     => $idUtilisateur
    ]);
}

public function mettreAJourLivre(int $idLivre, int $idUtilisateur, string $titre, string $auteur, string $description, string $image, int $status): bool
{
    $pdo = getPDO();

    $sql = "
        UPDATE book
        SET title = :title,
            author = :author,
            description = :description,
            image = :image,
            status = :status
        WHERE id = :id
          AND user_id = :user_id
          AND deleted_at IS NULL
        LIMIT 1
    ";

    $requete = $pdo->prepare($sql); // ($stmt)

    return $requete->execute([
        'title'   => $titre,
        'author'  => $auteur,
        'description' => $description,
        'image'   => $image,
        'status'  => $status,
        'id'      => $idLivre,
        'user_id' => $idUtilisateur
    ]);
}

public function changerStatus(int $idLivre, int $idUtilisateur, int $status): bool
{
    $pdo = getPDO();

    $sql = "
        UPDATE book
        SET status = :status
        WHERE id = :id
          AND user_id = :user_id
          AND deleted_at IS NULL
        LIMIT 1
    ";

    $requete = $pdo->prepare($sql); // ($stmt)

    return $requete->execute([
        'status'  => $status,
        'id'      => $idLivre,
        'user_id' => $idUtilisateur
    ]);
}

public function supprimerLivre(int $idLivre, int $idUtilisateur): bool
{
    $pdo = getPDO();

    $sql = "
        UPDATE book
        SET deleted_at = NOW()
        WHERE id = :id
          AND user_id = :user_id
          AND deleted_at IS NULL
        LIMIT 1
    ";

    $requete = $pdo->prepare($sql); // ($stmt)

    return $requete->execute([
        'id'      => $idLivre,
        'user_id' => $idUtilisateur
    ]);
}



}
