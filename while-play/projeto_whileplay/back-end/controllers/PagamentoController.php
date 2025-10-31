<?php

require_once __DIR__ . '/../models/Pagamento.php';

class PagamentoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function showForm() {
        require __DIR__ . '/../views/pagamento_form.php';
    }

    public function savePagamento() {
        $nome_do_cartao = $_POST['nome_do_cartao'] ?? '';
        $numero_do_cartao = $_POST['numero_do_cartao'] ?? '';
        $data_de_vencimento = $_POST['data_de_vencimento'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        $pagamento = new Pagamento($this->pdo);
        $pagamento->save($nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }

    public function listPagamentos() {
        $pagamento = new Pagamento($this->pdo);
        $pagamentos = $pagamento->getAll();
        require __DIR__ . '/../views/pagamento_list.php';
    }

    public function deletePagamentoById() {
        $id_pagamento = $_POST['id_pagamento'] ?? null;

        if ($id_pagamento) {
            $pagamento = new Pagamento($this->pdo);
            $pagamento->deleteById($id_pagamento);
        }

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }

    public function showUpdateForm($id) {
        $pagamento = new Pagamento($this->pdo);
        $pagamentoInfo = $pagamento->getById($id);
        require __DIR__ . '/../views/update_pagamento_form.php';
    }

    public function updatePagamento() {
        $id_pagamento = $_POST['id_pagamento'] ?? null;
        $nome_do_cartao = $_POST['nome_do_cartao'] ?? '';
        $numero_do_cartao = $_POST['numero_do_cartao'] ?? '';
        $data_de_vencimento = $_POST['data_de_vencimento'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        if ($id_pagamento) {
            $pagamento = new Pagamento($this->pdo);
            $pagamento->update($id_pagamento, $nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo);
        }

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }
}
