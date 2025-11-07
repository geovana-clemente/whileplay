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
            $nome_completo = trim($_POST['nome_completo'] ?? $_POST['nome'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
                $password_confirm = $_POST['password_confirm'] ?? ''; // Ensure password confirmation is captured

            // Gerar username automático se não fornecido
            if (empty($username)) {
                $username = $this->generateUsername($nome_completo, $email);
            }

            // Validações
            $errors = $this->validateRegistration($nome_completo, $username, $email, $password, $password_confirm);
            
            if (!empty($errors)) {
                $this->redirectWithError($errors[0]);
                return;
            }

            // Verificar se email já existe
            if ($this->userModel->emailExists($email)) {
                $this->redirectWithError('email');
                return;
            }

            // Verificar se username já existe
            if ($this->userModel->usernameExists($username)) {
                $this->redirectWithError('username');
                return;
            }

            // Criar usuário
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            if ($this->userModel->create($nome_completo, $username, $email, $hashedPassword)) {
                // Redirecionar para login com sucesso
                    // Redirecionar para login.html após cadastro bem-sucedido
                    header('Location: ../../front-end/views/login.html?cadastro=sucesso');
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
            $login = trim($_POST['email'] ?? $_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($login) || empty($password)) {
                header('Location: ../../front-end/views/login.html?error=campos');
                exit();
            }

            // Tentar login por email ou username
            $user = null;
            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $user = $this->userModel->findByEmail($login);
            } else {
                $user = $this->userModel->findByUsername($login);
            }

            if ($user && isset($user['senha']) && password_verify($password, $user['senha'])) {
                // Atualizar último login
                if (method_exists($this->userModel, 'updateLastLogin')) {
                    $this->userModel->updateLastLogin($user['id']);
                }

                // Iniciar sessão
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome_completo'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_foto'] = $user['foto_url'] ?? '';

                // Verificar se o usuário tem assinatura ativa
                require_once '../helpers/AssinaturaHelper.php';
                if (class_exists('AssinaturaHelper') && method_exists('AssinaturaHelper', 'usuarioTemAssinaturaAtiva') && AssinaturaHelper::usuarioTemAssinaturaAtiva($user['id'])) {
                    header('Location: ../../front-end/views/perfil_assinatura.html');
                } else {
                    header('Location: ../../front-end/views/homepage2_com_login.html');
                }
                exit();
            } else {
                header('Location: ../../front-end/views/login.html?error=invalido');
                exit();
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
                'username' => $_SESSION['user_username'] ?? '',
                'email' => $_SESSION['user_email'],
                'foto_url' => $_SESSION['user_foto'] ?? null
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Gerar username automático
    private function generateUsername($nome_completo, $email) {
        // Usar primeira parte do email como base
        $base = explode('@', $email)[0];
        
        // Limpar caracteres especiais
        $base = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($base));
        
        // Garantir que tem pelo menos 3 caracteres
        if (strlen($base) < 3) {
            $base = strtolower(str_replace(' ', '', $nome_completo));
            $base = preg_replace('/[^a-zA-Z0-9]/', '', $base);
            $base = substr($base, 0, 10);
        }
        
        // Verificar se já existe e adicionar número se necessário
        $username = $base;
        $counter = 1;
        
        while ($this->userModel->usernameExists($username)) {
            $username = $base . $counter;
            $counter++;
        }
        
        return $username;
    }

    // Validar dados de registro
    private function validateRegistration($nome_completo, $username, $email, $password, $password_confirm) {
        $errors = [];

        // Validar nome completo
        if (empty($nome_completo) || strlen($nome_completo) < 3 || !preg_match('/^[a-zA-ZÀ-ÿ\s]+$/', $nome_completo)) {
            $errors[] = 'nome';
        }

        // Validar username
        if (!empty($username)) {
            if (strlen($username) < 3 || strlen($username) > 20 || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $errors[] = 'username_invalido';
            }
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