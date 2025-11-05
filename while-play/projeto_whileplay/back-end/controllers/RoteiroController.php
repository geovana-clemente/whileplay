<?php

require_once '../models/Roteiro.php';

class RoteiroController
{
    /** Exibe o formulário de criação */
    public function showForm()
    {
        require '../views/roteiro_form.php';
    }

    /** Salva novo roteiro no banco */
    public function saveRoteiro()
    {
        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $categoria = $_POST['categoria'] ?? '';
            $visualizacoes = intval($_POST['visualizacoes'] ?? 0);
            $assinatura_id = !empty($_POST['assinatura_id']) ? intval($_POST['assinatura_id']) : null;
            
            // Variáveis lidas, mas não passadas ao Model, pois ele não as espera:
            $usuario_id = !empty($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null; 
            $publicado = isset($_POST['publicado']) ? 1 : 0; // A tabela 'roteiros' não usa este campo

            if (empty($titulo) || empty($categoria)) {
                throw new Exception("Título e categoria são obrigatórios.");
            }

            // Upload da imagem
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
            // ❌ CORREÇÃO: Passando APENAS 5 argumentos, conforme definido em Roteiro::save
            $roteiro->save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id);

            header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
            exit;
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                "erro" => "Não foi possível salvar o roteiro.",
                "detalhe" => $e->getMessage()
            ]);
            exit;
        }
    }

    /** Lista todos os roteiros */
    public function listRoteiros()
    {
        $roteiro = new Roteiro();
        $roteiros = $roteiro->getAll();
        require '../views/roteiro_list.php';
    }

    /** Deleta um roteiro pelo ID */
    public function deleteRoteiroById($id)
    {
        if ($id) {
            $roteiro = new Roteiro();
            $roteiro->deleteById($id);
        }

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
        exit;
    }

    /** Exibe o formulário de atualização */
    public function showUpdateForm($id)
    {
        $roteiro = new Roteiro();
        $roteiroInfo = $roteiro->getById($id);
        require '../views/update_roteiro_form.php';
    }

    /** Atualiza um roteiro existente */
    public function updateRoteiro()
    {
        try {
            $id = intval($_POST['id'] ?? 0);
            $titulo = trim($_POST['titulo'] ?? '');
            $categoria = $_POST['categoria'] ?? '';
            $visualizacoes = intval($_POST['visualizacoes'] ?? 0);
            $assinatura_id = !empty($_POST['assinatura_id']) ? intval($_POST['assinatura_id']) : null;
            
            // Variáveis lidas, mas não passadas ao Model, pois ele não as espera:
            $usuario_id = !empty($_POST['usuario_id']) ? intval($_POST['usuario_id']) : null; 
            $publicado = isset($_POST['publicado']) ? 1 : 0; // A tabela 'roteiros' não usa este campo

            $roteiro = new Roteiro();
            $roteiroInfo = $roteiro->getById($id);

            if (!$roteiroInfo) {
                throw new Exception("Roteiro não encontrado.");
            }

            $caminho_imagem = $roteiroInfo['caminho_imagem']; // mantém imagem antiga

            // Upload nova imagem
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

                    // Remove imagem antiga
                    if (!empty($roteiroInfo['caminho_imagem']) && file_exists('../' . $roteiroInfo['caminho_imagem'])) {
                        unlink('../' . $roteiroInfo['caminho_imagem']);
                    }
                }
            }

            // ❌ CORREÇÃO: Passando APENAS 6 argumentos, conforme definido em Roteiro::update
            $roteiro->update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id);

            header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
            exit;
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                "erro" => "Não foi possível atualizar o roteiro.",
                "detalhe" => $e->getMessage()
            ]);
            exit;
        }
    }
}
?>
