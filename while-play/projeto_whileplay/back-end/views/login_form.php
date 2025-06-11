<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\views\login_form.php
$error = $error ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/while-play/projeto_whileplay/back-end/views/css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <p>Bem vindo de volta criativo!</p>
        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 1rem;"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <form method="POST" action="/while_play/login">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Logar</button>
        </form>
        <a href="/while-play/projeto_whileplay/front-end/views/recuperar_senha.html">Esqueceu sua senha?</a>
        <div class="footer">
            <a href="/while-play/projeto_whileplay/front-end/views/cadastro.html">Não tem login? Faça cadastro</a>
        </div>
    </div>
</body>
</html>
