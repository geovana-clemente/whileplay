<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Assinaturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f8f9fa;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background-color: #fff;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            display: inline;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #c82333;
        }
        .new-link {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        .new-link:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1>Lista de Assinaturas</h1>

    <?php if (!empty($assinaturas)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Usuário</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>CPF</th>
                <th>Status</th>
                <th>Data Assinatura</th>
                <th>Data Cancelamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($assinaturas as $assinatura): ?>
            <tr>
                <td><?= htmlspecialchars($assinatura['id']) ?></td>
                <td><?= htmlspecialchars($assinatura['usuario_id']) ?></td>
                <td><?= htmlspecialchars($assinatura['cidade']) ?></td>
                <td><?= htmlspecialchars($assinatura['endereco']) ?></td>
                <td><?= htmlspecialchars($assinatura['cep']) ?></td>
                <td><?= htmlspecialchars($assinatura['cpf']) ?></td>
                <td><?= htmlspecialchars($assinatura['status']) ?></td>
                <td><?= htmlspecialchars($assinatura['data_assinatura']) ?></td>
                <td><?= htmlspecialchars($assinatura['data_cancelamento'] ?? '-') ?></td>
                <td>
                    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-assinatura/<?= $assinatura['id'] ?>">Editar</a>

                    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-assinatura" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $assinatura['id'] ?>">
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta assinatura?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Nenhuma assinatura encontrada.</p>
    <?php endif; ?>

    <a class="new-link" href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/assinatura">Nova Assinatura</a>

</body>
</html>
