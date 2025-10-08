<?php

require_once '../models/User.php';
require_once '../config/database.php';

class UserController {
    private $userModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    // Processar cadastro
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            // Validações
            $errors = $this->validateRegistration($nome, $email, $password, $password_confirm);
            
            if (!empty($errors)) {
                $this->redirectWithError($errors[0]);
                return;
            }

            // Verificar se email já existe
            if ($this->userModel->emailExists($email)) {
                $this->redirectWithError('email');
                return;
            }

            // Criar usuário
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            if ($this->userModel->create($nome, $email, $hashedPassword)) {
                // Redirecionar para login com sucesso
                header('Location: ../../front-end/views/login.html?success=cadastro');
                exit();
            } else {
                $this->redirectWithError('bd');
                return;
            }
        }
    }

    // Processar login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->redirectToLogin('campos');
                return;
            }

            $user = $this->userModel->findByEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sessão
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome'];
                $_SESSION['user_email'] = $user['email'];
                
                // Redirecionar para homepage logada
                header('Location: ../../front-end/views/homepage2_com_login.html');
                exit();
            } else {
                $this->redirectToLogin('invalido');
                return;
            }
        }
    }

    // Logout
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../../front-end/views/homepage1.html');
        exit();
    }

    // Verificar se usuário está logado
    public function checkAuth() {
        session_start();
        
        $response = [
            'logged' => isset($_SESSION['user_id']),
            'user' => null
        ];
        
        if ($response['logged']) {
            $response['user'] = [
                'id' => $_SESSION['user_id'],
                'nome' => $_SESSION['user_nome'],
                'email' => $_SESSION['user_email']
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Validar dados de registro
    private function validateRegistration($nome, $email, $password, $password_confirm) {
        $errors = [];

        // Validar nome
        if (empty($nome) || strlen($nome) < 3 || !preg_match('/^[a-zA-ZÀ-ÿ\s]+$/', $nome)) {
            $errors[] = 'nome';
        }

        // Validar email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'emailinvalido';
        }

        // Validar senha
        if (empty($password) || strlen($password) < 6) {
            $errors[] = 'senhapequena';
        }

        // Validar confirmação de senha
        if ($password !== $password_confirm) {
            $errors[] = 'senhas';
        }

        return $errors;
    }

    // Redirecionar com erro para cadastro
    private function redirectWithError($error) {
        header('Location: ../../front-end/views/cadastro.html?erro=' . $error);
        exit();
    }

    // Redirecionar com erro para login
    private function redirectToLogin($error) {
        header('Location: ../../front-end/views/login.html?erro=' . $error);
        exit();
    }
}