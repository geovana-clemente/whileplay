<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir cabeçalhos CORS se necessário
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Carregar dependências
require_once '../controllers/UserController.php';
require_once '../config/database.php';

// Capturar método e rota
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remover query string se existir
$uri = strtok($uri, '?');

// Definir rotas simples baseadas no final da URL ou parâmetro action
$route = $_GET['action'] ?? '';

if (empty($route)) {
    if (strpos($uri, 'register') !== false) {
        $route = 'register';
    } elseif (strpos($uri, 'login') !== false && strpos($uri, 'logout') === false) {
        $route = 'login';
    } elseif (strpos($uri, 'logout') !== false) {
        $route = 'logout';
    } elseif (strpos($uri, 'check-auth') !== false) {
        $route = 'check-auth';
    }
}

// Processar rota
switch ($route) {
    case 'register':
        if ($method === 'POST') {
            $controller = new UserController();
            $controller->register();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;
        
    case 'login':
        if ($method === 'POST') {
            $controller = new UserController();
            $controller->login();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;
        
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
        
    case 'check-auth':
        if ($method === 'GET') {
            $controller = new UserController();
            $controller->checkAuth();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
        }
        break;
        
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}