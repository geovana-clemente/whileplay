<?php
// auth_check.php
session_start();

/*
  Este script protege páginas restritas.
  Ele deve ser incluído no início de cada arquivo PHP protegido:
  → include __DIR__ . '/auth_check.php';
*/

// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
    // Redireciona para a página de login
    header("Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/login.php");
    exit();
}

// (Opcional) – Verifica também o tempo de inatividade (30 minutos)
$tempo_limite = 30 * 60; // 30 minutos em segundos

if (isset($_SESSION['ultimo_acesso'])) {
    if (time() - $_SESSION['ultimo_acesso'] > $tempo_limite) {
        // Destroi a sessão e redireciona
        session_unset();
        session_destroy();
        header("Location: /GitHub/whileplay/while-play/projeto_whileplay/back-end/login.php?timeout=1");
        exit();
    }
}

// Atualiza o tempo do último acesso
$_SESSION['ultimo_acesso'] = time();
?>
