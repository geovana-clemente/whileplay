<!-- ../views/update_suporte_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Atualizar Suporte</title>
    <style>
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], textarea, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #aaa;
            box-sizing: border-box;
            font-size: 1em;
        }
        button {
            margin-top: 20px;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 25px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-suporte" method="POST">
    <h2>Atualizar Suporte</h2>

    <!-- Campo oculto para identificar o registro -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($suporteInfo['id']) ?>">

    <label for="usuario_id">ID do Usuário:</label>
    <input type="text" id="usuario_id" name="usuario_id" value="<?= htmlspecialchars($suporteInfo['usuario_id']) ?>" required>

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" rows="4" required><?= htmlspecialchars($suporteInfo['mensagem']) ?></textarea>

    <label for="data_envio">Data de Envio:</label>
    <input type="date" id="data_envio" name="data_envio" value="<?= htmlspecialchars($suporteInfo['data_envio']) ?>" required>

    <button type="submit">Salvar Alterações</button>
</form>

<a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-suportes" class="back-link">← Voltar para Lista de Suportes</a>

</body>
</html>
