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
require_once '../controllers/PersonagemController.php';
require_once '../controllers/PublicarController.php';
require_once '../controllers/SuporteController.php';

echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'];
exit;


switch ($request) {
    case '/projeto_whilepla/public/assinatura':
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


    case '/while-play/projeto_whileplay/back-end/public/perfil':
        $controller = new PerfilController();
        $controller->showForm();
        break;

    case '/while-play/projeto_whileplay/back-end/save-perfil':    
        $controller = new PerfilController();
        $controller->savePerfil();
        break;

    case '/while-play/projeto_whileplay/back-end/list-perfils':
        $controller = new PerfilController();
        $controller->listPerfils();
        break;

    case '/while-play/projeto_whileplay/back-end/delete-perfil':
        $controller = new PerfilController();
        $controller->deletePerfilById($_GET['id'] ?? null); // <-- cuidado com parâmetro
        break;

    case (preg_match('/\/while-play/projeto_whileplay/back-end\/update-perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PerfilController();
        $controller->showUpdateForm($id);
        break;

    case '/while-play/projeto_whileplay/back-end/update-perfil':
        $controller = new PerfilController();
        $controller->updatePerfil();
        break;


                    //pagamento
    case '/while-play/projeto_whileplay/back-end/public/personagem':
        $controller = new PersonagemController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-personagem':
        $controller = new PersonagemController();
        $controller->savePersonagem();
        break;
    case '/while-play/projeto_whileplay/back-end/list-personagens':
        $controller = new PersonagemController();
        $controller->listPersonagens();
        break;
    case '/while-play/projeto_whileplay/back-end/delete-personagem':
        $controller = new PersonagemController();
        $controller->deletePersonagemById();
        break;
    case (preg_match('/\/while-play/projeto_whileplay/back-end\/update-personagem\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PersonagemController();
        $controller->showUpdateForm($id);
        break;
    case '/while-play/projeto_whileplay/back-end/update-personagem':
        $controller = new PersonagemController();
        $controller->updatePersonagem();
        break;

    // Publicar
    case '/while-play/projeto_whileplay/back-end/public/publicar':
        $controller = new PublicarController();
        $controller->showForm();
        break;
        $controller = new PublicarController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-publicar':
        $controller = new PublicarController();
        $controller->savePublicar();
        break;
    case '/while-play/projeto_whileplay/back-end/list-publicados':
        $controller = new PublicarController();
        $controller->listPublicados();
        break;
    case '/while-play/projeto_whileplay/back-end/delete-publicar':
        $controller = new PublicarController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while-play/projeto_whileplay/back-end\/update-publicar\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PublicarController();
        $controller->showUpdateForm($id);
        break;
    case '/while-play/projeto_whileplay/back-end/update-publicar':
        $controller = new PublicarController();
        $controller->updatePublicar();
        break; 


      //suporte
         case '/while-play/projeto_whileplay/back-end/public/suporte':
        $controller = new SuporteController();
        $controller->showForm();
        break;
        $controller = new SuporteController();
        $controller->showForm();
        break;
    case '/while-play/projeto_whileplay/back-end/save-suporte':
        $controller = new SuporteController();
        $controller->savePublicar();
        break;
    case '/while-play/projeto_whileplay/back-end/list-suportes':
        $controller = new SuporteController();
        $controller->listSuportes();
        break;
    case '/while-play/projeto_whileplay/back-end/delete-suporte':
        $controller = new SuporteController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while-play/projeto_whileplay/back-end\/update-suporte\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];  
        $controller = new SuporteController();
        $controller->showUpdateForm($id);
        break;
    case '/while-play/projeto_whileplay/back-end/update-suporte':
        $controller = new SuporteController();
        $controller->updateSuporte();
        break; 

   
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
} 