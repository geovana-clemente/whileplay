<!-- ../views/publicar_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Publicação</title>
    <style>
        form {
            width: 90%;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea, select {
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
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Nova Publicação</h2>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-publicar" method="POST" enctype="multipart/form-data">
        <label for="usuario_id">ID do Usuário:</label>
        <input type="number" name="usuario_id" id="usuario_id" required>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="sinopse">Sinopse:</label>
        <textarea name="sinopse" id="sinopse" rows="4" required></textarea>

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="">Selecione</option>
            <option value="anime">Anime</option>
            <option value="manga">Mangá</option>
            <option value="outro">Outro</option>
        </select>

        <label for="imagem">Imagem (opcional):</label>
        <input type="file" name="imagem" id="imagem" accept="image/*">

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" name="data_criacao" id="data_criacao" required>

        <label for="publicado">Publicado:</label>
        <select name="publicado" id="publicado" required>
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select>

        <button type="submit">Salvar Publicação</button>
    </form>

</body>
</html>
