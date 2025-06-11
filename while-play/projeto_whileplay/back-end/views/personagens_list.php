<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lista de Personagens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        img {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
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

<h1>Personagens</h1>

<table>
    <thead>
        <tr>
            <th>Mais Bem Avaliados</th>
            <th>Lançados Recentemente</th>
            <th>Imagem</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($personagens)): ?>
        <?php foreach ($personagens as $personagem): ?>
        <tr>
            <td><?= htmlspecialchars($personagem['mais_bem_avaliados']) ?></td>
            <td><?= htmlspecialchars($personagem['lançados_recentemente']) ?></td>
            <td>
                <?php
                    $imgPath = '../' . $personagem['caminho_imagem'];
                ?>
                <?php if (!empty($personagem['caminho_imagem']) && file_exists($imgPath)): ?>
                    <img src="/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($personagem['caminho_imagem']) ?>" alt="Imagem do personagem" />
                <?php else: ?>
                    Sem imagem
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($personagem['created_at'])) ?></td>
            <td>
                <a href="/while-play/projeto_whileplay/back-end/update-personagem/<?= $personagem['id_sobre'] ?>">Atualizar</a>
                <form action="/while-play/projeto_whileplay/back-end/delete-personagem" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $personagem['id_sobre'] ?>" />
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este personagem?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">Nenhum personagem encontrado.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="/while-play/projeto_whileplay/back-end/public/personagem">Novo Personagem</a>

</body>
</html>
