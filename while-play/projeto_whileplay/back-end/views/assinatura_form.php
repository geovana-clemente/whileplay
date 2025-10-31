<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Assinatura</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #333;
            margin-bottom: 25px;
        }

        form {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Nova Assinatura</h1>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-assinatura" method="POST">

        <label for="usuario_id">ID do Usuário:</label>
        <input type="number" id="usuario_id" name="usuario_id" required min="1" placeholder="Ex: 12">

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" maxlength="100" required placeholder="Digite a cidade">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" maxlength="255" required placeholder="Rua, número, bairro...">

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" pattern="\d{5}-?\d{3}" title="Formato esperado: 00000-000" placeholder="00000-000" maxlength="9">

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato esperado: 000.000.000-00" placeholder="000.000.000-00" maxlength="14">

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativa" selected>Ativa</option>
            <option value="inativa">Inativa</option>
            <option value="cancelada">Cancelada</option>
        </select>

        <label for="data_assinatura">Data da Assinatura:</label>
        <input type="date" id="data_assinatura" name="data_assinatura">

        <label for="data_cancelamento">Data de Cancelamento (opcional):</label>
        <input type="date" id="data_cancelamento" name="data_cancelamento">

        <input type="submit" value="Salvar Assinatura">
    </form>

    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-assinaturas">← Voltar para a lista</a>

</body>
</html>
