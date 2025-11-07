<?php

require_once '../models/Personagem.php';
require_once '../config/database.php';

$database = new Database();
$pdo = $database->getConnection();

class PersonagemController {
    private $pdo;

    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function showForm() {
        require '../views/personagens_form.php';
    }

    public function savePersonagem() {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $usuario_id = $_SESSION['user_id'] ?? null; // Assumindo que você tem o ID do usuário na sessão

        // Upload da imagem
        $caminho_imagem = '';
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../imagens/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['imagem']['tmp_name'];
            $fileName = basename($_FILES['imagem']['name']);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('img_', true) . '.' . $ext;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Caminho relativo para salvar no banco, adaptado conforme estrutura do projeto
                $caminho_imagem = 'imagens/' . $newFileName;
            }
        }

        $personagem = new Personagem($this->pdo);
        $id_sobre = $personagem->save($nome, $descricao, $caminho_imagem, $usuario_id);

        header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/list');
        exit;
    }

    public function listPersonagens() {
        try {
            // Verifica autenticação se necessário
            // if (!isset($_SESSION['user_id'])) {
            //     header('Location: ' . BASE_URL . '/login');
            //     exit;
            // }

            // Instancia o modelo e busca os dados
            $personagem = new Personagem($this->pdo);
            $personagens = $personagem->getAll();

            // Garante que $personagens seja sempre um array
            if (!is_array($personagens)) {
                $personagens = [];
            }

            // Verifica se o arquivo da view existe
            $viewFile = '../views/personagens_list.php';
            if (!file_exists($viewFile)) {
                throw new Exception('View não encontrada: personagens_list.php');
            }

            // Inclui a view com os dados
            require $viewFile;

        } catch (PDOException $e) {
            // Log do erro (você pode implementar um sistema de log mais robusto)
            error_log('Erro ao listar personagens: ' . $e->getMessage());
            
            // Mensagem genérica para o usuário
            echo 'Ocorreu um erro ao carregar a lista de personagens. Por favor, tente novamente mais tarde.';
        } catch (Exception $e) {
            error_log('Erro: ' . $e->getMessage());
            echo 'Erro ao processar sua requisição. Por favor, contate o administrador.';
        }
    }

    public function deletePersonagemById($id_sobre) {
        if ($id_sobre) {
            // Primeiro recupera o personagem para pegar o caminho da imagem
            $personagem = new Personagem($this->pdo);
            $personagemInfo = $personagem->getById($id_sobre);

            // Se houver uma imagem, deleta ela também
            if (!empty($personagemInfo['caminho_imagem'])) {
                $imagemPath = '../' . $personagemInfo['caminho_imagem'];
                if (file_exists($imagemPath)) {
                    unlink($imagemPath);
                }
            }

            // Deleta o registro do banco
            $personagem->deleteById($id_sobre);
        }

        header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/list');
        exit;
    }


    public function showUpdateForm($id_sobre) {
        if (!$id_sobre) {
            die('ID do personagem não fornecido');
        }

        $personagem = new Personagem($this->pdo);
        $personagemInfo = $personagem->getById($id_sobre);

        if (!$personagemInfo) {
            die('Personagem não encontrado');
        }

        require '../views/update_personagens_form.php';
    }

    public function updatePersonagem() {
        // Captura os dados do POST
        $id_sobre = $_POST['id_sobre'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        
        // Busca informações atuais do personagem
        $personagem = new Personagem($this->pdo);

        // Busca informações atuais do personagem
        $personagemInfo = $personagem->getById($id_sobre);
        if (!$personagemInfo) {
            // Se não encontrar o personagem, redireciona para a lista
            header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/list');
            exit;
        }

        // Mantém os valores atuais caso não sejam fornecidos novos
        $nome = $nome ?: $personagemInfo['nome'];
        $descricao = $descricao ?: $personagemInfo['descricao'];
        $usuario_id = $personagemInfo['usuario_id']; // Mantém o usuário original
        $caminho_imagem = $personagemInfo['caminho_imagem'];

        // Se enviou nova imagem, fazer upload e atualizar caminho
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../imagens/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['imagem']['tmp_name'];
            $fileName = basename($_FILES['imagem']['name']);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('img_', true) . '.' . $ext;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $caminho_imagem = 'imagens/' . $newFileName;

                // Deletar imagem antiga do servidor
                if (!empty($personagemInfo['caminho_imagem'])) {
                    $oldImagePath = '../' . $personagemInfo['caminho_imagem'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
        }

        try {
            // Atualiza o personagem com todos os campos necessários
            if ($personagem->update($id_sobre, $nome, $descricao, $caminho_imagem, $usuario_id)) {
                // Redireciona para a lista após atualização bem-sucedida
                header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/list');
                exit;
            } else {
                // Se houver erro na atualização, volta para o formulário de edição
                header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/edit/' . $id_sobre);
                exit;
            }
        } catch (Exception $e) {
            // Log do erro
            error_log('Erro ao atualizar personagem: ' . $e->getMessage());
            // Redireciona para o formulário de edição em caso de erro
            header('Location: ' . (defined('BASE_URL') ? BASE_URL : '/GitHub/whileplay/while-play/projeto_whileplay/back-end/public') . '/personagens/edit/' . $id_sobre);
            exit;
        }
    }
}
