<?php

function getPDO(): PDO
{
    $host = '127.0.0.1';
    $dbname = 'authentification_test';
    $username = 'root';
    $password = 'root';

    try {
        return new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage()));
    }
}
