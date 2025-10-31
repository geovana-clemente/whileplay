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

            $perfil = new Perfil();
            $perfil->save($nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao);

            echo json_encode(['success' => true, 'message' => 'Perfil salvo com sucesso!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Atualizar perfil existente
    public function updatePerfil() {
        try {
            $id = $_POST['id'] ?? 0;
            $nome_completo = $_POST['nome_completo'] ?? '';
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $biografia = $_POST['biografia'] ?? '';
            $foto_url = $_POST['foto_url'] ?? '';
            $data_criacao = date('Y-m-d H:i:s');

            $perfil = new Perfil();
            $perfil->update($id, $nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao);

            echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
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
