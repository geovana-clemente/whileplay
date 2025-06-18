<!-- ../views/personagens_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Personagem</title>
    <style>
        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 5px;
            border: 1px solid #aaa;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 1em;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-personagem" method="POST" enctype="multipart/form-data">
    <h2>Cadastrar Novo Personagem</h2>

    <label for="id_sobre">ID Sobre:</label>
    <input type="text" id="id_sobre" name="id_sobre" required>

    <label for="mais_bem_avaliados">Mais Bem Avaliados:</label>
    <input type="text" id="mais_bem_avaliados" name="mais_bem_avaliados" required>

    <label for="lançados_recentemente">Lançados Recentemente:</label>
    <input type="text" id="lançados_recentemente" name="lançados_recentemente" required>

    <label for="imagem">Imagem do Personagem:</label>
    <input type="file" id="imagem" name="imagem" accept="image/*">

    <button type="submit">Salvar</button>
</form>

<a class="back-link" href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-personagens">← Voltar para a lista de personagens</a>

</body>
</html>
