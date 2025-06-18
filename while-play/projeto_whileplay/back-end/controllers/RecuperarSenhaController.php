<?php
// Controller para recuperação de senha
require_once __DIR__ . '/../models/Login.php';

class RecuperarSenhaController {
    public function showForm() {
        include __DIR__ . '/../views/recuperar_senha_form.php';
    }

    public function processForm() {
        $email = $_POST['email'] ?? '';
        $novaSenha = $_POST['nova_senha'] ?? '';
        $confirmaSenha = $_POST['confirma_senha'] ?? '';
        $loginModel = new Login();
        $user = $loginModel->getUserByEmail($email);
        if (!$user) {
            header('Location: /while-play/projeto_whileplay/front-end/views/recuperar_senha.html?erro=email');
            exit;
        }
        if ($novaSenha !== $confirmaSenha) {
            header('Location: /while-play/projeto_whileplay/front-end/views/recuperar_senha.html?erro=senhas');
            exit;
        }
        if (strlen($novaSenha) < 6) {
            header('Location: /while-play/projeto_whileplay/front-end/views/recuperar_senha.html?erro=senhapequena');
            exit;
        }
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
        if ($loginModel->updatePassword($email, $hash)) {
            header('Location: /while-play/projeto_whileplay/front-end/views/login.html?senha=alterada');
            exit;
        } else {
            header('Location: /while-play/projeto_whileplay/front-end/views/recuperar_senha.html?erro=bd');
            exit;
        }
    }
}
