<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Publicações</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        img {
            max-width: 120px;
            height: auto;
            border-radius: 6px;
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

<h1>Publicações</h1>

<table>
    <thead>
        <tr>
            <th>Usuário ID</th>
            <th>Título</th>
            <th>Sinopse</th>
            <th>Tipo</th>
            <th>Email</th>
            <th>Arquivo</th>
            <th>Data de Criação</th>
            <th>Publicado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($publicados)): ?>
        <?php foreach ($publicados as $item): ?>
        <tr>
            <td><?= intval($item['usuario_id']) ?></td>
            <td><?= htmlspecialchars($item['titulo']) ?></td>
            <td><?= nl2br(htmlspecialchars($item['sinopse'])) ?></td>
            <td><?= htmlspecialchars($item['tipo']) ?></td>
            <td><?= htmlspecialchars($item['email'] ?? '') ?></td>
            <td>
                <?php
                    $arquivoPath = '../' . $item['arquivo_url'];
                    $ext = strtolower(pathinfo($item['arquivo_url'], PATHINFO_EXTENSION));
                ?>
                <?php if (!empty($item['arquivo_url']) && file_exists($arquivoPath)): ?>
<<<<<<< HEAD
                    <img src="/GitHub/whileplay/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($item['arquivo_url']) ?>" alt="Imagem" />
=======
                    <?php if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])): ?>
                        <img src="/meu_projeto/<?= htmlspecialchars($item['arquivo_url']) ?>" alt="Imagem" />
                    <?php elseif (in_array($ext, ['doc', 'docx'])): ?>
                        <a href="/meu_projeto/<?= htmlspecialchars($item['arquivo_url']) ?>" target="_blank">Baixar Documento</a>
                    <?php else: ?>
                        <a href="/meu_projeto/<?= htmlspecialchars($item['arquivo_url']) ?>" target="_blank">Ver Arquivo</a>
                    <?php endif; ?>
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
                <?php else: ?>
                    Sem arquivo
                <?php endif; ?>
            </td>
            <td><?= date('d/m/Y H:i', strtotime($item['data_criacao'])) ?></td>
            <td><?= $item['publicado'] ? 'Sim' : 'Não' ?></td>
            <td>
                <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-publicar/<?= $item['id'] ?>">Atualizar</a>
                <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-publicar" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>" />
                    <button type="submit" onclick="return confirm('Deseja excluir esta publicação?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="9">Nenhuma publicação cadastrada.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar">Nova Publicação</a>

</body>
</html>

