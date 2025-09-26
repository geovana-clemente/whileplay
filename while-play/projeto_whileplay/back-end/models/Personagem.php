<?php

class Personagem {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function save($id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem) {
        $stmt = $this->pdo->prepare("
            INSERT INTO personagens (id_sobre, mais_bem_avaliados, lançados_recentemente, caminho_imagem)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM personagens");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM personagens WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem) {
    $stmt = $this->pdo->prepare("
        UPDATE personagens
        SET id_sobre = ?, mais_bem_avaliados = ?, lançados_recentemente = ?, caminho_imagem = ?
        WHERE id = ?
    ");
    $stmt->execute([$id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem, $id]);
}

    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM personagens WHERE id = ?");
        $stmt->execute([$id]);
    }
}
