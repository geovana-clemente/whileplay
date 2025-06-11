<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Suporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        a, button {
            margin: 0 5px;
            text-decoration: none;
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover, a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Mensagens de Suporte</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário ID</th>
            <th>Mensagem</th>
            <th>Data de Envio</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($suportes)): ?>
        <?php foreach ($suportes as $s): ?>
        <tr>
            <td><?= intval($s['id']) ?></td>
            <td><?= intval($s['usuario_id']) ?></td>
            <td><?= nl2br(htmlspecialchars($s['mensagem'])) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($s['data_envio'])) ?></td>
            <td><?= htmlspecialchars(ucfirst($s['status'])) ?></td>
            <td>
                <a href="/meu_projeto/update-suporte/<?= $s['id'] ?>">Atualizar</a>
                <form action="/meu_projeto/delete-suporte" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $s['id'] ?>" />
                    <button type="submit" onclick="return confirm('Deseja excluir esta mensagem de suporte?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">Nenhuma mensagem encontrada.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="/meu_projeto/public/suporte">Nova Mensagem</a>

</body>
</html>
