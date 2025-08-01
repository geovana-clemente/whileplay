<?php

class Personagem {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Salvar personagem
    public function save($id_sobre, $mais_bem_avaliados, $lancados_recentemente, $caminho_imagem) {
        $stmt = $this->pdo->prepare("
            INSERT INTO personagens (id_sobre, mais_bem_avaliados, lancados_recentemente, caminho_imagem)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$id_sobre, $mais_bem_avaliados, $lancados_recentemente, $caminho_imagem]);
    }

    // Listar todos
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM personagens");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM personagens WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
    // Atualizar personagem
    public function update($id, $id_sobre, $mais_bem_avaliados, $lancados_recentemente, $caminho_imagem) {
=======
    public function update($id, $id_sobre, $mais_bem_avaliados, $lançados_recentemente, $caminho_imagem) {
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        $stmt = $this->pdo->prepare("
            UPDATE personagens
            SET id_sobre = ?, mais_bem_avaliados = ?, lancados_recentemente = ?, caminho_imagem = ?
            WHERE id = ?
        ");
        $stmt->execute([$id_sobre, $mais_bem_avaliados, $lancados_recentemente, $caminho_imagem, $id]);
    }

    // Deletar por ID
    public function deleteById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM personagens WHERE id = ?");
        $stmt->execute([$id]);
    }
}


