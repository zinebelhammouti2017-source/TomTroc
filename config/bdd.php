<?php

function getPDO(): PDO
{
    $hote = 'localhost';
    $nomBase = 'sitetomtroc';      // mets ici le nom exact de ta base
    $utilisateur = 'root';
    $motDePasse = '';          // souvent vide sur XAMPP

    $dsn = "mysql:host=$hote;dbname=$nomBase;charset=utf8mb4";

    return new PDO($dsn, $utilisateur, $motDePasse, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
