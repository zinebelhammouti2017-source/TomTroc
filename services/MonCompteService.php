<?php

require_once __DIR__ . '/../models/UserManager.php';
require_once __DIR__ . '/../models/BookManager.php';

class MonCompteService
{
    private UserManager $userManager;
    private BookManager $bookManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->bookManager = new BookManager();
    }

    public function recupererDonneesMonCompte(int $userId): array
    {
        $utilisateur = $this->userManager->trouverParId($userId);
        $livresUtilisateur = $this->bookManager->findByUserId($userId);

        $nombreLivres = 0;
        if (is_array($livresUtilisateur)) {
            $nombreLivres = count($livresUtilisateur);
        }

        return array(
            'utilisateur' => $utilisateur,
            'livresUtilisateur' => $livresUtilisateur,
            'nombreLivres' => $nombreLivres
        );
    }
}
