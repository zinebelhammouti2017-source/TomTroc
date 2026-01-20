<?php

function getPDO(): PDO
{
    $hote = 'localhost';
    $nomBase = 'tomtroc';
    $utilisateur = 'root';
    $motDePasse = '';

    $dsn = "mysql:host=$hote;dbname=$nomBase;charset=utf8mb4";

    return new PDO($dsn, $utilisateur, $motDePasse, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}
