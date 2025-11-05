<?php
// upload_foto.php - Upload e atualização da foto de perfil do usuário
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit();
}

require_once '../config/database.php';
require_once '../models/User.php';

$database = new Database();
$pdo = $database->getConnection();
$userModel = new User($pdo);

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../imagens/perfis/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = basename($_FILES['foto']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Formato de imagem não permitido.']);
        exit();
    }
    $newFileName = 'perfil_' . $user_id . '_' . uniqid() . '.' . $ext;
    $destPath = $uploadDir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Salvar caminho relativo no banco
        $foto_url = 'imagens/perfis/' . $newFileName;
        $query = "UPDATE perfil SET foto_url = :foto_url WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':foto_url', $foto_url);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $_SESSION['user_foto'] = $foto_url;
        echo json_encode(['success' => true, 'foto_url' => $foto_url]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhuma imagem enviada.']);
    exit();
}
