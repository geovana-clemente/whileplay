<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregar controladores
require_once '../controllers/AssinaturaController.php';
require_once '../controllers/RoteiroController.php';
require_once '../controllers/PagamentoController.php';
require_once '../controllers/PublicarController.php';

// Capturar URL da requisição
$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/while_play/public/assinatura':
        $controller = new AssinaturaController();
        $controller->showForm();
        break;
    case '/while_play/save-assinatura':
        $controller = new AssinaturaController();
        $controller->saveAssinatura();                    ;
        break;
    case '/while_play/list-assinaturas':
        $controller = new AssinaturaController();
        $controller->listAssinaturas();
        break;
        case '/while_play/delete-assinatura':
            require_once '../controllers/AssinaturaController.php';
            $controller = new AssinaturaController();
            $controller->deleteAssinaturaByTitle();
            break;
   
        case (preg_match('/\/while_play\/update-assinatura\/(\d+)/', $request, $matches) ? true : false):
            $id = $matches[1];
            require_once '../controllers/AssinaturaController.php';
            $controller = new AssinaturaController();
            $controller->showUpdateForm($id);
            break;
   
        case '/while_play/update-assinatura':
            require_once '../controllers/AssinaturaController.php';
            $controller = new AssinaturaController();
            $controller->updateAssinatura();
            break; 


            //pagamento
    case '/while_play/public/pagamento':
        $controller = new PagamentoController();
        $controller->showForm();
        break;
    case '/while_play/save-pagamento':
        $controller = new PagamentoController();
        $controller->savePagamento();
        break;
    case '/while_play/list-pagamentos':
        $controller = new PagamentoController();
        $controller->listPagamentos();
        break;
    case '/while_play/delete-pagamento':
        $controller = new PagamentoController();
        $controller->deletePagamentoById();
        break;
    case (preg_match('/\/while_play\/update-pagamento\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PagamentoController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-pagamento':
        $controller = new PagamentoController();
        $controller->updatePagamento();
        break;

    // Roteiros
    case '/while_play/public/roteiro':
        $controller = new RoteiroController();
        $controller->showForm();
        break;
        $controller = new RoteiroController();
        $controller->showForm();
        break;
    case '/while_play/save-roteiro':
        $controller = new RoteiroController();
        $controller->saveRoteiro();
        break;
    case '/while_play/list-roteiros':
        $controller = new RoteiroController();
        $controller->listRoteiros();
        break;
    case '/while_play/delete-roteiro':
        $controller = new RoteiroController();
        $controller->deleteRoteiroById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while_play\/update-roteiro\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new RoteiroController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-roteiro':
        $controller = new RoteiroController();
        $controller->updateRoteiro();
        break;
    
    // Publicar Projetos
    case '/while_play/public/publicar':
        $controller = new PublicarController();
        $controller->showForm();
        break;
    case '/while_play/save-publicar':
        $controller = new PublicarController();
        $controller->savePublicar();
        break;
    case '/while_play/list-publicados':
        $controller = new PublicarController();
        $controller->listPublicados();
        break;
    case '/while_play/delete-publicar':
        $controller = new PublicarController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while_play\/update-publicar\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PublicarController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-publicar':
        $controller = new PublicarController();
        $controller->updatePublicar();
        break;
    
    // Login
    case '/while_play/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../controllers/LoginController.php';
            $controller = new LoginController();
            $controller->authenticate();
        } else {
            require_once '../controllers/LoginController.php';
            $controller = new LoginController();
            $controller->showForm();
        }
        break;
    case '/while_play/logout':
        require_once '../controllers/LoginController.php';
        $controller = new LoginController();
        $controller->logout();
        break;
    case '/while_play/dashboard':
        include '../views/dashboard.php';
        break;
    // Cadastro
    case '/while_play/cadastro':
        require_once '../controllers/CadastroController.php';
        $controller = new CadastroController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->cadastrar();
        } else {
            $controller->showForm();
        }
        break;
    // Recuperar senha
    case '/while_play/recuperar-senha':
        require_once '../controllers/RecuperarSenhaController.php';
        $controller = new RecuperarSenhaController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->processForm();
        } else {
            $controller->showForm();
        }
        break;
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
}
