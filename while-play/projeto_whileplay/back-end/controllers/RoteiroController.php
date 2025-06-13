<?php

require_once '../models/Roteiro.php';

class RoteiroController {

    public function showForm() {
        require '..back-end/views/roteiro_form.php'; 
    }

    public function saveRoteiro() {
        $titulo = $_POST['titulo'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $visualizacoes = $_POST['visualizacoes'] ?? 0;
        $assinatura_id = $_POST['assinatura_id'] ?? null;

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

        $roteiro = new Roteiro();
        $roteiro->save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id);

        header('Location: /while-play/projeto_whileplay/back-end/list-roteiros');
        exit;
    }

    public function listRoteiros() {
        $roteiro = new Roteiro();
        $roteiros = $roteiro->getAll();
        require '..back-end/views/roteiro_list.php';
    }

    public function deleteRoteiroById($id) {
    if ($id) {
        $roteiro = new Roteiro();
        $roteiro->deleteById($id);
    }

    header('Location: /while-play/projeto_whileplay/back-end/list-roteiros');
    exit;
}


    public function showUpdateForm($id) {
        $roteiro = new Roteiro();
        $roteiroInfo = $roteiro->getById($id);
        require '..back-end/views/update_roteiro_form.php';
    }

    public function updateRoteiro() {
        $id = $_POST['id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $visualizacoes = $_POST['visualizacoes'] ?? 0;
        $assinatura_id = $_POST['assinatura_id'] ?? null;

        $roteiro = new Roteiro();
        $roteiroInfo = $roteiro->getById($id);

        $caminho_imagem = $roteiroInfo['caminho_imagem']; // manter imagem antiga por padrão

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

                // Opcional: deletar imagem antiga do servidor para evitar lixo
                if (!empty($roteiroInfo['caminho_imagem']) && file_exists('../' . $roteiroInfo['caminho_imagem'])) {
                    unlink('../' . $roteiroInfo['caminho_imagem']);
                }
            }
        }

        $roteiro->update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id);

        header('Location: /while-play/projeto_whileplay/back-end/list-roteiros');
        exit;
    }
}


