<?php

class Roteiro {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id) {
        // ✅ 1. Valida se o assinatura_id existe na tabela assinaturas
        if ($assinatura_id !== null) {
            $check = $this->pdo->prepare("SELECT id FROM assinaturas WHERE id = ?");
            $check->execute([$assinatura_id]);

            if ($check->rowCount() === 0) {
                throw new Exception("Erro: assinatura_id {$assinatura_id} não existe na tabela assinaturas.");
            }
        }

        // ✅ 2. Faz o INSERT com segurança
        $stmt = $this->pdo->prepare("
            INSERT INTO roteiros (titulo, categoria, caminho_imagem, visualizacoes, assinatura_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $titulo,
            $categoria,
            $caminho_imagem,
            $visualizacoes,
            $assinatura_id // pode ser NULL se não tiver assinatura
        ]);
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
        
        if ($assinatura_id !== null) {
            $check = $this->pdo->prepare("SELECT id FROM assinaturas WHERE id = ?");
            $check->execute([$assinatura_id]);

            if ($check->rowCount() === 0) {
                throw new Exception("Erro: assinatura_id {$assinatura_id} não existe na tabela assinaturas.");
            }
        }

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
