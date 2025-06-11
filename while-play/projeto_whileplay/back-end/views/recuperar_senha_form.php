<?php
// Formulário de recuperação de senha (backend)
$error = $error ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="/while-play/projeto_whileplay/back-end/views/css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Recuperar Senha</h1>
        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 1rem;"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <form method="POST" action="/while_play/recuperar-senha">
            <input type="email" name="email" placeholder="Email cadastrado" required>
            <input type="password" name="nova_senha" placeholder="Nova senha" required>
            <input type="password" name="confirma_senha" placeholder="Confirme a nova senha" required>
            <button type="submit">Alterar Senha</button>
        </form>
        <div class="footer">
            <a href="/while-play/projeto_whileplay/front-end/views/login.html">Voltar ao login</a>
        </div>
    </div>
</body>
</html>
