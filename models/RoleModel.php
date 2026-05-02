<?php

function getAllRoleNames(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT name FROM roles');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getRoleIdByName(PDO $pdo, string $role): ?int
{
    $stmt = $pdo->prepare('SELECT id FROM roles WHERE name = ?');
    $stmt->execute([$role]);
    $result = $stmt->fetch();
    return $result ? (int)$result['id'] : null;
}
