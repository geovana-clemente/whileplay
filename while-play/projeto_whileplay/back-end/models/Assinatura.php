<?php

class Assinatura {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // 🟢 Inserir nova assinatura
    public function save($usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento = null) {
        $stmt = $this->pdo->prepare("
            INSERT INTO assinaturas (usuario_id, cidade, endereco, cep, cpf, status, data_assinatura, data_cancelamento)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento]);
    }

    // 🟢 Listar todas as assinaturas
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM assinaturas ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🟢 Buscar assinatura por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM assinaturas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🟢 Atualizar uma assinatura existente
    public function update($id, $usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento = null) {
        $stmt = $this->pdo->prepare("
            UPDATE assinaturas 
            SET usuario_id = ?, cidade = ?, endereco = ?, cep = ?, cpf = ?, status = ?, data_assinatura = ?, data_cancelamento = ?
            WHERE id = ?
        ");
        $stmt->execute([$usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento, $id]);
    }

    // 🟢 Excluir assinatura por usuário_id
    public function deleteByUsuarioId($usuario_id) {
        $stmt = $this->pdo->prepare("DELETE FROM assinaturas WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
    }

    // 🟢 Excluir assinatura por ID
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM assinaturas WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
