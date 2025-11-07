<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Pagamentos</title>
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
            align-items: flex-start;
            min-height: 100vh;
            background: url('/while-play/projeto_whileplay/front-end/public/MEDIA/imagens/backgroundclean.png') no-repeat center center fixed;
            background-size: cover;
            padding: 2rem 0;
        }

        h1 {
            text-align: center;
            color: var(--navy);
            font-family: 'Adamina', serif;
            margin-bottom: 2rem;
        }

        .container {
            width: 95%;
            max-width: 1000px;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 
                2px 2px 8px rgba(15,22,38,0.05),
                0 0 64px rgba(15,22,38,0.1);
        }

        a.create-btn {
            display: inline-block;
            margin-bottom: 1.5rem;
            padding: 0.7rem 1.5rem;
            text-decoration: none;
            background: var(--coral);
            color: white;
            border-radius: 0.5rem;
            font-weight: 700;
            transition: background 0.2s;
        }

        a.create-btn:hover {
            background: var(--navy);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: var(--eggshell);
            color: var(--navy);
            font-weight: 700;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions a, .actions button {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            margin-right: 0.3rem;
            font-size: 0.9rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            transition: background 0.2s;
        }

        .actions a {
            background: var(--coral);
        }

        .actions a:hover {
            background: var(--navy);
        }

        .actions button {
            background: #888;
        }

        .actions button:hover {
            background: var(--coral);
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                text-align: right;
                padding-right: 50%;
                position: relative;
            }

            th::after {
                content: ":";
                position: absolute;
                right: 10px;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                position: absolute;
                left: 10px;
                font-weight: bold;
            }

            td:nth-of-type(1)::before { content: "ID"; }
            td:nth-of-type(2)::before { content: "Nome no Cartão"; }
            td:nth-of-type(3)::before { content: "Número do Cartão"; }
            td:nth-of-type(4)::before { content: "Data de Vencimento"; }
            td:nth-of-type(5)::before { content: "Código"; }
            td:nth-of-type(6)::before { content: "Ações"; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Pagamentos</h1>

        <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/pagamento" class="create-btn">Novo Pagamento</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome no Cartão</th>
                    <th>Número do Cartão</th>
                    <th>Data de Vencimento</th>
                    <th>Código</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pagamentos)): ?>
                    <?php foreach ($pagamentos as $pagamento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pagamento['id_pagamento']); ?></td>
                            <td><?php echo htmlspecialchars($pagamento['nome_do_cartao']); ?></td>
                            <td><?php echo htmlspecialchars($pagamento['numero_do_cartao']); ?></td>
                            <td><?php echo htmlspecialchars($pagamento['data_de_vencimento']); ?></td>
                            <td><?php echo htmlspecialchars($pagamento['codigo']); ?></td>
                            <td class="actions">
                                <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-pagamento/<?php echo $pagamento['id_pagamento']; ?>">Editar</a>

                                <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-pagamento" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este pagamento?');" style="display:inline;">
                                    <input type="hidden" name="id_pagamento" value="<?php echo $pagamento['id_pagamento']; ?>">
                                    <button type="submit">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align:center;">Nenhum pagamento cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
