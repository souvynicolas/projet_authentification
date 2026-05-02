<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/helpers/validation.php';
require_once __DIR__ . '/models/RoleModel.php';
require_once __DIR__ . '/models/UserModel.php';
require_once __DIR__ . '/models/ActionLogModel.php';
require_once __DIR__ . '/helpers/view.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/UserController.php';

$pdo = getPDO();
$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        loginController($pdo);
        break;
    case 'logout':
        logoutController();
        break;
    case 'dashboard':
        dashboardController($pdo);
        break;
    case 'search_user':
        searchUserController($pdo);
        break;
    case 'edit_user':
        editUserController($pdo);
        break;
    case 'create_delete_user':
        createDeleteUserController($pdo);
        break;
    case 'history':
        historyController($pdo);
        break;
    default:
        header('Location: index.php?page=login');
        exit;
}
