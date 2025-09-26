<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregar controladores
require_once '../controllers/AssinaturaController.php';
require_once '../controllers/RoteiroController.php';
require_once '../controllers/PagamentoController.php';
require_once '../controllers/PerfilController.php';
require_once '../controllers/PublicarController.php';
require_once '../controllers/PersonagemController.php';
require_once '../controllers/SuporteController.php';
require_once '../config/database.php'; // onde você define o $pdo



// Capturar URL da requisição
$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-assinatura':
        $controller = new AssinaturaController($pdo);
        $controller->saveAssinatura();                    ;
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


            //pagamento
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

    // Roteiros
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

        //Suporte
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


        //Personagem 
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

        //Perfil
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil':
        $controller = new PerfilController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-perfil':
        $controller = new PerfilController($pdo);
        $controller->savePerfil();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils':
        $controller = new PerfilController($pdo);
        $controller->listPerfis();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-perfil':
        $controller = new PerfilController($pdo);
        $controller->deletePerfilById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PerfilController($pdo);
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-perfil':
        $controller = new PerfilController($pdo);
        $controller->updatePerfil();
        break;

    
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;

    // Publicar
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar':
        $controller = new PublicarController($pdo);
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-publicar':
        $controller = new PublicarController($pdo);
        $controller->savePublicar();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicars':
        $controller = new PublicarController($pdo);
        $controller->listPublicars();
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
} 
