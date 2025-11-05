<?php
require_once '../models/Perfil.php';

class PerfilController {

    // Exibir formulário de criação de perfil
    public function showForm() {
        include __DIR__ . '/../views/perfil_form.php';
    }

    // Salvar novo perfil
    public function savePerfil() {
        try {
            $nome_completo = $_POST['nome_completo'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $biografia = $_POST['biografia'] ?? '';
            $foto_url = $_POST['foto_url'] ?? '';
            $data_criacao = date('Y-m-d H:i:s');

            if (empty($senha)) {
                throw new Exception("A senha é obrigatória.");
            }

            // Hash da senha antes de salvar
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $perfil = new Perfil();
            $perfil->save($nome_completo, $username, $email, $senhaHash, $biografia, $foto_url, $data_criacao);

            // Se a requisição for AJAX, retornamos JSON; caso contrário, redirecionamos para a lista
            $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                     || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

            if ($isAjax) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => true, 'message' => 'Perfil salvo com sucesso!']);
                exit;
            } else {
                header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils');
                exit;
            }
        } catch (Exception $e) {
            // Retornar JSON em caso de AJAX, senão mostrar mensagem simples e redirecionar
            $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                     || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

            if ($isAjax) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            } else {
                // Para requisições normais, podemos salvar a mensagem de erro em sessão ou apenas mostrar
                echo '<p>Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
                echo '<p><a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil">Voltar</a></p>';
                exit;
            }
        }
    }

    // Atualizar perfil existente
    public function updatePerfil() {
        try {
            $id = $_POST['id'] ?? 0;

            $perfil = new Perfil();
            $perfilInfo = $perfil->getById($id);
            if (!$perfilInfo) {
                throw new Exception('Perfil não encontrado.');
            }

            // Campos editáveis — se não vierem no POST, manter os valores atuais
            $nome_completo = $_POST['nome_completo'] ?? $perfilInfo['nome_completo'];
            $username = $_POST['username'] ?? $perfilInfo['username'];
            $email = $_POST['email'] ?? $perfilInfo['email'];
            $biografia = $_POST['biografia'] ?? $perfilInfo['biografia'];

            // Data de criação: manter a original se o usuário não enviar uma nova
            $data_criacao = $_POST['data_criacao'] ?? $perfilInfo['data_criacao'];

            // Senha: se campo vazio, manter; caso contrário, aplicar hash
            if (!empty($_POST['senha'])) {
                $senhaParaSalvar = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            } else {
                $senhaParaSalvar = $perfilInfo['senha'];
            }

            // Imagem: processar upload se houver; senão manter a anterior
            $foto_url = $perfilInfo['foto_url'] ?? '';
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../imagens/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileTmpPath = $_FILES['imagem']['tmp_name'];
                $fileName = basename($_FILES['imagem']['name']);
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = uniqid('perfil_', true) . '.' . $ext;
                $destPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // definir caminho relativo salvo no banco
                    $newFotoUrl = 'imagens/' . $newFileName;
                    // remover imagem antiga do servidor (opcional)
                    if (!empty($perfilInfo['foto_url']) && file_exists(__DIR__ . '/../' . $perfilInfo['foto_url'])) {
                        @unlink(__DIR__ . '/../' . $perfilInfo['foto_url']);
                    }
                    $foto_url = $newFotoUrl;
                }
            }

            $perfil->update($id, $nome_completo, $username, $email, $senhaParaSalvar, $biografia, $foto_url, $data_criacao);

            // Resposta — suportar AJAX e requisições normais
            $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                     || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

            if ($isAjax) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
                exit;
            } else {
                header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils');
                exit;
            }
        } catch (Exception $e) {
            $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
                     || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
            if ($isAjax) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            } else {
                echo '<p>Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
                echo '<p><a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils">Voltar</a></p>';
                exit;
            }
        }
    }

    // Listar todos os perfis
    public function listPerfis() {
        $perfil = new Perfil();
        $perfis = $perfil->getAll();
        include __DIR__ . '/../views/perfil_list.php';
    }

    // Deletar perfil por ID
    public function deletePerfilById($id) {
        if ($id) {
            $perfil = new Perfil();
            $perfil->deleteById($id);
        }
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils');
        exit;
    }

    // Exibir formulário de atualização de perfil
    public function showUpdateForm($id) {
        $perfil = new Perfil();
        $perfilInfo = $perfil->getById($id);
        include __DIR__ . '/../views/update_perfil_form.php';
    }
}
