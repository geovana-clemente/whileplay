<?php
require_once '../models/Assinatura.php';

class AssinaturaController {

    // Exibe o formulário de criação
    public function showForm() {
        require '../views/assinatura_form.php'; 
    }

    // Salva nova assinatura
    public function saveAssinatura() {
        $usuario_id = $_POST['usuario_id'] ?? null;
        $cidade = trim($_POST['cidade'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');
        $cep = trim($_POST['cep'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $status = $_POST['status'] ?? 'ativa';
        $data_assinatura = $_POST['data_assinatura'] ?? date('Y-m-d H:i:s');
        $data_cancelamento = !empty($_POST['data_cancelamento']) ? $_POST['data_cancelamento'] : null;

        // validação básica
        if (!$usuario_id || !$cpf) {
            die('Erro: Campos obrigatórios não informados.');
        }

        $assinatura = new Assinatura();
        $assinatura->save($usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }

    // Lista todas as assinaturas
    public function listAssinaturas() {
        $assinatura = new Assinatura();
        $assinaturas = $assinatura->getAll();
        require '../views/assinatura_list.php';
    }

    // Exclui a assinatura de um usuário específico
    public function deleteAssinaturaByUsuario() {
        $usuario_id = $_POST['usuario_id'] ?? null;

        if ($usuario_id) {
            $assinatura = new Assinatura();
            $assinatura->deleteByUsuario($usuario_id);
        }

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }

    // Exibe o formulário de atualização
    public function showUpdateForm($id) {
        $assinatura = new Assinatura();
        $assinaturaInfo = $assinatura->getById($id);

        if (!$assinaturaInfo) {
            die('Assinatura não encontrada.');
        }

        require '../views/update_assinatura_form.php';
    }

    // Atualiza os dados da assinatura
    public function updateAssinatura() {
        $id = $_POST['id'] ?? null;
        $usuario_id = $_POST['usuario_id'] ?? null;
        $cidade = trim($_POST['cidade'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');
        $cep = trim($_POST['cep'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $status = $_POST['status'] ?? 'ativa';
        $data_assinatura = $_POST['data_assinatura'] ?? date('Y-m-d H:i:s');
        $data_cancelamento = !empty($_POST['data_cancelamento']) ? $_POST['data_cancelamento'] : null;

        if (!$id || !$usuario_id) {
            die('Erro: ID ou usuário não informado.');
        }

        $assinatura = new Assinatura();
        $assinatura->update($id, $usuario_id, $cidade, $endereco, $cep, $cpf, $status, $data_assinatura, $data_cancelamento);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
        exit;
    }
}
?>
