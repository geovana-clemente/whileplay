<?php
// auth_router.php - Roteador para autenticação (login, cadastro, logout, check-auth)
session_start();

require_once '../controllers/UserController.php';
require_once '../controllers/UserControllerV2.php';

$action = $_GET['action'] ?? '';

$controller = new UserController();

switch ($action) {
    case 'register':
        $controller->register();
        break;
    case 'login':
        $controller->login();
        break;
    case 'logout':
        session_destroy();
        header('Location: ../../front-end/views/login.html?success=logout');
        exit();
    case 'check-auth':
        // Delegar para o controlador para retornar detalhes do usuário e assinatura
        $controller->checkAuth();
        exit();
    default:
        header('Location: ../../front-end/views/login.html');
        exit();
}
