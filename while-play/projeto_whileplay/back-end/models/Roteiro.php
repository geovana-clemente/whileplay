<?php

class Roteiro {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=while_play;charset=utf8', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // ✅ Verifica se a assinatura associada realmente existe
    private function validarAssinatura($assinatura_id) {
        if (empty($assinatura_id)) {
            throw new Exception("Erro: assinatura_id é obrigatório (não pode ser vazio ou nulo).");
        }

        $check = $this->pdo->prepare("SELECT id FROM assinaturas WHERE id = ?");
        $check->execute([$assinatura_id]);

        if ($check->rowCount() === 0) {
            throw new Exception("Erro: assinatura_id {$assinatura_id} não existe na tabela 'assinaturas'.");
        }
    }

    // ✅ Cria um novo roteiro
    public function save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id) {
        $this->validarAssinatura($assinatura_id);

        $stmt = $this->pdo->prepare("
            INSERT INTO roteiros (titulo, categoria, caminho_imagem, visualizacoes, assinatura_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id]);
    }

    // ✅ Retorna todos os roteiros
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM roteiros ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Busca um roteiro específico
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Atualiza um roteiro existente
    public function update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id) {
        $this->validarAssinatura($assinatura_id);

        $stmt = $this->pdo->prepare("
            UPDATE roteiros 
            SET titulo = ?, categoria = ?, caminho_imagem = ?, visualizacoes = ?, assinatura_id = ?
            WHERE id = ?
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $id]);
    }

    // ✅ Exclui um roteiro pelo ID
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
    }
}
