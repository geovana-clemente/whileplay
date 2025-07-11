<?php

class Roteiro {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO roteiros (titulo, categoria, caminho_imagem, visualizacoes, assinatura_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM roteiros");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id) {
        $stmt = $this->pdo->prepare("
            UPDATE roteiros 
            SET titulo = ?, categoria = ?, caminho_imagem = ?, visualizacoes = ?, assinatura_id = ?
            WHERE id = ?
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $id]);
    }

    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
    }
}








