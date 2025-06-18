<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assinaturas</title>

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

    <h1>Assinaturas</h1>

    <form action="/while_play/save-assinatura" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cidade">Cidade:</label><br>
        <input type="text" id="cidade" name="cidade" required><br><br>

        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="cep">CEP:</label><br>
        <input type="text" id="cep" name="cep" pattern="\d{5}-?\d{3}" title="Formato esperadoo:o 00000-000"><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato esperado: 000.000.000-00"><br><br>

        <label for="data_assinatura">Data de assinatura:</label><br>
        <input type="date" id="data_assinatura" name="data_assinatura" required><br><br>

        <input type="submit" value="Salvar Assinatura">
    </form>

    <a href="/while_play/list-assinaturas"><h4>Ver todas as assinaturas</h4></a>

</body>
</html>
