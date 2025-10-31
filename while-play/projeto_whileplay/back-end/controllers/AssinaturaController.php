<?php
require_once '../models/Assinatura.php';

class AssinaturaController {

    public function showForm() {
        require '../views/assinatura_form.php'; 
    }

    public function saveAssinatura() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $status = $_POST['status'] ?? 'ativa';
        $data_assinatura = $_POST['data_assinatura'] ?? date('Y-m-d H:i:s');
        $data_cancelamento = $_POST['data_cancelamento'] ?? null;

        $assinatura = new Assinatura();
        $assinatura->save($usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }

    public function listAssinaturas() {
        $assinatura = new Assinatura();
        $assinaturas = $assinatura->getAll();
        require '../views/assinatura_list.php';
    }

    public function deleteAssinaturaByUsuario() {
        $usuario_id = $_POST['usuario_id'] ?? null;
        if ($usuario_id) {
            $assinatura = new Assinatura();
            $assinatura->deleteByUsuario($usuario_id);
        }
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }

    public function showUpdateForm($id) {
        $assinatura = new Assinatura();
        $assinaturaInfo = $assinatura->getById($id);
        require '../views/update_assinatura_form.php';
    }

    public function updateAssinatura() {
        $id = $_POST['id'];
        $usuario_id = $_POST['usuario_id'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $status = $_POST['status'] ?? 'ativa';
        $data_assinatura = $_POST['data_assinatura'] ?? date('Y-m-d H:i:s');
        $data_cancelamento = $_POST['data_cancelamento'] ?? null;

        $assinatura = new Assinatura();
        $assinatura->update($id, $usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }
}
?>
