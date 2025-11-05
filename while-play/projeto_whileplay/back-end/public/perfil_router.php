<?php
// Router para funcionalidades do perfil

// Iniciar sessão
session_start();

// Verificar se usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../front-end/views/login.html?erro=nao_logado');
    exit();
}

// Carregar dependências
require_once '../config/database.php';
require_once '../models/User.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'view';

$database = new Database();
$pdo = $database->getConnection();
$userModel = new User($pdo);

switch ($action) {
    case 'view':
        // Buscar dados do usuário
        $usuario = $userModel->findById($_SESSION['user_id']);
        if (!$usuario) {
            header('Location: ../../front-end/views/login.html?erro=usuario_nao_encontrado');
            exit();
        }
        
        // Redirecionar para página de perfil
        header('Location: ../../front-end/views/perfil_com_login.html');
        exit();
        
    case 'update':
        if ($method === 'POST') {
            $nome_completo = trim($_POST['nome_completo'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $biografia = trim($_POST['biografia'] ?? '');
            
            // Validações básicas
            $errors = [];
            
            if (empty($nome_completo) || strlen($nome_completo) < 3) {
                $errors[] = 'nome_invalido';
            }
            
            if (empty($username) || strlen($username) < 3) {
                $errors[] = 'username_invalido';
            }
            
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'email_invalido';
            }
            
            // Verificar se username já existe para outro usuário
            $existingUser = $userModel->findByUsername($username);
            if ($existingUser && $existingUser['id'] != $_SESSION['user_id']) {
                $errors[] = 'username_existe';
            }
            
            // Verificar se email já existe para outro usuário
            $existingUser = $userModel->findByEmail($email);
            if ($existingUser && $existingUser['id'] != $_SESSION['user_id']) {
                $errors[] = 'email_existe';
            }
            
            if (!empty($errors)) {
                header('Location: ../../front-end/views/perfil_com_login.html?erro=' . implode(',', $errors));
                exit();
            }
            
            // Atualizar perfil
            if ($userModel->updateProfile($_SESSION['user_id'], $nome_completo, $username, $email, $biografia)) {
                // Atualizar dados da sessão
                $_SESSION['user_nome'] = $nome_completo;
                $_SESSION['user_username'] = $username;
                $_SESSION['user_email'] = $email;
                
                header('Location: ../../front-end/views/perfil_com_login.html?success=perfil_atualizado');
                exit();
            } else {
                header('Location: ../../front-end/views/perfil_com_login.html?erro=erro_atualizacao');
                exit();
            }
        }
        break;
        
    case 'get_data':
        // Retornar dados do usuário em JSON
        header('Content-Type: application/json');
        
        $usuario = $userModel->findById($_SESSION['user_id']);
        if ($usuario) {
            echo json_encode([
                'success' => true,
                'user' => [
                    'id' => $usuario['id'],
                    'nome_completo' => $usuario['nome_completo'],
                    'username' => $usuario['username'],
                    'email' => $usuario['email'],
                    'biografia' => $usuario['biografia'],
                    'foto_url' => $usuario['foto_url']
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Usuário não encontrado'
            ]);
        }
        exit();
        
    default:
        header('Location: ../../front-end/views/perfil_com_login.html');
        exit();
}
?>