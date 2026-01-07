<?php

require_once __DIR__ . '/../config/bdd.php';

class UserManager
{
    public function emailExiste(string $email): bool
    {
        $pdo = getPDO();

        $sql = "SELECT id FROM user WHERE email = :email LIMIT 1";
        $requete = $pdo->prepare($sql); // ($stmt)
        $requete->execute(['email' => $email]);

        return (bool) $requete->fetch();
    }

    public function pseudoExiste(string $pseudo): bool
    {
        $pdo = getPDO();

        $sql = "SELECT id FROM user WHERE pseudo = :pseudo LIMIT 1";
        $requete = $pdo->prepare($sql); // ($stmt)
        $requete->execute(['pseudo' => $pseudo]);

        return (bool) $requete->fetch();
    }

    public function creerUtilisateur(string $pseudo, string $email, string $motDePasseHash): bool
    {
        $pdo = getPDO();

        $sql = "
            INSERT INTO user (pseudo, email, password, created_at)
            VALUES (:pseudo, :email, :password, CURDATE())
        ";

        $requete = $pdo->prepare($sql); // ($stmt)

        return $requete->execute([
            'pseudo'   => $pseudo,
            'email'    => $email,
            'password' => $motDePasseHash
        ]);
    }
     
    public function trouverParEmail(string $email): ?array
    {
      $pdo = getPDO();

      $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
      $requete = $pdo->prepare($sql);
      $requete->execute(['email' => $email]);

      $utilisateur = $requete->fetch();

      if ($utilisateur !== false) {
        return $utilisateur;
      } else {
        return null;
      }
    }

}
