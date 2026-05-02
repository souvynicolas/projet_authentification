<?php

function createActionLog(PDO $pdo, string $action, string $details, ?int $userId, ?int $targetUserId = null): void
{
    // Si la colonne target_user_id existe, on la renseigne. Sinon, on reste compatible avec l'ancien schéma.
    $columns = $pdo->query("SHOW COLUMNS FROM action_logs LIKE 'target_user_id'")->fetch();

    if ($columns) {
        $stmt = $pdo->prepare('INSERT INTO action_logs (action, details, user_id, target_user_id) VALUES (?, ?, ?, ?)');
        $stmt->execute([$action, $details, $userId, $targetUserId]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO action_logs (action, details, user_id) VALUES (?, ?, ?)');
        $stmt->execute([$action, $details, $userId]);
    }
}

function getDistinctActionNames(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT DISTINCT action FROM action_logs');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function searchHistory(PDO $pdo, string $dateStart, string $dateEnd, string $action, string $creator, string $login): array
{
    $hasTarget = $pdo->query("SHOW COLUMNS FROM action_logs LIKE 'target_user_id'")->fetch();

    if ($hasTarget) {
        $sql = "SELECT u2.login, action_logs.action, action_logs.details, u1.name AS createur,
                       action_logs.created_at AS 'date de création action', u2.last_login AS 'dernière connexion'
                FROM action_logs
                LEFT JOIN users u1 ON action_logs.user_id = u1.id
                LEFT JOIN users u2 ON action_logs.target_user_id = u2.id";
    } else {
        $sql = "SELECT action_logs.action, action_logs.details, u1.name AS createur,
                       action_logs.created_at AS 'date de création action'
                FROM action_logs
                LEFT JOIN users u1 ON action_logs.user_id = u1.id";
    }

    $conditions = [];
    $params = [];
    $errors = [];

    if ($dateStart !== '') {
        $conditions[] = 'action_logs.created_at >= ?';
        $params[] = $dateStart;
    }
    if ($dateEnd !== '') {
        $conditions[] = 'action_logs.created_at <= ?';
        $params[] = $dateEnd;
    }
    if ($dateStart !== '' && $dateEnd !== '' && $dateStart > $dateEnd) {
        return ['errors' => ['La date de début est supérieure à la date de fin'], 'data' => []];
    }
    if ($action !== '') {
        $conditions[] = 'action_logs.action LIKE ?';
        $params[] = "%$action%";
    }
    if ($creator !== '') {
        $conditions[] = 'u1.name LIKE ?';
        $params[] = "%$creator%";
    }
    if ($login !== '' && $hasTarget) {
        $conditions[] = 'u2.login LIKE ?';
        $params[] = "%$login%";
    }

    if (!empty($conditions)) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return ['errors' => $errors, 'data' => $stmt->fetchAll()];
}
