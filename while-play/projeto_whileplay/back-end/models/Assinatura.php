<?php

class Assinatura {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Substituí 'nome' por 'usuario_id'
    public function save($usuario_id, $cidade, $endereco, $cep, $cpf, $data_assinatura) {
        $stmt = $this->pdo->prepare("
            INSERT INTO assinaturas (usuario_id, cidade, endereco, cep, cpf, data_assinatura) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$usuario_id, $cidade, $endereco, $cep, $cpf, $data_assinatura]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM assinaturas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Substituí 'nome' por 'usuario_id'
    public function deleteByUserId($usuario_id) {
        $stmt = $this->pdo->prepare("DELETE FROM assinaturas WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM assinaturas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Substituí 'nome' por 'usuario_id'
    public function update($id, $usuario_id, $cidade, $endereco, $cep, $cpf, $data_assinatura) {
        $stmt = $this->pdo->prepare("
            UPDATE assinaturas 
            SET usuario_id = ?, cidade = ?, endereco = ?, cep = ?, cpf = ?, data_assinatura = ? 
            WHERE id = ?
        ");
        $stmt->execute([$usuario_id, $cidade, $endereco, $cep, $cpf, $data_assinatura, $id]);
    }
}