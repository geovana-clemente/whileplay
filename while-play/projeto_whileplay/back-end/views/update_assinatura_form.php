<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Assinatura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fafafa;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 420px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Atualizar Assinatura</h1>

<form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-assinatura" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($assinaturaInfo['id']) ?>">

    <label for="usuario_id">ID do Usuário:</label>
    <input type="number" id="usuario_id" name="usuario_id" value="<?= htmlspecialchars($assinaturaInfo['usuario_id']) ?>" required>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($assinaturaInfo['cidade']) ?>" required>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($assinaturaInfo['endereco']) ?>" required>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($assinaturaInfo['cep']) ?>" pattern="\d{5}-?\d{3}" title="Formato: 00000-000" required>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($assinaturaInfo['cpf']) ?>" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 000.000.000-00">

    <label for="data_assinatura">Data de Assinatura:</label>
    <input type="date" id="data_assinatura" name="data_assinatura" value="<?= htmlspecialchars($assinaturaInfo['data_assinatura']) ?>" required>

    <input type="submit" value="Atualizar">
</form>

<a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas">← Voltar para a lista</a>

</body>
</html>
