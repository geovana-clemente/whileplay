<?php
session_start();
if (isset($_SESSION['assinatura_ativa']) && $_SESSION['assinatura_ativa']) {
    include __DIR__ . '/cabeçalho_assinatura.html';
} else {
    include __DIR__ . '/cabeçalho.html';
}
?>
