<?php
require_once __DIR__ . '/../models/Publicar.php';

class PublicarController {
    private $pdo;

    public function __construct($pdo = null) {
        $this->pdo = $pdo;
    }

    // Exibir formulário de criação (se existir)
    public function showForm() {
        include __DIR__ . '/../views/publicar_form.php';
    }

    // Criar nova publicação a partir de POST
    public function criar() {
        try {
            $dados = $_POST;
            $publicar = new Publicar();
            $id = $publicar->criar($dados);
            echo json_encode(['success' => true, 'message' => 'Publicação criada com sucesso!', 'id' => $id]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Listar publicações
    public function listar() {
        try {
            $publicar = new Publicar();
            $rows = $publicar->listar();
            // Se existir uma view de listagem, podemos incluir; caso contrário retornamos JSON
            if (file_exists(__DIR__ . '/../views/publicar_list.php')) {
                $publicacoes = $rows;
                include __DIR__ . '/../views/publicar_list.php';
            } else {
                echo json_encode($rows);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Buscar por id e exibir (ou retornar JSON)
    public function buscarPorId($id) {
        try {
            $publicar = new Publicar();
            $item = $publicar->buscarPorId($id);
            if (!$item) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Publicação não encontrada']);
                return;
            }
            echo json_encode($item);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Atualizar publicação por id
    public function atualizar($id) {
        try {
            $dados = $_POST;
            $publicar = new Publicar();
            $rows = $publicar->atualizar($id, $dados);
            if (!$rows) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Publicação não encontrada']);
                return;
            }
            echo json_encode(['success' => true, 'message' => 'Publicação atualizada com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Deletar publicação por id
    public function deletar($id) {
        try {
            $publicar = new Publicar();
            $rows = $publicar->deletar($id);
            if (!$rows) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Publicação não encontrada']);
                return;
            }
            echo json_encode(['success' => true, 'message' => 'Publicação excluída com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // --- Methods expected by the router in public/index.php ---
    public function savePublicar() {
        // expects POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método não permitido';
            return;
        }
        $post = $_POST;
    $publicar = new Publicar();
    $publicar->criar($post);
    header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/public/list-publicar');
        exit;
    }

    public function listPublicars() {
        $publicar = new Publicar();
        $rows = $publicar->listar();
        $publicacoes = $rows;
        include __DIR__ . '/../views/publicar_list.php';
    }

    public function deletePublicarById($id) {
        if (empty($id)) {
            header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/public/list-publicar');
            exit;
        }
        $publicar = new Publicar();
        $publicar->deletar($id);
    header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/public/list-publicar');
        exit;
    }

    public function showUpdateForm($id) {
        $publicar = new Publicar();
        $publicarInfo = $publicar->buscarPorId($id);
        include __DIR__ . '/../views/update_publicar_form.php';
    }

    public function updatePublicar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método não permitido';
            return;
        }
        $post = $_POST;
        $id = !empty($post['id']) ? (int)$post['id'] : null;
        if ($id) {
            $publicar = new Publicar();
            $publicar->atualizar($id, $post);
        }
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicars');
        exit;
    }

}

