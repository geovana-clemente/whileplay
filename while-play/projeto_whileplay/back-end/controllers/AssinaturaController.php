<?php

require_once '../models/Assinatura.php';

class AssinaturaController {

    public function showForm() {
        require '..back-end/views/assinatura_form.php'; 
    }

    public function saveAssinatura() {
        $nome = $_POST['nome'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $data_assinatura = $_POST['data_assinatura'] ?? date('Y-m-d');

        $assinatura = new Assinatura();
        $assinatura->save($nome, $cidade, $endereco, $cep, $cpf, $data_assinatura);

        header('Location: /while-play/projeto_whileplay/back-end/list-assinaturas');
    }

    public function listAssinaturas() {
        $assinatura = new Assinatura();
        $assinaturas = $assinatura->getAll();
        require '..back-end/views/assinatura_list.php';
    }

    public function deleteAssinaturaByTitle() {
        $nome = $_POST['nome'] ?? null;
        if ($nome) {
            $assinatura = new Assinatura();
            $assinatura->deleteByTitle($nome);
        }
        header('Location: /while-play/projeto_whileplay/back-end/list-assinaturas');
    }

    public function showUpdateForm($id) {
        $assinatura = new Assinatura();
        $assinaturaInfo = $assinatura->getById($id);
        require '..back-end/views/update_assinatura_form.php';
    }

    public function updateAssinatura() {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $cep = $_POST['cep'];
        $cpf = $_POST['cpf'];
        $data_assinatura = $_POST['data_assinatura'];

        $assinatura = new Assinatura();
        $assinatura->update($id, $nome, $cidade, $endereco, $cep, $cpf, $data_assinatura);

        header('Location: /while-play/projeto_whileplay/back-end/list-assinaturas');
    }
}
