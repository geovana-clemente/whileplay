<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Pagamentos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        a.create-btn {
            display: block;
            width: 150px;
            margin: 10px auto 30px auto;
            padding: 8px 0;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Lista de Pagamentos</h1>

<a href="whileplay/while-play/projeto_whileplay/back-end/public/pagamento" class = create-btn >Novo Pagamento</a>

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
                        <a href="whileplay/while-play/projeto_whileplay/back-end/update-pagamento/<?php echo $pagamento['id_pagamento']; ?>">Editar</a>

                        <form action="whileplay/while-play/projeto_whileplay/back-end/delete-pagamento" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este pagamento?');" style="display:inline;">
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

</body>
</html>
