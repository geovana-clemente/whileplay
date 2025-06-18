<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Atualizar Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        form {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px 6px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }
        a {
            display: block;
            margin: 15px auto;
            text-align: center;
            color: #555;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Atualizar Pagamento</h2>

<form action="/while_play/update-pagamento" method="POST">

    <label for="id_pagamento">ID do Pagamento:</label>
    <input type="hidden" name="id_pagamento" value="<?php echo htmlspecialchars($pagamentoInfo['id_pagamento']); ?>">

    <label for="nome_do_cartao">Nome no Cartão:</label>
    <input type="text" id="nome_do_cartao" name="nome_do_cartao" value="<?php echo htmlspecialchars($pagamentoInfo['nome_do_cartao']); ?>" required>

    <label for="numero_do_cartao">Número do Cartão:</label>
    <input type="text" id="numero_do_cartao" name="numero_do_cartao" value="<?php echo htmlspecialchars($pagamentoInfo['numero_do_cartao']); ?>" required pattern="\d{13,19}" title="Insira um número válido do cartão">

    <label for="data_de_vencimento">Data de Vencimento:</label>
    <input type="month" id="data_de_vencimento" name="data_de_vencimento" value="<?php echo htmlspecialchars($pagamentoInfo['data_de_vencimento']); ?>" required>

    <label for="codigo">Código:</label>
    <input type="text" id="codigo" name="codigo" value="<?php echo htmlspecialchars($pagamentoInfo['codigo']); ?>" required pattern="\d{3,4}" title="Código de 3 ou 4 dígitos">

    <input type="submit" value="Atualizar Pagamento">
</form>

<a href="/while_play/list-pagamentos">Voltar para a lista de pagamentos</a>

</body>
</html>
