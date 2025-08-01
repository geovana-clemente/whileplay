<?php

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregar controladores
require_once '../controllers/AssinaturaController.php';
require_once '../controllers/RoteiroController.php';
require_once '../controllers/PagamentoController.php';
<<<<<<< HEAD
require_once '../controllers/SuporteController.php';
require_once '../controllers/PublicarController.php';
require_once '../controllers/PersonagemController.php';
require_once '../controllers/PerfilController.php';
=======
require_once '../controllers/PerfilController.php';
require_once '../controllers/PersonagensController.php';
require_once '../controllers/PublicarController.php';
require_once '../controllers/SuporteController.php';
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1

// Capturar URL da requisição
$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/assinatura':
        $controller = new AssinaturaController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-assinatura':
        $controller = new AssinaturaController();
        $controller->saveAssinatura();                    ;
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas':
        $controller = new AssinaturaController();
        $controller->listAssinaturas();
        break;

        case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-assinatura':
            $controller = new AssinaturaController();
            $controller->deleteAssinaturaByTitle();
            break;
   
        case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-assinatura\/(\d+)/', $request, $matches) ? true : false):
            $id = $matches[1];
            $controller = new AssinaturaController();
            $controller->showUpdateForm($id);
            break;
   
        case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-assinatura':
            $controller = new AssinaturaController();
            $controller->updateAssinatura();
            break; 


            //pagamento
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/pagamento':
        $controller = new PagamentoController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-pagamento':
        $controller = new PagamentoController();
        $controller->savePagamento();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos':
        $controller = new PagamentoController();
        $controller->listPagamentos();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-pagamento':
        $controller = new PagamentoController();
        $controller->deletePagamentoById();
        break;
     case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-pagamento\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PagamentoController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-pagamento':
        $controller = new PagamentoController();
        $controller->updatePagamento();
        break;

    // Roteiros
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/roteiro':
        $controller = new RoteiroController();
        $controller->showForm();
        break;
<<<<<<< HEAD
        $controller = new RoteiroController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-roteiro':
=======
    case 'whileplay/while-play/projeto_whileplay/back-end/save-roteiro':
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        $controller = new RoteiroController();
        $controller->saveRoteiro();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros':
        $controller = new RoteiroController();
        $controller->listRoteiros();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-roteiro':
        $controller = new RoteiroController();
        $controller->deleteRoteiroById($_POST['id'] ?? null);
        break;
   case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-roteiro\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new RoteiroController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-roteiro':
        $controller = new RoteiroController();
        $controller->updateRoteiro();
        break;


<<<<<<< HEAD
        //Suporte
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/suporte':
        $controller = new SuporteController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-suporte':
        $controller = new SuporteController();
        $controller->saveSuporte();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes':
        $controller = new SuporteController();
        $controller->listSuportes();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-suporte':
        $controller = new SuporteController();
        $controller->deleteSuporteByTitle();
        break;
     case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-suporte\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new SuporteController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-suporte':
        $controller = new SuporteController();
        $controller->updateSuporte();
        break;

        //Publicar
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar':
        $controller = new PublicarController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-publicar':
        $controller = new PublicarController();
        $controller->savePublicar();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados':
        $controller = new PublicarController();
        $controller->listPublicados();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-publicar':
        $controller = new PublicarController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-publicar\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PublicarController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-publicar':
        $controller = new PublicarController();
        $controller->updatePublicar();
        break;

        //Personagem 
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/personagem':
        $controller = new PersonagemController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-personagem':
        $controller = new PersonagemController();
        $controller->savePersonagem();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-personagens':
        $controller = new PersonagemController();
        $controller->listPersonagens();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-personagem':
        $controller = new PersonagemController();
        $controller->deletePersonagemById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-personagem\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PersonagemController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-personagem':
        $controller = new PersonagemController();
        $controller->updatePersonagem();
        break;

        //Perfil
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil':
        $controller = new PerfilController();
        $controller->showForm();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-perfil':
        $controller = new PerfilController();
        $controller->savePerfil();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils':
        $controller = new PerfilController();
        $controller->listPerfis();
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-perfil':
        $controller = new PerfilController();
        $controller->deletePerfilById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/GitHub\/whileplay\/while-play\/projeto_whileplay\/back-end\/update-perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PerfilController();
        $controller->showUpdateForm($id);
        break;
    case '/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-perfil':
        $controller = new PerfilController();
        $controller->updatePerfil();
        break;

    
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
=======
    case '/while_play/public/Perfil':
        $controller = new PerfilController();
        $controller->showForm();
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        break;
    case '/while_play/save-Perfil':
        $controller = new PerfilController();
        $controller->savePerfil();
        break;
    case '/while_play/list-assinaturas':
        $controller = new PerfilController();
        $controller->listPerfils();
        break;
    case '/while_play/delete-Perfil':
        $controller = new PerfilController();
        $controller->deletePerfilById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while_play\/update-Perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PerfilController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-Perfil':
        $controller = new PerfilController();
        $controller->updatePerfil();
        break;
    // Publicar
    case '/while_play/public/publicar':
        $controller = new PublicarController();
        $controller->showForm();
        break;
    case '/while_play/save-publicar':
        $controller = new PublicarController();
        $controller->savePublicar();
        break;
    case '/while_play/list-publicar':
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
    // Personagens
    case '/while_play/public/personagens':
        $controller = new PersonagemController();
        $controller->showForm();
        break;
    case '/while_play/save-personagens':
        $controller = new PersonagemController();
        $controller->savePersonagem();
        break;
    case '/while_play/list-personagens':
        $controller = new PersonagemController();
        $controller->listPersonagens();
        break;
    case '/while_play/delete-personagens':
        $controller = new PersonagemController();
        $controller->deletePersonagemById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/while_play\/update-personagens\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PersonagemController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-personagens':
        $controller = new PersonagemController();
        $controller->updatePersonagem();
        break;
    // Suporte
    case '/while_play/public/suporte':
        $controller = new SuporteController();
        $controller->showForm();
        break;
    case '/while_play/save-suporte':
        $controller = new SuporteController();
        $controller->saveSuporte();
        break;
    case '/while_play/list-suporte':
        $controller = new SuporteController();
        $controller->listSuportes();
        break;
    case '/while_play/delete-suporte':
        $controller = new SuporteController();
        $controller->deleteSuporteByTitle();
        break;
    case (preg_match('/\/while_play\/update-suporte\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new SuporteController();
        $controller->showUpdateForm($id);
        break;
    case '/while_play/update-suporte':
        $controller = new SuporteController();
        $controller->updateSuporte();
        break;
        
        default:
            http_response_code(404);
            echo $request;
            echo "Página não encontrada.";
            break;
    }
