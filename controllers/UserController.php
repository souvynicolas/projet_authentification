<?php

function dashboardController(PDO $pdo): void
{
    requireAuth();

    $errors = [];
    $roleId = currentRole();
    $autroles = ($roleId === 3);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!$autroles) {
            $errors[] = "Vous n'avez pas les droits pour modifier les utilisateurs.";
        } else {
            $userId = (int)($_POST['d_create_id'] ?? 0);
            $login = trim($_POST['d_login'] ?? '');

            if ($userId > 0) {
                if ($userId === (int)($_SESSION['user_id'] ?? 0) && isset($_POST['btn_disable'])) {
                    $errors[] = 'Impossible de vous désactiver vous-même';
                }

                if (empty($errors)) {
                    if (isset($_POST['btn_enable'])) {
                        setUserActive($pdo, $userId, true);
                    } elseif (isset($_POST['btn_disable'])) {
                        setUserActive($pdo, $userId, false);
                    }

                    createActionLog(
                        $pdo,
                        'update active',
                        "active $login modifié",
                        $_SESSION['user_id'] ?? null,
                        $userId
                    );
                }
            }
        }
    }

    render('users/dashboard', [
        'users' => getAllUsers($pdo),
        'role_id' => $roleId,
        'autroles' => $autroles,
        'errors' => $errors,
    ]);
}


function searchUserController(PDO $pdo): void
{
    requireAuth();

    $login = trim($_GET['login'] ?? '');
    $name = trim($_GET['name'] ?? '');
    $surname = trim($_GET['surname'] ?? '');
    $mail = trim($_GET['mail'] ?? '');
    $role = trim($_GET['h_action'] ?? '');

    render('users/search', [
        'users' => searchUsers($pdo, $name, $login, $surname, $mail, $role),
        'role_id' => currentRole(),
        'login' => $login,
        'name' => $name,
        'surname' => $surname,
        'mail' => $mail,
    ]);
}

function editUserController(PDO $pdo): void
{
    requireRole([2, 3]);
    $roleId = currentRole();
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['id'] ?? 0);
        $login = trim($_POST['login'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $mail = trim($_POST['mail'] ?? '');
        $role = trim($_POST['role'] ?? '');

        foreach (['id' => $id, 'login' => $login, 'prénom' => $name, 'nom' => $surname, 'mail' => $mail] as $label => $value) {
            if (empty($value)) {
                $errors[] = "$label requis";
            }
        }

        $user = null;
        if (empty($errors)) {
            $user = getUserById($pdo, $id);
            if (!$user) {
                $errors[] = "L'utilisateur est introuvable";
            }
        }

        if (empty($errors)) {
            $errors = array_merge($errors, validateLogin($pdo, $login, $id), validateMail($pdo, $mail, $id));
        }

        if (empty($errors) && $user) {
            $newRoleId = (int)$user['role_id'];

            if ($roleId === 3) {
                if ($role === '') {
                    $errors[] = 'Rôle requis';
                } else {
                    $selectedRoleId = getRoleIdByName($pdo, $role);
                    if (!$selectedRoleId) {
                        $errors[] = 'Le rôle est introuvable';
                    } else {
                        $newRoleId = $selectedRoleId;
                    }
                }
            }

            if (empty($errors)) {
                updateUser($pdo, $id, $name, $surname, $login, $mail, $newRoleId);
                createActionLog($pdo, 'update user', "utilisateur $login modifié", $_SESSION['user_id'] ?? null, $id);
                header('Location: index.php?page=edit_user');
                exit;
            }
        }
    }

    render('users/edit', [
        'users' => getAllUsers($pdo),
        'role_id' => $roleId,
        'errors' => $errors,
    ]);
}

function createDeleteUserController(PDO $pdo): void
{
    requireRole([3]);
    $errors = [];
    $roleId = currentRole();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['create_id'] ?? 0);
        $login = trim($_POST['create_login'] ?? '');
        $name = trim($_POST['create_name'] ?? '');
        $surname = trim($_POST['create_surname'] ?? '');
        $mail = trim($_POST['create_mail'] ?? '');
        $role = trim($_POST['role'] ?? '');
        $password = $_POST['create_password'] ?? '';
        $verifyPassword = $_POST['create_verify_password'] ?? '';

        if (isset($_POST['btn_create'])) {
            foreach (['login' => $login, 'prénom' => $name, 'nom' => $surname, 'mail' => $mail, 'rôle' => $role, 'mot de passe' => $password, 'mot de passe de vérification' => $verifyPassword] as $label => $value) {
                if (empty($value)) {
                    $errors[] = "$label requis";
                }
            }

            $errors = array_merge($errors, validateMail($pdo, $mail), validateLogin($pdo, $login), validatePassRules($password, $verifyPassword));

            if (empty($errors)) {
                $roleDatabaseId = getRoleIdByName($pdo, $role);
                if (!$roleDatabaseId) {
                    $errors[] = 'Le rôle est introuvable';
                } else {
                    $newUserId = createUser($pdo, $name, $surname, $login, $mail, password_hash($password, PASSWORD_DEFAULT), $roleDatabaseId);
                    createActionLog($pdo, 'create user', "utilisateur $login créé", $_SESSION['user_id'] ?? null, $newUserId);
                    header('Location: index.php?page=create_delete_user');
                    exit;
                }
            }
        }

        if (isset($_POST['btn_delete'])) {
            $confirmDelete = $_POST['confirm_delete'] ?? '0';

            if ($id <= 0) {
                $errors[] = "Aucun utilisateur n'est sélectionné";
            } elseif ($id === (int)($_SESSION['user_id'] ?? 0)) {
                $errors[] = 'Vous ne pouvez pas supprimer votre propre compte';
            } else {
                $targetLogin = getLoginByUserId($pdo, $id);
                if (!$targetLogin) {
                    $errors[] = "L'utilisateur est introuvable";
                } elseif ($confirmDelete === '1') {
                    createActionLog($pdo, 'delete user', "utilisateur $targetLogin supprimé", $_SESSION['user_id'] ?? null, $id);
                    deleteUser($pdo, $id);
                    header('Location: index.php?page=create_delete_user');
                    exit;
                }
            }
        }
    }

    render('users/create_delete', [
        'users' => getAllUsers($pdo),
        'role_id' => $roleId,
        'errors' => $errors,
    ]);
}

function historyController(PDO $pdo): void
{
    requireRole([3]);

    $action = trim($_GET['h_action'] ?? '');
    $login = trim($_GET['h_login'] ?? '');
    $creator = trim($_GET['h_createur'] ?? '');
    $dateStart = str_replace('T', ' ', $_GET['h_date_start'] ?? '');
    $dateEnd = str_replace('T', ' ', $_GET['h_date_end'] ?? '');

    $result = searchHistory($pdo, $dateStart, $dateEnd, $action, $creator, $login);

    render('users/history', [
        'role_id' => currentRole(),
        'errors' => $result['errors'],
        'action_logs' => $result['data'],
        'h_action' => $action,
        'h_login' => $login,
        'h_createur' => $creator,
        'h_date_start' => $dateStart,
        'h_date_end' => $dateEnd,
    ]);
}
