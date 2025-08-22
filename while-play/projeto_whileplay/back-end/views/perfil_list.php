<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lista de Perfis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        img {
            max-width: 100px;
            height: auto;
            border-radius: 50%;
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

<h1>Perfis Cadastrados</h1>

<table>
    <thead>
        <tr>
            <th>Nome Completo</th>
            <th>Username</th>
            <th>Email</th>
            <th>Biografia</th>
            <th>Foto</th>
            <th>Data de Criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($perfis)): ?>
        <?php foreach ($perfis as $perfil): ?>
        <tr>
            <td><?= htmlspecialchars($perfil['nome_completo']) ?></td>
            <td><?= htmlspecialchars($perfil['username']) ?></td>
            <td><?= htmlspecialchars($perfil['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($perfil['biografia'])) ?></td>
            <td>
                <?php
                    $fotoPath = '../' . $perfil['foto_url'];
                ?>
                <?php if (!empty($perfil['foto_url']) && file_exists($fotoPath)): ?>
                    <img src="/GitHub/whileplay/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($perfil['foto_url']) ?>" alt="Foto de perfil" />
                <?php else: ?>
                    Sem foto
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($perfil['data_criacao'])) ?></td>
            <td>
                <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-perfil/<?= $perfil['id'] ?>">Atualizar</a>
                <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-perfil" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $perfil['id'] ?>" />
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este perfil?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7">Nenhum perfil encontrado.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil">Criar Novo Perfil</a>

</body>
</html>
