<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Roteiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        form { max-width: 400px; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background-color: #28a745; color: white; border: none; padding: 10px 15px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #218838; }
        a { display: inline-block; margin-top: 10px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h1>Atualizar Roteiro</h1>

    <form action="update-roteiro.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($roteiroInfo['id']); ?>">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($roteiroInfo['titulo']); ?>" required>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="Mais bem avaliados" <?php if($roteiroInfo['categoria'] == 'Mais bem avaliados') echo 'selected'; ?>>Mais bem avaliados</option>
            <option value="Lançados recentemente" <?php if($roteiroInfo['categoria'] == 'Lançados recentemente') echo 'selected'; ?>>Lançados recentemente</option>
        </select>

        <label>Imagem atual:</label><br>
        <img src="<?php echo htmlspecialchars($roteiroInfo['caminho_imagem']); ?>" alt="Imagem do roteiro" style="max-width:200px; max-height:150px;"><br><br>

        <label for="imagem">Trocar imagem (opcional):</label>
        <input type="file" id="imagem" name="imagem" accept="image/*">

        <label for="visualizacoes">Visualizações:</label>
        <input type="number" id="visualizacoes" name="visualizacoes" value="<?php echo htmlspecialchars($roteiroInfo['visualizacoes']); ?>" min="0">

        <label for="assinatura_id">ID da assinatura:</label>
        <input type="number" id="assinatura_id" name="assinatura_id" value="<?php echo htmlspecialchars($roteiroInfo['assinatura_id']); ?>">

        <input type="submit" value="Atualizar Roteiro">
    </form>

    <a href="list-roteiros.php">Voltar para a lista de roteiros</a>

</body>
</html>
