<?php
// test_auth_flow.php - Script para validar fluxo de cadastro + login rapidamente
// NÃO usar em produção; apenas apoio de desenvolvimento.

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
require_once '../models/User.php';
require_once '../controllers/UserController.php';

$database = new Database();
$db = $database->getConnection();
if (!$db) {
    die('Falha ao conectar ao banco');
}

$userModel = new User($db);

// Gerar dados de teste únicos
$rand = substr(md5(uniqid('', true)), 0, 6);
$email = "teste_${rand}@example.com";
$nome = "Usuario Teste ${rand}";
$username = "user_${rand}";
$senha = 'Senha123';

$results = [];
$results['tabela_alvo'] = 'perfil_novo (assumida)';

// 1) Verifica se email já existe (não deveria)
$results['email_exists_before'] = $userModel->emailExists($email);

// 2) Cadastra
$hashed = password_hash($senha, PASSWORD_DEFAULT);
$createId = $userModel->create($nome, $username, $email, $hashed);
$results['create_id'] = $createId;
$results['email_exists_after'] = $userModel->emailExists($email);

// 3) Busca por email
$fEmail = $userModel->findByEmail($email);
$results['find_email'] = $fEmail ? 'OK' : 'FAIL';

// 4) Busca por username
$fUser = $userModel->findByUsername($username);
$results['find_username'] = $fUser ? 'OK' : 'FAIL';

// 5) Testa verificação de senha
$results['password_verify'] = ($fEmail && password_verify($senha, $fEmail['senha'])) ? 'OK' : 'FAIL';

// 6) Atualiza último login
if ($fEmail) {
    $results['update_last_login'] = $userModel->updateLastLogin($fEmail['id']) ? 'OK' : 'FAIL';
}

header('Content-Type: application/json');
echo json_encode([
    'fluxo' => 'cadastro+login básico',
    'dados_gerados' => [
        'nome' => $nome,
        'username' => $username,
        'email' => $email,
        'senha_clara' => $senha
    ],
    'resultados' => $results,
    'timestamp' => date('Y-m-d H:i:s')
], JSON_PRETTY_PRINT);
