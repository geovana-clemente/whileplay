<?php

class Personagem {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function save($nome, $descricao, $caminho_imagem, $usuario_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO personagens (nome, descricao, caminho_imagem, usuario_id)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$nome, $descricao, $caminho_imagem, $usuario_id]);
        return $this->pdo->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM personagens ORDER BY data_criacao DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_sobre) {
        $stmt = $this->pdo->prepare("SELECT * FROM personagens WHERE id_sobre = ?");
        $stmt->execute([$id_sobre]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_sobre, $nome, $descricao, $caminho_imagem, $usuario_id) {
        try {
            // Primeiro busca o registro atual para manter valores que não devem mudar
            $atual = $this->getById($id_sobre);
            if (!$atual) {
                throw new Exception('Personagem não encontrado');
            }

            // Se não foi fornecido um usuário_id, mantém o atual
            if (empty($usuario_id)) {
                $usuario_id = $atual['usuario_id'];
            }

            // Validações dos campos obrigatórios
            if (empty($nome)) {
                throw new Exception('Nome do personagem é obrigatório');
            }
            if (empty($descricao)) {
                throw new Exception('Descrição do personagem é obrigatória');
            }

            $stmt = $this->pdo->prepare("
                UPDATE personagens
                SET nome = ?, descricao = ?, caminho_imagem = ?, usuario_id = ?
                WHERE id_sobre = ?
            ");
            $stmt->execute([$nome, $descricao, $caminho_imagem, $usuario_id, $id_sobre]);
            return true;
        } catch (Exception $e) {
            error_log('Erro ao atualizar personagem: ' . $e->getMessage());
            throw $e;
        }
}

    public function deleteById($id_sobre) {
        $stmt = $this->pdo->prepare("DELETE FROM personagens WHERE id_sobre = ?");
        $stmt->execute([$id_sobre]);
    }
}
