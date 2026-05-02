<?php

function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function requireAuth(): void
{
    startSession();
    if (empty($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit;
    }
}

function requireRole(array $allowedRoles): void
{
    requireAuth();
    $role = (int)($_SESSION['role'] ?? 0);
    if (!in_array($role, $allowedRoles, true)) {
        header('Location: index.php?page=dashboard');
        exit;
    }
}

function currentRole(): int
{
    startSession();
    return (int)($_SESSION['role'] ?? 0);
}
