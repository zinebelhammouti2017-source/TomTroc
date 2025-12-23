<?php
require_once __DIR__ . '/../models/BookManager.php';

class AcceuilController {

    public function afficher()
   {
    $bookManager= new BookManager();
    $livres=$bookManager-> findLastAvailableBooks();

    require_once __DIR__ . '/../views/accueil.php';
   }
}