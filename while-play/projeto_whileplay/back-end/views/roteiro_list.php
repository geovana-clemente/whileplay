<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Roteiros</title>
    <style>
        img {
            max-width: 150px;
            height: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
        }
    </style>
</head>
<body>

<h1>Roteiros</h1>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoria</th>
            <th>Imagem</th>
            <th>Visualizações</th>
            <th>ID da Assinatura</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($roteiros)): ?>
        <?php foreach ($roteiros as $roteiro): ?>
        <tr>
            <td><?= htmlspecialchars($roteiro['titulo']) ?></td>
            <td><?= htmlspecialchars($roteiro['categoria']) ?></td>
            <td>
                <?php 
                    // Atenção ao caminho relativo para a imagem
                    $imagemPath = '../' . $roteiro['caminho_imagem'];
                ?>
                <?php if (!empty($roteiro['caminho_imagem']) && file_exists($imagemPath)): ?>
                    <img src="/while_play/<?= htmlspecialchars($roteiro['caminho_imagem']) ?>" alt="Imagem do roteiro" />
                <?php else: ?>
                    Sem imagem
                <?php endif; ?>
            </td>
            <td><?= intval($roteiro['visualizacoes']) ?></td>
            <td><?= intval($roteiro['assinatura_id']) ?></td>
            <td>
                <a href="/while_play/update-roteiro/<?= $roteiro['id'] ?>">Atualizar</a>
                
                <form action="/while_play/delete-roteiro" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $roteiro['id'] ?>" />
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este roteiro?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6" style="text-align:center;">Nenhum roteiro cadastrado.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<a href="/while_play/public/roteiro">Novo roteiro</a>

</body>
</html>
