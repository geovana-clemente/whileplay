<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\views\auth_check.php
// Inclua este arquivo no topo de páginas protegidas para exigir login
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /while-play/projeto_whileplay/front-end/views/login.html');
    exit;
}
