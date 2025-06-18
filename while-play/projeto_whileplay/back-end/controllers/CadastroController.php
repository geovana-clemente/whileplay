<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\controllers\CadastroController.php
require_once __DIR__ . '/../models/Login.php';

class CadastroController {
    public function showForm() {
        // Não renderiza formulário, apenas redireciona para o front-end
        header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html');
        exit;
    }

    public function cadastrar() {
        $nome = $_POST['nome'] ?? null;
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';
        $loginModel = new Login();
        if ($password !== $password_confirm) {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=senhas');
            exit;
        }
        if ($loginModel->getUserByEmail($email)) {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=email');
            exit;
        }
        if (!$nome || strlen($nome) < 3) {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=nome');
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=emailinvalido');
            exit;
        }
        if (strlen($password) < 6) {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=senhapequena');
            exit;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($loginModel->createUser($email, $hash, $nome)) {
            header('Location: /while-play/projeto_whileplay/front-end/views/login.html?cadastro=ok');
            exit;
        } else {
            header('Location: /while-play/projeto_whileplay/front-end/views/cadastro.html?erro=bd');
            exit;
        }
    }
}
