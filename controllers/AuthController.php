<?php

function loginController(PDO $pdo): void
{
    startSession();
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($login === '' || $password === '') {
            $errors[] = 'Veuillez remplir tous les champs';
        } else {
            $user = getUserForLogin($pdo, $login);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                updateLastLogin($pdo, (int)$user['id']);

                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = (int)$user['role_id'];

                header('Location: index.php?page=dashboard');
                exit;
            }

            $errors[] = 'Identifiants invalides';
        }
    }

    render('auth/login', ['errors' => $errors]);
}

function logoutController(): void
{
    startSession();
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?page=login');
    exit;
}
