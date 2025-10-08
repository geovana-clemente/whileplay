<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carregar controladores
require_once '../controllers/AssinaturaController.php';
require_once '../controllers/RoteiroController.php';
require_once '../controllers/PagamentoController.php';
require_once '../controllers/PerfilController.php';
require_once '../controllers/PublicarController.php';
require_once '../controllers/PersonagemController.php';
require_once '../controllers/SuporteController.php';
require_once '../controllers/UserController.php';
require_once '../config/database.php';

// Criar conexão com o banco de dados
$database = new Database();
$pdo = $database->getConnection();

// Capturar URL da requisição
$request = $_SERVER['REQUEST_URI'];

// Limpar query parameters
$request = strtok($request, '?');

// Roteamento
switch ($request) {
    
    // ==================== ROTAS DE AUTENTICAÇÃO ====================
    case '/GitHub/whileplay/whileplay/while-play/projeto_whileplay/back-end/register':
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new UserController();
            $controller->register();
        } else {
            http_response_code(405);
            echo "Método não permitido";
        }
        break;
        
    case '/GitHub/whileplay/whileplay/while-play/projeto_whileplay/back-end/login':
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new UserController();
            $controller->login();
        } else {
            http_response_code(405);
            echo "Método não permitido";
        }
        break;
        
    case '/GitHub/whileplay/whileplay/while-play/projeto_whileplay/back-end/logout':
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/logout':
        $controller = new UserController();
        $controller->logout();
        break;
        
    case '/GitHub/whileplay/whileplay/while-play/projeto_whileplay/back-end/check-auth':
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/check-auth':
        $controller = new UserController();
        $controller->checkAuth();
        break;
    
    // ==================== ROTAS DE ASSINATURA ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->saveAssinatura();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas':
        $controller = new AssinaturaController($pdo);
        $controller->listAssinaturas();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->deleteAssinaturaByTitle();
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-assinatura\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new AssinaturaController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->updateAssinatura();
        break;

    // ==================== ROTAS DE PAGAMENTO ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/pagamento':
        $controller = new PagamentoController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-pagamento':
        $controller = new PagamentoController($pdo);
        $controller->savePagamento();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos':
        $controller = new PagamentoController($pdo);
        $controller->listPagamentos();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-pagamento':
        $controller = new PagamentoController($pdo);
        $controller->deletePagamentoById();
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-pagamento\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PagamentoController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-pagamento':
        $controller = new PagamentoController($pdo);
        $controller->updatePagamento();
        break;

    // ==================== ROTAS DE ROTEIRO ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/roteiro':
        $controller = new RoteiroController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-roteiro':
        $controller = new RoteiroController($pdo);
        $controller->saveRoteiro();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros':
        $controller = new RoteiroController($pdo);
        $controller->listRoteiros();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-roteiro':
        $controller = new RoteiroController($pdo);
        $controller->deleteRoteiroById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-roteiro\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new RoteiroController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-roteiro':
        $controller = new RoteiroController($pdo);
        $controller->updateRoteiro();
        break;

    // ==================== ROTAS DE SUPORTE ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/suporte':
        $controller = new SuporteController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-suporte':
        $controller = new SuporteController($pdo);
        $controller->saveSuporte();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes':
        $controller = new SuporteController($pdo);
        $controller->listSuportes();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-suporte':
        $controller = new SuporteController($pdo);
        $controller->deleteSuporteByTitle();
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-suporte\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new SuporteController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-suporte':
        $controller = new SuporteController($pdo);
        $controller->updateSuporte();
        break;

    // ==================== ROTAS DE PERSONAGEM ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/personagem':
        $controller = new PersonagemController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-personagem':
        $controller = new PersonagemController($pdo);
        $controller->savePersonagem();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-personagens':
        $controller = new PersonagemController($pdo);
        $controller->listPersonagens();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-personagem':
        $controller = new PersonagemController($pdo);
        $controller->deletePersonagemById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-personagem\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PersonagemController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-personagem':
        $controller = new PersonagemController($pdo);
        $controller->updatePersonagem();
        break;

    // ==================== ROTAS DE PERFIL ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil':
        $controller = new PerfilController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-perfil':
        $controller = new PerfilController($pdo);
        $controller->savePerfil();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils':
        // Implementação temporária para listar perfis
        echo json_encode(['message' => 'Funcionalidade de listar perfis será implementada em breve']);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-perfil':
        // Implementação temporária para deletar perfil
        echo json_encode(['message' => 'Funcionalidade de deletar perfil será implementada em breve']);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        // Implementação temporária para formulário de atualização
        echo json_encode(['message' => "Formulário de atualização para perfil ID $id será implementado em breve"]);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-perfil':
        $controller = new PerfilController($pdo);
        $controller->updatePerfil();
        break;

    // ==================== ROTAS DE PUBLICAR ====================
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar':
        $controller = new PublicarController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-publicar':
        $controller = new PublicarController($pdo);
        $controller->savePublicar();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicars':
        // Implementação temporária para listar publicações
        echo json_encode(['message' => 'Funcionalidade de listar publicações será implementada em breve']);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-publicar':
        $controller = new PublicarController($pdo);
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-publicar\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PublicarController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-publicar':
        $controller = new PublicarController($pdo);
        $controller->updatePublicar();
        break;
    
    // ==================== ROTA DEFAULT ====================
    default:
        // Verificar se é uma rota de autenticação usando strpos
        if (strpos($request, '/register') !== false) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new UserController();
                $controller->register();
            } else {
                http_response_code(405);
                echo "Método não permitido";
            }
        } elseif (strpos($request, '/login') !== false && strpos($request, '/logout') === false) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new UserController();
                $controller->login();
            } else {
                http_response_code(405);
                echo "Método não permitido";
            }
        } elseif (strpos($request, '/logout') !== false) {
            $controller = new UserController();
            $controller->logout();
        } elseif (strpos($request, '/check-auth') !== false) {
            $controller = new UserController();
            $controller->checkAuth();
        } else {
            // Página não encontrada
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Página não encontrada',
                'request' => $request,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }
        break;
}