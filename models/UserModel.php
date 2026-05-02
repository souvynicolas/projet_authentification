<?php

function getAllUsers(PDO $pdo): array
{
    $sql = "SELECT users.id, users.active AS statut, users.name, users.surname, users.login,
                   users.mail, users.created_at, users.last_login, roles.name AS role
            FROM users
            JOIN roles ON users.role_id = roles.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getUserForLogin(PDO $pdo, string $login): ?array
{
    $stmt = $pdo->prepare('SELECT id, login, password, role_id, name FROM users WHERE login = ? AND active = 1');
    $stmt->execute([$login]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function updateLastLogin(PDO $pdo, int $userId): void
{
    $stmt = $pdo->prepare('UPDATE users SET last_login = NOW() WHERE id = ? AND active = 1');
    $stmt->execute([$userId]);
}

function getUserById(PDO $pdo, int $userId): ?array
{
    $stmt = $pdo->prepare('SELECT id, role_id, login FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user ?: null;
}

function getLoginByUserId(PDO $pdo, int $userId): ?string
{
    $stmt = $pdo->prepare('SELECT login FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    return $user ? $user['login'] : null;
}

function createUser(PDO $pdo, string $name, string $surname, string $login, string $mail, string $passwordHash, int $roleId): int
{
    $stmt = $pdo->prepare('INSERT INTO users(name, surname, login, mail, password, role_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$name, $surname, $login, $mail, $passwordHash, $roleId]);
    return (int)$pdo->lastInsertId();
}

function updateUser(PDO $pdo, int $userId, string $name, string $surname, string $login, string $mail, int $roleId): void
{
    $stmt = $pdo->prepare('UPDATE users SET name = ?, surname = ?, login = ?, mail = ?, role_id = ? WHERE id = ?');
    $stmt->execute([$name, $surname, $login, $mail, $roleId, $userId]);
}

function deleteUser(PDO $pdo, int $userId): void
{
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$userId]);
}

function setUserActive(PDO $pdo, int $userId, bool $active): void
{
    $stmt = $pdo->prepare('UPDATE users SET active = ? WHERE id = ?');
    $stmt->execute([$active ? 1 : 0, $userId]);
}

function searchUsers(PDO $pdo, string $name, string $login, string $surname, string $mail, string $role): array
{
    $sql = "SELECT users.active AS statut, users.name, users.surname, users.login,
                   users.mail, users.created_at, users.last_login, roles.name AS roles
            FROM users
            JOIN roles ON users.role_id = roles.id";

    $conditions = [];
    $params = [];

    if ($name !== '') {
        $conditions[] = 'users.name LIKE ?';
        $params[] = "%$name%";
    }
    if ($login !== '') {
        $conditions[] = 'users.login LIKE ?';
        $params[] = "%$login%";
    }
    if ($surname !== '') {
        $conditions[] = 'users.surname LIKE ?';
        $params[] = "%$surname%";
    }
    if ($mail !== '') {
        $conditions[] = 'users.mail LIKE ?';
        $params[] = "%$mail%";
    }
    if ($role !== '') {
        $conditions[] = 'roles.name LIKE ?';
        $params[] = "%$role%";
    }

    if (!empty($conditions)) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}
