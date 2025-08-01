<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregar controladores
require_once '../controllers/AssinaturaController.php';
require_once '../controllers/RoteiroController.php';
require_once '../controllers/PagamentoController.php';

// Capturar URL da requisição
$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/while-play/projeto_whileplay/back-end/public/assinatura':
        $controller = new AssinaturaController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-assinatura':
        $controller = new AssinaturaController();
        $controller->saveAssinatura();                    ;
        break;
    case '/while-play/projeto_whileplay/back-end/list-assinaturas':
        $controller = new AssinaturaController();
        $controller->listAssinaturas();
        break;
<<<<<<< HEAD
=======

>>>>>>> 715621e6d8a4db004afe063c377e17aa713a1758
        case '/while-play/projeto_whileplay/back-end/delete-assinatura':
            $controller = new AssinaturaController();
            $controller->deleteAssinaturaByTitle();
            break;
   
<<<<<<< HEAD
       case (preg_match('/\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-assinatura\/(\d+)/', $request, $matches) ? true : false):

=======
        case (preg_match('/\/while-play\/projeto_whileplay\/back-end\/update-assinatura\/(\d+)/', $request, $matches) ? true : false):
>>>>>>> 715621e6d8a4db004afe063c377e17aa713a1758
            $id = $matches[1];
            $controller = new AssinaturaController();
            $controller->showUpdateForm($id);
            break;
   
        case '/while-play/projeto_whileplay/back-end/update-assinatura':
            $controller = new AssinaturaController();
            $controller->updateAssinatura();
            break; 


            //pagamento
    case '/while-play/projeto_whileplay/back-end/public/pagamento':
        $controller = new PagamentoController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-pagamento':
        $controller = new PagamentoController();
        $controller->savePagamento();
        break;
    case '/while-play/projeto_whileplay/back-end/list-pagamentos':
        $controller = new PagamentoController();
        $controller->listPagamentos();
        break;
    case '/while-play/projeto_whileplay/back-end/delete-pagamento':
        $controller = new PagamentoController();
        $controller->deletePagamentoById();
        break;
<<<<<<< HEAD
   case (preg_match('/\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-pagamento\/(\d+)/', $request, $matches) ? true : false):

=======
     case (preg_match('/\/while-play\/projeto_whileplay\/back-end\/update-pagamento\/(\d+)/', $request, $matches) ? true : false):
>>>>>>> 715621e6d8a4db004afe063c377e17aa713a1758
        $id = $matches[1];
        $controller = new PagamentoController();
        $controller->showUpdateForm($id);
        break;
    case '/while-play/projeto_whileplay/back-end/update-pagamento':
        $controller = new PagamentoController();
        $controller->updatePagamento();
        break;

    // Roteiros
    case '/while-play/projeto_whileplay/back-end/public/roteiro':
        $controller = new RoteiroController();
        $controller->showForm();
        break;
        $controller = new RoteiroController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-roteiro':
        $controller = new RoteiroController();
        $controller->saveRoteiro();
        break;
    case '/while-play/projeto_whileplay/back-end/list-roteiros':
        $controller = new RoteiroController();
        $controller->listRoteiros();
        break;
    case '/while-play/projeto_whileplay/back-end/delete-roteiro':
        $controller = new RoteiroController();
        $controller->deleteRoteiroById($_POST['id'] ?? null);
        break;
<<<<<<< HEAD

   case (preg_match('/\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-roteiro\/(\d+)/', $request, $matches) ? true : false):
=======
   case (preg_match('/\/while-play\/projeto_whileplay\/back-end\/update-roteiro\/(\d+)/', $request, $matches) ? true : false):
>>>>>>> 715621e6d8a4db004afe063c377e17aa713a1758
        $id = $matches[1];
        $controller = new RoteiroController();
        $controller->showUpdateForm($id);
        break;
    case '/while-play/projeto_whileplay/back-end/update-roteiro':
        $controller = new RoteiroController();
        $controller->updateRoteiro();
        break;
    
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
}
