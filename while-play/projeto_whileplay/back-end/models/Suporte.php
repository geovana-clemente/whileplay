<?php

class Suporte {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($usuario_id, $mensagem, $data_envio) {
        $stmt = $this->pdo->prepare("INSERT INTO suportes (usuario_id, mensagem, data_envio) VALUES (?, ?, ?)");
        $stmt->execute([$usuario_id, $mensagem, $data_envio]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM suportes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByTitle($usuario_id) {
        $stmt = $this->pdo->prepare("DELETE FROM suportes WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM suportes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $usuario_id, $mensagem, $data_envio) {
        $stmt = $this->pdo->prepare("UPDATE suportes SET usuario_id = ?, mensagem = ?, data_envio = ? WHERE id = ?");
        $stmt->execute([$usuario_id, $mensagem, $data_envio, $id]);
    }
}

