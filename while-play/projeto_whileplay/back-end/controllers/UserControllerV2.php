<?php

require_once '../storage/FileUserStorage.php';

class UserControllerV2 {
    private $storage;
    private $useMysql;
    private $userModel;

    public function __construct() {
        // Tentar usar MySQL, se não funcionar usar arquivo
        try {
            require_once '../models/User.php';
            require_once '../config/database.php';
            $database = new Database();
            $db = $database->getConnection();
            if ($db) {
                $this->userModel = new User($db);
                $this->useMysql = true;
            } else {
                throw new Exception("MySQL não disponível");
            }
        } catch (Exception $e) {
            // Fallback para sistema de arquivos
            $this->storage = new FileUserStorage();
            $this->useMysql = false;
        }
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

            // Verificar se email já existe e criar usuário
            if ($this->useMysql) {
                // Usar MySQL
                if ($this->userModel->emailExists($email)) {
                    $this->redirectWithError('email');
                    return;
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Gerar username automático a partir do nome/email
                $username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', explode('@', $email)[0]));
                if ($this->userModel->create($nome, $username, $email, $hashedPassword)) {
                    header('Location: ../../front-end/views/login.html?success=cadastro');
                    exit();
                } else {
                    $this->redirectWithError('bd');
                    return;
                }
            } else {
                // Usar sistema de arquivos
                $result = $this->storage->createUser($nome, $email, $password);
                
                if ($result === false) {
                    $this->redirectWithError('email');
                    return;
                } else {
                    header('Location: ../../front-end/views/login.html?success=cadastro');
                    exit();
                }
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

            if ($this->useMysql) {
                // Usar MySQL
                $user = $this->userModel->findByEmail($email);
                
                if ($user && password_verify($password, $user['password'])) {
                    $this->startSession($user);
                } else {
                    $this->redirectToLogin('invalido');
                    return;
                }
            } else {
                // Usar sistema de arquivos
                $user = $this->storage->verifyPassword($email, $password);
                
                if ($user) {
                    $this->startSession($user);
                } else {
                    $this->redirectToLogin('invalido');
                    return;
                }
            }
        }
    }

    // Iniciar sessão
    private function startSession($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nome'] = $user['nome'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['logged_in'] = true;
        
        // Redirecionar para homepage logada
        header('Location: ../../front-end/views/homepage2_com_login.html');
        exit();
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
            'logged' => isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true,
            'user' => null,
            'storage_type' => $this->useMysql ? 'mysql' : 'file'
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

    // Função para mostrar status do sistema
    public function getSystemStatus() {
        header('Content-Type: application/json');
        
        $status = [
            'system' => 'WhilePlay Auth System',
            'version' => '2.0',
            'storage' => $this->useMysql ? 'MySQL Database' : 'File System',
            'mysql_available' => $this->useMysql,
            'file_system_available' => file_exists('../storage/FileUserStorage.php'),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        if (!$this->useMysql) {
            $users = $this->storage->getAllUsers();
            $status['total_users'] = count($users);
            $status['users_file'] = realpath('../data/users.json');
        }
        
        echo json_encode($status, JSON_PRETTY_PRINT);
        exit();
    }
}