<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="month"] {
            width: 300px;
            padding: 5px;
            font-size: 1rem;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 8px 15px;
            font-size: 1rem;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Cadastro de Pagamento</h1>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-pagamento" method="POST" autocomplete="off">
        <label for="id_assinatura">ID da Assinatura:</label>
        <input type="number" id="id_assinatura" name="id_assinatura" required placeholder="Digite o ID da assinatura">

        <label for="nome_do_cartao">Nome no Cartão:</label>
        <input type="text" id="nome_do_cartao" name="nome_do_cartao" required autocomplete="cc-name" placeholder="Como aparece no cartão">

        <label for="numero_do_cartao">Número do Cartão:</label>
        <input type="text" id="numero_do_cartao" name="numero_do_cartao" required pattern="\d{13,19}" title="Digite entre 13 e 19 dígitos" autocomplete="cc-number" placeholder="Somente números">

        <label for="data_de_vencimento">Data de Vencimento:</label>
        <input type="month" id="data_de_vencimento" name="data_de_vencimento" required autocomplete="cc-exp">

        <label for="codigo">Código de Segurança (CVV):</label>
        <input type="text" id="codigo" name="codigo" required pattern="\d{3,4}" title="3 ou 4 dígitos" autocomplete="cc-csc" placeholder="3 ou 4 dígitos">

        <input type="submit" value="Salvar Pagamento">

    </form>
<a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-pagamentos"><h4>Ver todos os pagamentos</h4></a>

</body>
</html>
