<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Adamina&display=swap');
        @import url('https://fonts.googleapis.com/css?family=PT+Mono|Quicksand:400,700&display=swap');

        :root {
            --coral: #EF533D;
            --navy: #0F1626;
            --leather: #AB987A;
            --eggshell: #F5F5F5;
        }

        body {
            margin: 0;
            font-family: 'Quicksand', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('/while-play/projeto_whileplay/front-end/public/MEDIA/imagens/backgroundclean.png') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: var(--navy);
            font-family: 'Adamina', serif;
            margin-bottom: 2rem;
        }

        form {
            background: white;
            padding: 3rem 2rem;
            border-radius: 1rem;
            box-shadow: 
                2px 2px 8px rgba(15,22,38,0.05),
                0 0 64px rgba(15,22,38,0.1);
            width: 350px;
        }

        label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: bold;
            color: var(--navy);
        }

        input[type="text"],
        input[type="number"],
        input[type="month"] {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-family: inherit;
        }

        input[type="submit"] {
            width: 100%;
            background: var(--coral);
            border: none;
            color: white;
            font-family: inherit;
            font-weight: 700;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
            background: var(--navy);
        }

        a h4 {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--coral);
            cursor: pointer;
            transition: color 0.2s;
        }

        a h4:hover {
            color: var(--navy);
        }

        /* Responsividade */
        @media (max-width: 400px) {
            form {
                width: 90%;
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div>
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
    </div>
</body>
</html>
