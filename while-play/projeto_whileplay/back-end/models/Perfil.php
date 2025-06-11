<?php

class Perfil {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao) {
        $stmt = $this->pdo->prepare("
            INSERT INTO perfil (nome_completo, username, email, senha, biografia, foto_url, data_criacao)
            VALUES (?, ?, ?, ?, ?,?,?)
        ");
        $stmt->execute([$nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM perfil");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM perfil WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacao) {
        $stmt = $this->pdo->prepare("
            UPDATE perfil
            SET nome_completo = ?, username = ?, email = ?, senha = ?, biografia, foto_url = ?, data_criacao = ?
            WHERE id = ?
        ");
        $stmt->execute([$nome_completo, $username, $email, $senha, $biografia, $foto_url, $data_criacrao, $id]);
    }

    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM perfil WHERE id = ?");
        $stmt->execute([$id]);
    }
}
