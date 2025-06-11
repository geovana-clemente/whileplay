<?php

class Pagamento {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=while_play', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Salvar um novo pagamento (sem passar id, pois é auto_increment)
    public function save($nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo) {
        $stmt = $this->pdo->prepare("INSERT INTO pagamento (nome_do_cartao, numero_do_cartao, data_de_vencimento, codigo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo]);
    }

    // Buscar todos os pagamentos
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM pagamento");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Deletar pelo id_pagamento
    public function deleteById($id_pagamento) {
        $stmt = $this->pdo->prepare("DELETE FROM pagamento WHERE id_pagamento = ?");
        $stmt->execute([$id_pagamento]);
    }

    // Buscar um pagamento pelo id_pagamento
    public function getById($id_pagamento) {
        $stmt = $this->pdo->prepare("SELECT * FROM pagamento WHERE id_pagamento = ?");
        $stmt->execute([$id_pagamento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar um pagamento pelo id_pagamento
    public function update($id_pagamento, $nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo) {
        $stmt = $this->pdo->prepare("UPDATE pagamento SET nome_do_cartao = ?, numero_do_cartao = ?, data_de_vencimento = ?, codigo = ? WHERE id_pagamento = ?");
        $stmt->execute([$nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo, $id_pagamento]);
    }
}
