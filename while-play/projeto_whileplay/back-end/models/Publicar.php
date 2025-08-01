<?php

class Publicar {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

<<<<<<< HEAD
    // Salvar publicação
    public function save($usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO publicados (usuario_id, titulo, sinopse, tipo, arquivo_url, data_criacao, publicado)
            VALUES (?, ?, ?, ?, ?, ?, ?)
=======
    // Adicionando campo email
    public function save($usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            INSERT INTO publicados (usuario_id, email, titulo, sinopse, tipo, arquivo_url, data_criacao, publicado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        ");
        $stmt->execute([$usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado]);
    }

    // Buscar todos
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM publicados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM publicados WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
    // Atualizar publicação
    public function update($id, $usuario_id, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            UPDATE publicados
            SET usuario_id = ?, titulo = ?, sinopse = ?, tipo = ?, arquivo_url = ?, data_criacao = ?, publicado = ?
=======
    public function update($id, $usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado) {
        $stmt = $this->pdo->prepare("
            UPDATE publicados
            SET usuario_id = ?, email = ?, titulo = ?, sinopse = ?, tipo = ?, arquivo_url = ?, data_criacao = ?, publicado = ?
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
            WHERE id = ?
        ");
        $stmt->execute([$usuario_id, $email, $titulo, $sinopse, $tipo, $arquivo_url, $data_criacao, $publicado, $id]);
    }

    // Deletar por ID
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM publicados WHERE id = ?");
        $stmt->execute([$id]);
    }
}
