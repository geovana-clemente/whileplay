<?php

class Publicar {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO publicados (usuario_id, titulo, sinopse, tipo, arquivo_url, data_criacao, publicado)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM publicados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM publicados WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            UPDATE publicados
            SET usuario_id = ?, titulo = ?, sinopse = ?, tipo = ?, arquivo_url, data_criacao, publicado = ?
            WHERE id = ?
        ");
        $stmt->execute([$usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado, $id]);
    }

    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM publicados WHERE id = ?");
        $stmt->execute([$id]);
    }
}
