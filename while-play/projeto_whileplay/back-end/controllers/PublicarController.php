<?php

require_once '../models/Publicar.php';

class PublicarController {

    public function showForm() {
        require '../views/publicar_form.php';
    }

    public function savePublicar() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $email = $_POST['email'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? '';
        $tipo = $_POST['tipo'] ?? null;
        $data_criacao = $_POST['data_criacao'] ?? date('Y-m-d');
        $publicado = $_POST['publicado'] ?? '';


        // Upload do arquivo (PNG ou DOC)
        $arquivo_url = '';
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../imagens/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['arquivo']['tmp_name'];
            $fileName = basename($_FILES['arquivo']['name']);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($ext, ['png', 'doc', 'docx'])) {
                $newFileName = uniqid('file_', true) . '.' . $ext;
                $destPath = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $arquivo_url = 'imagens/' . $newFileName;
                }
            }
        }

        $publicar = new Publicar();
        $publicar->save($usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);

<<<<<<< HEAD
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
=======
        header('Location: /while_play/list-publicados');
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
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
        header('Location: /while_play/list-publicados');
        exit;
    }

<<<<<<< HEAD
    header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
    exit;
}


=======
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
    public function showUpdateForm($id) {
        $publicar = new Publicar();
        $publicarInfo = $publicar->getById($id);
        require '../views/update_publicar_form.php';
    }

    public function updatePublicar() {
        $id = $_POST['id'] ?? '';
        $usuario_id = $_POST['usuario_id'] ?? '';
        $email = $_POST['email'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? '';
        $tipo = $_POST['tipo'] ?? null;
        $data_criacao = $_POST['data_criacao'] ?? '';
        $publicado = $_POST['publicado'] ?? '';

        $publicar = new Publicar();
        $perfilInfo = $publicar->getById($id);
        $arquivo_url = $perfilInfo['arquivo_url'];

        // Se enviou novo arquivo, fazer upload e atualizar caminho
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../imagens/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['arquivo']['tmp_name'];
            $fileName = basename($_FILES['arquivo']['name']);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($ext, ['png', 'doc', 'docx'])) {
                $newFileName = uniqid('file_', true) . '.' . $ext;
                $destPath = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $arquivo_url = 'imagens/' . $newFileName;
                    if (!empty($perfilInfo['arquivo_url']) && file_exists('../' . $perfilInfo['arquivo_url'])) {
                        unlink('../' . $perfilInfo['arquivo_url']);
                    }
                }
            }
        }

<<<<<<< HEAD
        $publicar->update($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
=======
        $publicar->update($id, $usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);
        header('Location: /while_play/list-publicados');
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        exit;
    }
}
