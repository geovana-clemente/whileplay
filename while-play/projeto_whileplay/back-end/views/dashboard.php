<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\views\dashboard.php
include __DIR__ . '/auth_check.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h1>
    <a href="/while_play/logout">Sair</a>
</body>
</html>
