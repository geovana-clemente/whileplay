<!-- ../views/suporte_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Enviar Suporte</title>
    <style>
        form {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #aaa;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <form action="/meu_projeto/save-suporte" method="POST">
        <h2>Formulário de Suporte</h2>

        <label for="usuario_id">ID do Usuário:</label>
        <input type="text" name="usuario_id" id="usuario_id" required>

        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" rows="5" required></textarea>

        <label for="data_envio">Data de Envio:</label>
        <input type="date" name="data_envio" id="data_envio" required>

        <button type="submit">Enviar</button>
    </form>

    <a class="back-link" href="/meu_projeto/list-suportes">← Voltar para Lista de Suporte</a>

</body>
</html>
