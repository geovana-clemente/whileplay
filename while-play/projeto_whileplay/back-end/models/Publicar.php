<?php

class Publicar {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function criar($dados) {
        $sql = "INSERT INTO publicar (usuario_id, titulo, sinopse, tipo, arquivo_url, publicado, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $dados['usuario_id'] ?? null,
            $dados['titulo'] ?? null,
            $dados['sinopse'] ?? null,
            $dados['tipo'] ?? null,
            $dados['arquivo_url'] ?? null,
            $dados['publicado'] ?? 0,
            $dados['status'] ?? 1
        ]);

        return $this->pdo->lastInsertId();
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM publicar ORDER BY data_criacao DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM publicar WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE publicar SET titulo = ?, sinopse = ?, tipo = ?, arquivo_url = ?, publicado = ?, status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $dados['titulo'] ?? null,
            $dados['sinopse'] ?? null,
            $dados['tipo'] ?? null,
            $dados['arquivo_url'] ?? null,
            $dados['publicado'] ?? 0,
            $dados['status'] ?? 1,
            $id
        ]);

        return $stmt->rowCount();
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM publicar WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}

