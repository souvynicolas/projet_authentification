<?php

function validatePassRules(string $password, string $verifyPassword): array
{
    $errors = [];

    if ($password !== $verifyPassword) {
        $errors[] = 'Mot de passe non vérifié';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Le mot de passe doit contenir au moins une majuscule';
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        $errors[] = 'Le mot de passe doit contenir au moins un caractère spécial';
    }

    return $errors;
}

function validateMail(PDO $pdo, string $mail, ?int $userId = null): array
{
    $errors = [];
    $mail = strtolower(trim($mail));

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return ['Email invalide'];
    }

    if ($userId === null) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE mail = ?');
        $stmt->execute([$mail]);
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE mail = ? AND id <> ?');
        $stmt->execute([$mail, $userId]);
    }

    if ($stmt->fetch()) {
        $errors[] = 'Cet email existe déjà';
    }

    return $errors;
}

function validateLogin(PDO $pdo, string $login, ?int $userId = null): array
{
    $errors = [];
    $login = strtolower(trim($login));

    if ($login === '') {
        return ['Le login est requis'];
    }

    if ($userId === null) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE login = ?');
        $stmt->execute([$login]);
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE login = ? AND id <> ?');
        $stmt->execute([$login, $userId]);
    }

    if ($stmt->fetch()) {
        $errors[] = 'Ce login existe déjà';
    }

    return $errors;
}
