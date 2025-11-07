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

    // ✅ Valida se a Assinatura e o Usuário existem (nova validação para usuario_id)
    private function validarRelacionamentos($assinatura_id, $usuario_id) {
        if (empty($assinatura_id)) {
            throw new Exception("Erro: assinatura_id é obrigatório.");
        }
        if (empty($usuario_id)) {
            throw new Exception("Erro: usuario_id é obrigatório.");
        }

        $checkAss = $this->pdo->prepare("SELECT id FROM assinaturas WHERE id = ?");
        $checkAss->execute([$assinatura_id]);
        if ($checkAss->rowCount() === 0) {
            throw new Exception("Erro: assinatura_id {$assinatura_id} não existe.");
        }
        
        $checkUser = $this->pdo->prepare("SELECT id FROM perfil WHERE id = ?");
        $checkUser->execute([$usuario_id]);
        if ($checkUser->rowCount() === 0) {
            throw new Exception("Erro: usuario_id {$usuario_id} não existe na tabela 'perfil'.");
        }
    }

    // ✅ Cria um novo roteiro (7 argumentos no total)
    public function save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado) {
        $this->validarRelacionamentos($assinatura_id, $usuario_id);

        $stmt = $this->pdo->prepare("
            INSERT INTO roteiros (titulo, categoria, caminho_imagem, visualizacoes, assinatura_id, usuario_id, publicado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado]);
    }

    // ✅ Retorna todos os roteiros (mantido)
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM roteiros ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Busca um roteiro específico (mantido)
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Atualiza um roteiro existente (8 argumentos: $id + 7 campos)
    public function update($id, $titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado) {
        $this->validarRelacionamentos($assinatura_id, $usuario_id);

        $stmt = $this->pdo->prepare("
            UPDATE roteiros 
            SET titulo = ?, categoria = ?, caminho_imagem = ?, visualizacoes = ?, assinatura_id = ?, usuario_id = ?, publicado = ?
            WHERE id = ?
        ");
        $stmt->execute([$titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id, $usuario_id, $publicado, $id]);
    }

    // ✅ Exclui um roteiro pelo ID (mantido)
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
    }
}
