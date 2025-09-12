<?php
require_once '../models/Perfil.php';

class PerfilController {

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
            $senha = $_POST['senha'] ?? ''; // pode ser vazio
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

    // Outros métodos (listar, deletar) podem permanecer iguais
}
