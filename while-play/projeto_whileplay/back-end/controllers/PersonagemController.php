<?php

require_once '../models/Personagem.php';

class PersonagemController {

    public function showForm() {
        require '../views/personagens_form.php';
    }

    public function savePersonagem() {
        $id_sobre = $_POST['id_sobre'] ?? '';
        $mais_bem_avaliados = $_POST['mais_bem_avaliados'] ?? '';
        $lançados_recentemente = $_POST['lançados_recentemente'] ?? 0;
        $caminho_imagem = $_POST['caminho_imagem'] ?? null;

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

        $personagem = new Personagem();
        $personagem->save($id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem);

        header('Location: /while-play/projeto_whileplay/back-end/list-personagens');
        exit;
    }

    public function listPersonagens() {
        $personagem = new Personagem();
        $personagens = $personagem->getAll();
        require '../views/personagens_list.php';
    }

    public function deletePersonagemById($id) {
    if ($id) {
        $personagem = new Personagem();
        $personagem->deleteById($id);
    }

    header('Location: /while-play/projeto_whileplay/back-end/list-personagens');
    exit;
}


    public function showUpdateForm($id) {
        $personagem = new Personagem();
        $personagemInfo = $personagem->getById($id);
        require '../views/update_personagens_form.php';
    }

    public function updatePersonagem() {
        $id_sobre = $_POST['id_sobre'] ?? '';
        $mais_bem_avaliados = $_POST['mais_bem_avaliados'] ?? '';
        $lançados_recentemente = $_POST['lançados_recentemente'] ?? 0;
        $caminho_imagem = $_POST['caminho_imagem'] ?? null;

        $personagem = new Personagem();
        $personagemInfo = $personagem->getById($id);

        $caminho_imagem = $personagemInfo['caminho_imagem']; // manter imagem antiga por padrão

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
                if (!empty($personagemInfo['caminho_imagem']) && file_exists('../' . $personagemInfo['caminho_imagem'])) {
                    unlink('../' . $personagemInfo['caminho_imagem']);
                }
            }
        }

        $personagem->update($id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem);

        header('Location: /while-play/projeto_whileplay/back-end/list-personagens');
        exit;
    }
}
