<?php

require_once '../models/Perfil.php';

class PerfilController {

    public function showForm() {
        require '../views/perfil_form.php';
    }

    public function savePerfil() {
        $nome_completo = $_POST['nome_completo'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? 0;
        $senha = $_POST['senha'] ?? null;
        $biografia = $_POST['biografia'] ?? ''; 
        $data_criacao = $_POST['data_criacao'] ?? '';


        // Upload da imagem
        $foto_url = '';
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
                $foto_url = 'imagens/' . $newFileName;
            }
        }

        $perfil = new Perfil();
        $perfil->save($nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils');
        exit;
    }

    public function listPerfils() {
        $perfil = new Perfil();
        $perfils = $perfil->getAll();
        require '../views/perfil_list.php';
    }

    public function deletePerfilById($id) {
    if ($id) {
        $perfil = new Perfil();
        $perfil->deleteById($id);
    }

    header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/perfil_list.php');
    exit;
}


    public function showUpdateForm($id) {
        $perfil = new Perfil();
        $perfilInfo = $perfil->getById($id);
        require '../views/update_perfil_form.php';
    }

    public function updatePerfil() {
        $id = $_POST['id'] ?? null;
        $nome_completo = $_POST['nome_completo'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? 0;
        $senha = $_POST['senha'] ?? null;
        $biografia = $_POST['biografia'] ?? ''; 
        $data_criacao = $_POST['data_criacao'] ?? '';

        $perfil = new Perfil();
        $perfilInfo = $perfil->getById($id);

        $foto_url = $perfilInfo['foto_url']; // manter imagem antiga por padrão

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
                $foto_url = 'imagens/' . $newFileName;

                // Opcional: deletar imagem antiga do servidor para evitar lixo
                if (!empty($perfilInfo['foto_url']) && file_exists('../' . $perfilInfo['foto_url'])) {
                    unlink('../' . $perfilInfo['foto_url']);
                }
            }
        }

        $perfil->update($id, $nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils');
        exit;
    }
}
