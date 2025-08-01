<?php
// filepath: c:\Users\3anoA\Documents\WhilePlay\while-play\projeto_whileplay\back-end\views\cadastro_form.php
$error = $error ?? '';
$success = $success ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/while-play/projeto_whileplay/back-end/views/css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Cadastro</h1>
        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 1rem;"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div style="color: green; margin-bottom: 1rem;"> <?= htmlspecialchars($success) ?> </div>
        <?php endif; ?>
        <form method="POST" action="/while_play/cadastro">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="password_confirm" placeholder="Confirme a senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <div class="footer">
            <a href="/while-play/projeto_whileplay/front-end/views/login.html">Já tem login? Faça login</a>
        </div>
    </div>
</body>
</html>
