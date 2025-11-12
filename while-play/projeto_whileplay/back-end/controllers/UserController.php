<?php

require_once '../models/User.php';
require_once '../config/database.php';

class UserController {
    private $userModel;
    private $db;
    // Base do front calculada de forma robusta a partir do caminho no disco (independe da URL acessada)
    private function getFrontBase() {
        // 1) Tentar calcular a partir do filesystem (DocumentRoot + caminho do projeto)
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $docRoot = $docRoot ? str_replace('\\', '/', realpath($docRoot)) : '';
        $projectDir = str_replace('\\', '/', realpath(__DIR__ . '/../../')); // .../projeto_whileplay

        if ($docRoot && $projectDir && strpos($projectDir, $docRoot) === 0) {
            $relative = substr($projectDir, strlen($docRoot)); // ex: /GitHub/whileplay/whileplay/while-play/projeto_whileplay
            $relative = '/' . ltrim($relative, '/');
            return rtrim($relative, '/') . '/front-end/views/';
        }

        // 2) Fallback: derivar da URL atual, caso o servidor não exponha DOCUMENT_ROOT corretamente
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $marker = '/projeto_whileplay/';
        $pos = strpos($uri, $marker);
        if ($pos !== false) {
            $prefix = substr($uri, 0, $pos);
            return $prefix . 'projeto_whileplay/front-end/views/';
        }

        // 3) Fallback final: caminho padrão deste repositório
        return '/GitHub/whileplay/whileplay/while-play/projeto_whileplay/front-end/views/';
    }

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    // Processar cadastro
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) { session_start(); }
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
            
            $newId = $this->userModel->create($nome_completo, $username, $email, $hashedPassword);
            if ($newId) {
                // Após cadastro, redirecionar para a página de login (sem auto-login)
                $query = http_build_query([
                    'success' => 'cadastro',
                    'email'   => $email
                ]);
                header('Location: ' . $this->getFrontBase() . 'login.html?' . $query);
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
            if (session_status() === PHP_SESSION_NONE) { session_start(); }
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

                // Iniciar sessão (já iniciada acima se necessário)
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome_completo'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_foto'] = $user['foto_url'] ?? '';

                // Verificar se o usuário tem assinatura ativa
                require_once '../helpers/AssinaturaHelper.php';
                $temAssinatura = false;
                if (class_exists('AssinaturaHelper') && method_exists('AssinaturaHelper', 'usuarioTemAssinaturaAtiva')) {
                    try {
                        $temAssinatura = AssinaturaHelper::usuarioTemAssinaturaAtiva($user['id']);
                    } catch (\Throwable $e) {
                        // Ignorar erro de tabela inexistente e seguir fluxo padrão
                        $temAssinatura = false;
                    }
                }
                // Guardar flag em sessão para uso no front-end
                $_SESSION['user_assinatura_ativa'] = $temAssinatura ? 1 : 0;

                if ($temAssinatura) {
                    // Acesso direto à homepage com assinatura
                    header('Location: ' . $this->getFrontBase() . 'homepage2_assinatura.html');
                } else {
                    header('Location: ' . $this->getFrontBase() . 'homepage2_com_login.html');
                }
                exit();
            } else {
                header('Location: ' . $this->getFrontBase() . 'login.html?error=invalido');
                exit();
            }
        }
    }

    // Logout
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        session_destroy();
        header('Location: ' . $this->getFrontBase() . 'homepage1.html');
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
                'foto_url' => $_SESSION['user_foto'] ?? null,
                'assinatura_ativa' => isset($_SESSION['user_assinatura_ativa']) ? (bool)$_SESSION['user_assinatura_ativa'] : false
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
        header('Location: ' . $this->getFrontBase() . 'cadastro.html?erro=' . $error);
        exit();
    }

    // Redirecionar com erro para login
    private function redirectToLogin($error) {
        header('Location: ' . $this->getFrontBase() . 'login.html?error=' . $error);
        exit();
    }
}