<?php

require_once '../models/Publicar.php';

class PublicarController {

    public function showForm() {
        require '../views/publicar_form.php';
    }

    public function savePublicar() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? 0;
        $tipo = $_POST['tipo'] ?? null;
        $data_criacao = $_POST['data_criacao'] ?? ''; 
        $publicado = $_POST['publicado'] ?? '';


        // Upload da imagem
        $arquivo_url = '';
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
                $arquivo_url = 'imagens/' . $newFileName;
            }
        }

        $publicar = new Publicar();
        $publicar->save($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
        exit;
    }

    public function listPublicados() {
        $publicar = new Publicar();
        $publicados = $publicar->getAll();
        require '../views/publicar_list.php';
    }

    public function deletePublicarById($id) {
    if ($id) {
        $publicar = new Publicar();
        $publicar->deleteById($id);
    }

    header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
    exit;
}


    public function showUpdateForm($id) {
        $publicar = new Publicar();
        $publicarInfo = $publicar->getById($id);
        require '../views/update_publicar_form.php';
    }

    public function updatePublicar() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? 0;
        $tipo = $_POST['tipo'] ?? null;
        $data_criacao = $_POST['data_criacao'] ?? '';
        $publicado = $_POST['publicado'] ?? '';

        $publicar = new Publicar();
        $perfilInfo = $publicar->getById($id);

        $arquivo_url = $perfilInfo['arquivo_url']; // manter imagem antiga por padrão

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
                $arquivo_url = 'imagens/' . $newFileName;

                // Opcional: deletar imagem antiga do servidor para evitar lixo
                if (!empty($perfilInfo['arquivo_url']) && file_exists('../' . $perfilInfo['arquivo_url'])) {
                    unlink('../' . $perfilInfo['arquivo_url']);
                }
            }
        }

        $publicar->update($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
        exit;
    }
}
