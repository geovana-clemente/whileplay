<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Roteiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Criar Novo Roteiro</h1>

    <form action="/while_play/save-roteiro" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="categoria">Categoria:</label><br>
        <input type="text" id="categoria" name="categoria" required><br><br>

        <label for="imagem">Imagem:</label><br>
        <input type="file" id="imagem" name="imagem" accept="image/*" required><br><br>

        <label for="visualizacoes">Visualizações:</label><br>
        <input type="number" id="visualizacoes" name="visualizacoes" value="0" min="0"><br><br>

        <label for="assinatura_id">ID da Assinatura:</label><br>
        <input type="number" id="assinatura_id" name="assinatura_id" required><br><br>

        <input type="submit" value="Salvar Roteiro">
    </form>

    <br>
    <a href="/while_play/list-roteiros">Ver todos os roteiros</a>

</body>
</html>
