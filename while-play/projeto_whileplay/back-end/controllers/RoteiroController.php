<?php

require_once '../models/Roteiro.php';

class RoteiroController
{
    /** Exibe o formulário de criação */
    public function showForm()
    {
        // Neste contexto, showForm carregaria roteiro_form.php
        // require '../views/roteiro_form.php'; 
    }

    /** Salva novo roteiro no banco */
    public function saveRoteiro()
    {
        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $categoria = $_POST['categoria'] ?? '';
            $visualizacoes = intval($_POST['visualizacoes'] ?? 0);
            
            // Novos campos:
            $assinatura_id = !empty($_POST['assinatura_id']) ? intval($_POST['assinatura_id']) : null;
            $usuario_id = !empty($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null;
            $publicado = isset($_POST['publicado']) && $_POST['publicado'] == '1' ? 1 : 0; // Checkbox

            if (empty($titulo) || empty($categoria)) {
                throw new Exception("Título e categoria são obrigatórios.");
            }

            // Lógica de Upload da imagem (mantida)
            $caminho_imagem = null;
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../imagens/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileTmpPath = $_FILES['imagem']['tmp_name'];
                $fileName = basename($_FILES['imagem']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = uniqid('img_', true) . '.' . $ext;
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $caminho_imagem = 'imagens/' . $newFileName;
                }
            }

            $roteiro = new Roteiro();
            // ✅ CHAMADA CORRIGIDA: Agora com 7 argumentos, consistente com Roteiro::save
            $roteiro->save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado);

            // Redirecionamento de sucesso
            header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
            exit;
        } catch (Exception $e) {
            http_response_code(400);
            // Uso de echo simples para garantir visibilidade do erro no navegador em ambiente de desenvolvimento
            echo "<h1>Erro ao Salvar Roteiro</h1>";
            echo "<p style='color: red;'>Detalhe: " . htmlspecialchars($e->getMessage()) . "</p>";
            exit;
        }
    }

    /** Atualiza um roteiro existente */
    public function updateRoteiro()
    {
        try {
            $id = intval($_POST['id'] ?? 0);
            $titulo = trim($_POST['titulo'] ?? '');
            $categoria = $_POST['categoria'] ?? '';
            $visualizacoes = intval($_POST['visualizacoes'] ?? 0);
            
            // Novos campos:
            $assinatura_id = !empty($_POST['assinatura_id']) ? intval($_POST['assinatura_id']) : null;
            $usuario_id = !empty($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null;
            $publicado = isset($_POST['publicado']) && $_POST['publicado'] == '1' ? 1 : 0; // Checkbox

            $roteiro = new Roteiro();
            $roteiroInfo = $roteiro->getById($id);

            if (!$roteiroInfo) {
                throw new Exception("Roteiro não encontrado.");
            }

            $caminho_imagem = $roteiroInfo['caminho_imagem']; // mantém imagem antiga

            // Lógica de Upload nova imagem (mantida)
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../imagens/';
                // ... (lógica de upload e remoção da imagem antiga) ...
                $fileTmpPath = $_FILES['imagem']['tmp_name'];
                $fileName = basename($_FILES['imagem']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = uniqid('img_', true) . '.' . $ext;
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $caminho_imagem = 'imagens/' . $newFileName;
                    if (!empty($roteiroInfo['caminho_imagem']) && file_exists('../' . $roteiroInfo['caminho_imagem'])) {
                        unlink('../' . $roteiroInfo['caminho_imagem']);
                    }
                }
            }

            // ✅ CHAMADA CORRIGIDA: Agora com 8 argumentos (ID + 7 campos), consistente com Roteiro::update
            $roteiro->update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado);

            header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
            exit;
        } catch (Exception $e) {
            http_response_code(400);
            echo "<h1>Erro ao Atualizar Roteiro</h1>";
            echo "<p style='color: red;'>Detalhe: " . htmlspecialchars($e->getMessage()) . "</p>";
            exit;
        }
    }

    // ... listRoteiros, deleteRoteiroById, showUpdateForm (mantidos) ...
}
?>
