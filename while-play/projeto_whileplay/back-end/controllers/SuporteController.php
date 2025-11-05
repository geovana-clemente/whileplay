<?php

require_once '../models/Suporte.php';

class SuporteController {

    public function showForm() {
        require '../views/suporte_form.php';
    }

    public function saveSuporte() {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';
        $data_envio = $_POST['data_envio'] ?? '';

        $suporte = new Suporte();
        $suporte->save($usuario_id, $mensagem, $data_envio);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes');
    }

    public function listSuportes() {
        $suporte = new Suporte();
        $suportes = $suporte->getAll();
        require '../views/suporte_list.php';
    }

    public function deleteSuporteByTitle() {
        // A view envia o id da mensagem no campo 'id'. Ajustar para deletar
        // pela própria mensagem em vez de deletar por usuario_id.
        $id = $_POST['id'] ?? null;
        if ($id) {
            $suporte = new Suporte();
            $suporte->deleteById($id);
        }
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes');
    }

    public function showUpdateForm($id) {
        $suporte = new Suporte();
        $suporteInfo = $suporte->getById($id);
        require '../views/update_suporte_form.php';
    }

    public function updateSuporte() {
        $id = $_POST['id'];
        $usuario_id = $_POST['usuario_id'];
        $mensagem = $_POST['mensagem'];
        $data_envio = $_POST['data_envio'];

        $suporte = new Suporte();
        $suporte->update($id, $usuario_id, $mensagem, $data_envio);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes');
    }
}
