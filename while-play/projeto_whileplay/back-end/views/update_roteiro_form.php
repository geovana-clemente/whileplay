<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Roteiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <h1>Atualizar Roteiro</h1>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-roteiro" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($roteiroInfo['id']); ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($roteiroInfo['titulo']); ?>" required><br><br>

        <label for="categoria">Categoria:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($roteiroInfo['categoria']); ?>" required><br><br>

        <label>Imagem atual:</label><br>
        <img src="/Sistema CRUD-Projeto/<?php echo htmlspecialchars($roteiroInfo['caminho_imagem']); ?>" alt="Imagem do roteiro" style="max-width:200px; max-height:150px;"><br><br>

        <label for="imagem">Trocar imagem (opcional):</label><br>
        <input type="file" id="imagem" name="imagem" accept="image/*"><br><br>

        <label for="visualizacoes">Visualizações:</label><br>
        <input type="number" id="visualizacoes" name="visualizacoes" value="<?php echo htmlspecialchars($roteiroInfo['visualizacoes']); ?>" min="0"><br><br>

        <label for="assinatura_id">ID da assinatura:</label><br>
        <input type="number" id="assinatura_id" name="assinatura_id" value="<?php echo htmlspecialchars($roteiroInfo['assinatura_id']); ?>" required><br><br>

        <input type="submit" value="Atualizar Roteiro">
    </form>

    <br>
    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros">Voltar para a lista de roteiros</a>

</body>
</html>
