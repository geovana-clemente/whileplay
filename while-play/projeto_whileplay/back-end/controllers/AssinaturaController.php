<?php

require_once '../models/Assinatura.php';

class AssinaturaController {

    public function showForm() {
        require '../views/assinatura_form.php'; 
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

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
    }

    public function listAssinaturas() {
        $assinatura = new Assinatura();
        $assinaturas = $assinatura->getAll();
        require '../views/assinatura_list.php';
    }

    public function deleteAssinaturaByTitle() {
        $nome = $_POST['nome'] ?? null;
        if ($nome) {
            $assinatura = new Assinatura();
            $assinatura->deleteByTitle($nome);
        }
        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
    }

    public function showUpdateForm($id) {
        $assinatura = new Assinatura();
        $assinaturaInfo = $assinatura->getById($id);
        require '../views/update_assinatura_form.php';
    }

    public function updateAssinatura() {
        $id = $_POST['id'];
        $nome = $_POST['nome'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $cep = $_POST['cep'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $data_assinatura = $_POST['data_assinatura'] ?? '';

        $assinatura = new Assinatura();
        $assinatura->update($id, $nome, $cidade, $endereco, $cep, $cpf, $data_assinatura);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas');
    }

    public function saveRoteiro() {
        $titulo = $_POST['titulo'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $caminho_imagem = $_POST['caminho_imagem'] ?? '';
        $visualizacoes = $_POST['visualizacoes'] ?? 0;
        $assinatura_id = $_POST['assinatura_id'] ?? null;

        // Verifique se o assinatura_id existe
        $pdo = new PDO(/* suas configs de conexão */);
        $stmt = $pdo->prepare("SELECT id FROM assinaturas WHERE id = ?");
        $stmt->execute([$assinatura_id]);
        if ($stmt->rowCount() == 0) {
            // Mostre um erro ou redirecione com mensagem
            die("Assinatura não encontrada! Informe um ID válido.");
        }

        // Agora pode salvar normalmente
        $roteiro = new Roteiro();
        $roteiro->save($titulo, $categoria, $caminho_imagem, $visualizacoes, $assinatura_id);

        header('Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros');
    }
}
