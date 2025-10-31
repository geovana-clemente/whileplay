<?php

class Assinatura {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=while_play;charset=utf8', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    // 🟢 Criar nova assinatura
    public function save($usuario_id, $cidade, $endereco, $cep, $cpf, $status = 'ativa', $data_assinatura = null, $data_cancelamento = null) {
        if (!$data_assinatura) {
            $data_assinatura = date('Y-m-d H:i:s');
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO assinaturas (usuario_id, cidade, endereco, cep, cpf, status, data_assinatura, data_cancelamento)
            VALUES (:usuario_id, :cidade, :endereco, :cep, :cpf, :status, :data_assinatura, :data_cancelamento)
        ");

        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':cidade' => $cidade,
            ':endereco' => $endereco,
            ':cep' => $cep,
            ':cpf' => $cpf,
            ':status' => $status,
            ':data_assinatura' => $data_assinatura,
            ':data_cancelamento' => $data_cancelamento
        ]);
    }

    // 🟢 Listar todas as assinaturas
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT a.*, p.nome AS nome_usuario
            FROM assinaturas a
            LEFT JOIN perfil p ON a.usuario_id = p.id
            ORDER BY a.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🟢 Buscar assinatura por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM assinaturas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🟢 Atualizar assinatura existente
    public function update($id, $usuario_id, $cidade, $endereco, $cep, $cpf, $status = 'ativa', $data_assinatura = null, $data_cancelamento = null) {
        if (!$data_assinatura) {
            $data_assinatura = date('Y-m-d H:i:s');
        }

        $stmt = $this->pdo->prepare("
            UPDATE assinaturas
            SET 
                usuario_id = :usuario_id,
                cidade = :cidade,
                endereco = :endereco,
                cep = :cep,
                cpf = :cpf,
                status = :status,
                data_assinatura = :data_assinatura,
                data_cancelamento = :data_cancelamento
            WHERE id = :id
        ");

        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':cidade' => $cidade,
            ':endereco' => $endereco,
            ':cep' => $cep,
            ':cpf' => $cpf,
            ':status' => $status,
            ':data_assinatura' => $data_assinatura,
            ':data_cancelamento' => $data_cancelamento,
            ':id' => $id
        ]);
    }

    // 🟢 Excluir assinatura pelo ID do usuário
    public function deleteByUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("DELETE FROM assinaturas WHERE usuario_id = :usuario_id");
        $stmt->execute([':usuario_id' => $usuario_id]);
    }

    // 🟢 Excluir assinatura pelo ID
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM assinaturas WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
?>
