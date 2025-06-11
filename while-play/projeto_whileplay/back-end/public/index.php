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


    case '/meu_projeto/public/perfil':
        $controller = new PerfilController();
        $controller->showForm();
        break;

    case '/meu_projeto/save-perfil':    
        $controller = new PerfilController();
        $controller->savePerfil();
        break;

    case '/meu_projeto/list-perfils':
        $controller = new PerfilController();
        $controller->listPerfils();
        break;

    case '/meu_projeto/delete-perfil':
        $controller = new PerfilController();
        $controller->deletePerfilById($_GET['id'] ?? null); // <-- cuidado com parâmetro
        break;

    case (preg_match('/\/meu_projeto\/update-perfil\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PerfilController();
        $controller->showUpdateForm($id);
        break;

    case '/meu_projeto/update-perfil':
        $controller = new PerfilController();
        $controller->updatePerfil();
        break;


                    //pagamento
    case '/meu_projeto/public/personagem':
        $controller = new PersonagemController();
        $controller->showForm();
        break;
    case '/meu_projeto/save-personagem':
        $controller = new PersonagemController();
        $controller->savePersonagem();
        break;
    case '/meu_projeto/list-personagens':
        $controller = new PersonagemController();
        $controller->listPersonagens();
        break;
    case '/meu_projeto/delete-personagem':
        $controller = new PersonagemController();
        $controller->deletePersonagemById();
        break;
    case (preg_match('/\/meu_projeto\/update-personagem\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PersonagemController();
        $controller->showUpdateForm($id);
        break;
    case '/meu_projeto/update-personagem':
        $controller = new PersonagemController();
        $controller->updatePersonagem();
        break;

    // Publicar
    case '/meu_projeto/public/publicar':
        $controller = new PublicarController();
        $controller->showForm();
        break;
        $controller = new PublicarController();
        $controller->showForm();
        break;
    case '/meu_projeto/save-publicar':
        $controller = new PublicarController();
        $controller->savePublicar();
        break;
    case '/meu_projeto/list-publicados':
        $controller = new PublicarController();
        $controller->listPublicados();
        break;
    case '/meu_projeto/delete-publicar':
        $controller = new PublicarController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/meu_projeto\/update-publicar\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];
        $controller = new PublicarController();
        $controller->showUpdateForm($id);
        break;
    case '/meu_projeto/update-publicar':
        $controller = new PublicarController();
        $controller->updatePublicar();
        break; 


      //suporte
         case '/meu_projeto/public/suporte':
        $controller = new SuporteController();
        $controller->showForm();
        break;
        $controller = new SuporteController();
        $controller->showForm();
        break;
    case '/meu_projeto/save-suporte':
        $controller = new SuporteController();
        $controller->savePublicar();
        break;
    case '/meu_projeto/list-suportes':
        $controller = new SuporteController();
        $controller->listSuportes();
        break;
    case '/meu_projeto/delete-suporte':
        $controller = new SuporteController();
        $controller->deletePublicarById($_POST['id'] ?? null);
        break;
    case (preg_match('/\/meu_projeto\/update-suporte\/(\d+)/', $request, $matches) ? true : false):
        $id = $matches[1];  
        $controller = new SuporteController();
        $controller->showUpdateForm($id);
        break;
    case '/meu_projeto/update-suporte':
        $controller = new SuporteController();
        $controller->updateSuporte();
        break; 

   
    default:
        http_response_code(404);
        echo $request;
        echo "Página não encontrada.";
        break;
} 