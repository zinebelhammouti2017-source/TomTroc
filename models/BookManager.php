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
            u.pseudo AS owner_pseudo
        FROM book b
        JOIN users u ON u.id = b.user_id
        WHERE b.status = 1
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
            JOIN users u ON u.id = b.user_id 
            WHERE b.status=1
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
        JOIN users u ON u.id = b.user_id
        WHERE b.title LIKE :recherche
           OR b.author LIKE :recherche
        ORDER BY b.created_at DESC
    ";

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

}
