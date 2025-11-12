<?php

class User {
    private $conn;
    private $table_name = "perfil_novo"; // Tabela real utilizada no ambiente

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar novo usuário (tabela perfil_novo não precisa de coluna 'status')
    public function create($nome_completo, $username, $email, $senha) {
        $query = "INSERT INTO " . $this->table_name . " (nome_completo, username, email, senha) VALUES (:nome_completo, :username, :email, :senha)";
        $stmt = $this->conn->prepare($query);

        $nome_completo = htmlspecialchars(strip_tags($nome_completo));
        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));

        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Buscar usuário por email
    public function findByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por username
    public function findByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por ID
    public function findById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar se email já existe
    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Verificar se username já existe
    public function usernameExists($username) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Atualizar perfil do usuário
    public function updateProfile($id, $nome_completo, $username, $email, $biografia = null) {
        $query = "UPDATE " . $this->table_name . " SET nome_completo = :nome_completo, username = :username, email = :email, biografia = :biografia WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $nome_completo = htmlspecialchars(strip_tags($nome_completo));
        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));

        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':biografia', $biografia);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Atualizar senha
    public function updatePassword($id, $newPassword) {
        $query = "UPDATE " . $this->table_name . " SET senha = :senha WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt->bindParam(':senha', $hashedPassword);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Atualizar último login
    public function updateLastLogin($id) {
        try {
            $query = "UPDATE " . $this->table_name . " SET ultimo_login = NOW() WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (\Throwable $e) {
            // Coluna 'ultimo_login' pode não existir; ignorar silenciosamente
            return false;
        }
    }

    // Listar todos os usuários (para admin)
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desativar usuário
    public function deactivate($id) {
        // Se não houver coluna status, este método pode ser adaptado em outro momento
        return false;
    }

    // Deletar usuário
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}