<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\controllers\LoginController.php
require_once __DIR__ . '/../models/Login.php';

class LoginController {
    public function showForm() {
        // Não renderiza formulário, apenas redireciona para o front-end
        header('Location: /while-play/projeto_whileplay/front-end/views/login.html');
        exit;
    }

    public function authenticate() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $loginModel = new Login();
        $user = $loginModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header('Location: /Whileplay/VIEWS/COM logins/roteiros_com_login.html');
            exit;
        } else {
            header('Location: /while-play/projeto_whileplay/front-end/views/login.html?erro=1');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /while-play/projeto_whileplay/front-end/views/login.html');
        exit;
    }
}
