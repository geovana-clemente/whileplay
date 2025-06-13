<?php

require_once '../models/Pagamento.php';

class PagamentoController {

    public function showForm() {
        require '..back-end/views/pagamento_form.php'; 
    }

    public function savePagamento() {
        $nome_do_cartao = $_POST['nome_do_cartao'] ?? '';
        $numero_do_cartao = $_POST['numero_do_cartao'] ?? '';
        $data_de_vencimento = $_POST['data_de_vencimento'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        $pagamento = new Pagamento();
        $pagamento->save($nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo);

        header('Location: /while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }

    public function listPagamentos() {
        $pagamento = new Pagamento();
        $pagamentos = $pagamento->getAll();
        require '..back-end/views/pagamento_list.php';
    }

    public function deletePagamentoById() {
        $id_pagamento = $_POST['id_pagamento'] ?? null;

        if ($id_pagamento) {
            $pagamento = new Pagamento();
            $pagamento->deleteById($id_pagamento);
        }

        header('Location: /while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }

    public function showUpdateForm($id) {
        $pagamento = new Pagamento();
        $pagamentoInfo = $pagamento->getById($id);
        require '..back-end/views/update_pagamento_form.php';
    }

    public function updatePagamento() {
        $id_pagamento = $_POST['id_pagamento'] ?? null;
        $nome_do_cartao = $_POST['nome_do_cartao'] ?? '';
        $numero_do_cartao = $_POST['numero_do_cartao'] ?? '';
        $data_de_vencimento = $_POST['data_de_vencimento'] ?? '';
        $codigo = $_POST['codigo'] ?? '';

        if ($id_pagamento) {
            $pagamento = new Pagamento();
            $pagamento->update($id_pagamento, $nome_do_cartao, $numero_do_cartao, $data_de_vencimento, $codigo);
        }

        header('Location: /while-play/projeto_whileplay/back-end/list-pagamentos');
        exit;
    }
}
