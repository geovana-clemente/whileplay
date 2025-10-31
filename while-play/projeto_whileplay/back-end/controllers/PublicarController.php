<?php

require_once '../models/Publicar.php';

class PublicarController {

    public function showForm() {
        require '../views/publicar_form.php';
    }

    public function savePublicar() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $sinopse = $_POST['sinopse'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        $data_criacao = $_POST['data_criacao'] ?? '';
        $publicado = $_POST['publicado'] ?? '';

        // Validação do usuario_id
        $pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        if ($stmt->rowCount() == 0) {
            die("Erro: Usuário não encontrado. Informe um ID de usuário válido.");
        }


        // Upload do arquivo (imagem ou roteiro)
        $arquivo_url = '';
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../imagens/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['arquivo']['tmp_name'];
            $fileName = basename($_FILES['arquivo']['name']);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('arq_', true) . '.' . $ext;
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

    // Alias para compatibilidade com rota antiga
    public function listPublicars() {
        $this->listPublicados();
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
    $id = $_POST['id'] ?? null;

    if ($id === null) {
        die('ID não fornecido para atualização.');
    }

    $usuario_id = $_POST['usuario_id'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $sinopse = $_POST['sinopse'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $data_criacao = $_POST['data_criacao'] ?? '';
    $publicado = $_POST['publicado'] ?? '';

    $publicar = new Publicar();
    $perfilInfo = $publicar->getById($id);

    if (!$perfilInfo) {
        die("Publicação com ID $id não encontrada.");
    }

    // Manter imagem antiga por padrão
    $arquivo_url = $perfilInfo['arquivo_url'];

    // Se enviou nova imagem
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

            // Deletar imagem antiga (opcional)
            $oldPath = '../' . $perfilInfo['arquivo_url'];
            if (!empty($perfilInfo['arquivo_url']) && file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
    }

    // Atualiza os dados no banco
    $publicar->update($id, $usuario_id, $titulo, $sinopse, $tipo, $data_criacao, $arquivo_url, $publicado);

    // Redirecionar após salvar
    header('Location: /');
    exit;
    // public function updatePublicar() {
    //     $usuario_id = $_POST['usuario_id'] ?? '';
    //     $titulo = $_POST['titulo'] ?? '';
    //     $sinopse = $_POST['sinopse'] ?? 0;
    //     $tipo = $_POST['tipo'] ?? null;
    //     $data_criacao = $_POST['data_criacao'] ?? '';
    //     $publicado = $_POST['publicado'] ?? '';

    //     $publicar = new Publicar();
    //     $perfilInfo = $publicar->getById($id);

    //     $arquivo_url = $perfilInfo['arquivo_url']; // manter imagem antiga por padrão

    //     // Se enviou nova imagem, fazer upload e atualizar caminho
    //     if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    //         $uploadDir = '../imagens/';
    //         if (!is_dir($uploadDir)) {
    //             mkdir($uploadDir, 0755, true);
    //         }
    //         $fileTmpPath = $_FILES['imagem']['tmp_name'];
    //         $fileName = basename($_FILES['imagem']['name']);
    //         $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    //         $newFileName = uniqid('img_', true) . '.' . $ext;
    //         $destPath = $uploadDir . $newFileName;

    //         if (move_uploaded_file($fileTmpPath, $destPath)) {
    //             $arquivo_url = 'imagens/' . $newFileName;

    //             // Opcional: deletar imagem antiga do servidor para evitar lixo
    //             if (!empty($perfilInfo['arquivo_url']) && file_exists('../' . $perfilInfo['arquivo_url'])) {
    //                 unlink('../' . $perfilInfo['arquivo_url']);
    //             }
    //         }
    //     }

    //     $publicar->update($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado);

    //     header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-publicados');
    //     exit;
    // }
}
}