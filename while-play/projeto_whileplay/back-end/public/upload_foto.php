<?php
// upload_foto.php - Upload e atualização da foto de perfil do usuário
session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit();
}

require_once '../config/database.php';
require_once '../models/User.php';

$database = new Database();
$pdo = $database->getConnection();
$userModel = new User($pdo);

$user_id = (int) $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método inválido']);
    exit();
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Nenhuma imagem enviada.']);
    exit();
}

// Validar arquivo enviado
$fileTmpPath = $_FILES['foto']['tmp_name'];
$fileName = basename($_FILES['foto']['name']);
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
if (!in_array($ext, $allowed)) {
    echo json_encode(['success' => false, 'message' => 'Formato de imagem não permitido.']);
    exit();
}

// Limitar tamanho (5MB)
if (($_FILES['foto']['size'] ?? 0) > 5 * 1024 * 1024) {
    echo json_encode(['success' => false, 'message' => 'A imagem deve ter no máximo 5MB.']);
    exit();
}

// Garantir diretório de upload
$uploadDir = realpath(__DIR__ . '/../') . '/imagens/perfis/';
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

$newFileName = 'perfil_' . $user_id . '_' . uniqid('', true) . '.' . $ext;
$destPath = $uploadDir . $newFileName;

if (!move_uploaded_file($fileTmpPath, $destPath)) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
    exit();
}

// Caminho relativo que o front usa para exibir
$foto_url = 'imagens/perfis/' . $newFileName;

// Apagar imagem antiga (se existir)
$currentUser = $userModel->findById($user_id);
if ($currentUser && !empty($currentUser['foto_url'])) {
    $oldPath = realpath(__DIR__ . '/../') . '/' . $currentUser['foto_url'];
    if (is_file($oldPath)) {
        @unlink($oldPath);
    }
}

// Atualizar no banco tentando primeiro a tabela oficial (perfil_novo) e, em fallback, a antiga (perfil)
try {
    $stmt = $pdo->prepare('UPDATE perfil_novo SET foto_url = :foto_url WHERE id = :id');
    $stmt->execute([':foto_url' => $foto_url, ':id' => $user_id]);
} catch (Throwable $e) {
    // Se a tabela perfil_novo não existir neste ambiente, tentar na tabela perfil
    try {
        $stmt2 = $pdo->prepare('UPDATE perfil SET foto_url = :foto_url WHERE id = :id');
        $stmt2->execute([':foto_url' => $foto_url, ':id' => $user_id]);
    } catch (Throwable $e2) {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a foto no banco.']);
        exit();
    }
}

// Atualizar sessão
$_SESSION['user_foto'] = $foto_url;

echo json_encode(['success' => true, 'foto_url' => $foto_url]);
exit();
