<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Assinaturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: #007bff;
            text-decoration: none;
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
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <h1>Lista de Assinaturas</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>CPF</th>
                <th>Data de Assinatura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($assinaturas as $assinatura): ?>
            <tr>
                <td><?= htmlspecialchars($assinatura['nome']) ?></td>
                <td><?= htmlspecialchars($assinatura['cidade']) ?></td>
                <td><?= htmlspecialchars($assinatura['endereco']) ?></td>
                <td><?= htmlspecialchars($assinatura['cep']) ?></td>
                <td><?= htmlspecialchars($assinatura['cpf']) ?></td>
                <td><?= htmlspecialchars($assinatura['data_assinatura']) ?></td>
                <td>
                    <a href="/while_play/update-assinatura/<?= $assinatura['id'] ?>">Atualizar</a>

                    <form action="/while_play/delete-assinatura" method="POST" style="display:inline;">
                        <input type="hidden" name="nome" value="<?= $assinatura['nome'] ?>">
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta assinatura?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br>
   <a href="/while_play/public/assinatura">Nova assinatura</a>


</body>
</html>
