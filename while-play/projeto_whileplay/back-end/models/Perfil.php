<?php

class Perfil {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Salvar novo perfil (tabela: perfil_novo)
    public function save($nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao) {
        // Verificar se o email já existe
        $checkEmail = $this->pdo->prepare("SELECT id FROM perfil WHERE email = ?");
        $checkEmail->execute([$email]);
        if ($checkEmail->fetch()) {
            throw new Exception("Este email já está cadastrado.");
        }

        // Verificar se o username já existe
        $checkUsername = $this->pdo->prepare("SELECT id FROM perfil WHERE username = ?");
        $checkUsername->execute([$username]);
        if ($checkUsername->fetch()) {
            throw new Exception("Este nome de usuário já está em uso.");
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO perfil_novo (nome_completo, username, email, senha, biografia, foto_url, data_criacao)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao]);
        
        return $this->pdo->lastInsertId(); // Retorna o ID do perfil criado
    }

    // Listar todos os perfis (tabela: perfil_novo)
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM perfil_novo ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obter perfil por ID (tabela: perfil_novo)
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM perfil_novo WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar perfil (tabela: perfil_novo)
    public function update($id, $nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao) {
        $stmt = $this->pdo->prepare("
            UPDATE perfil_novo
            SET nome_completo = ?, username = ?, email = ?, senha = ?, biografia = ?, foto_url = ?, data_criacao = ?
            WHERE id = ?
        ");
        $stmt->execute([$nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao, $id]);
    }

    // Deletar perfil por ID (tabela: perfil_novo)
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM perfil_novo WHERE id = ?");
        $stmt->execute([$id]);
    }
}

