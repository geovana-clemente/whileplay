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
        input[type="date"] {
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

<h1>Atualizar Assinatura</h1>

<form action="/while-play/projeto_whileplay/back-end/update-assinatura" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($assinaturaInfo['id']) ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($assinaturaInfo['nome']) ?>" required><br><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($assinaturaInfo['cidade']) ?>" required><br><br>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($assinaturaInfo['endereco']) ?>" required><br><br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($assinaturaInfo['cep']) ?>" pattern="\d{5}-?\d{3}" title="Formato: 00000-000"><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($assinaturaInfo['cpf']) ?>" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 000.000.000-00"><br><br>

    <label for="data_assinatura">Data de Assinatura:</label>
    <input type="date" id="data_assinatura" name="data_assinatura" value="<?= htmlspecialchars($assinaturaInfo['data_assinatura']) ?>" required><br><br>

    <input type="submit" value="Atualizar">
</form>

<a href="/while-play/projeto_whileplay/back-end/list-assinaturas">Voltar para a lista</a>

</body>
</html>
