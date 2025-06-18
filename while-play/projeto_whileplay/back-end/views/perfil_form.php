<!-- ../views/perfil_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Perfil</title>
    <style>
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Criar Novo Perfil</h2>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-perfil" method="POST" enctype="multipart/form-data">
        <label for="nome_completo">Nome Completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" required>

        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="biografia">Biografia:</label>
        <textarea id="biografia" name="biografia" rows="4"></textarea>

        <label for="imagem">Foto de Perfil:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*">

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" id="data_criacao" name="data_criacao" required>

        <button type="submit">Salvar Perfil</button>
    </form>

</body>
</html>
