<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Roteiros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f7f7f7;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            max-width: 120px;
            height: auto;
            border-radius: 6px;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-update {
            background-color: #007bff;
            color: white;
        }

        .btn-update:hover {
            background-color: #0069d9;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .novo-roteiro {
            display: inline-block;
            margin-top: 25px;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .novo-roteiro:hover {
            background-color: #218838;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>
<body>

<h1>Lista de Roteiros</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
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
            <td><?= intval($roteiro['id']) ?></td>
            <td><?= htmlspecialchars($roteiro['titulo']) ?></td>
            <td><?= htmlspecialchars($roteiro['categoria']) ?></td>
            <td>
                <?php 
                    $imagemPath = '../' . $roteiro['caminho_imagem'];
                    if (!empty($roteiro['caminho_imagem']) && file_exists($imagemPath)): 
                ?>
                    <img src="/GitHub/whileplay/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($roteiro['caminho_imagem']) ?>" alt="Imagem do roteiro" />
                <?php else: ?>
                    <span style="color: #888;">Sem imagem</span>
                <?php endif; ?>
            </td>
            <td><?= intval($roteiro['visualizacoes']) ?></td>
            <td><?= intval($roteiro['assinatura_id']) ?></td>
            <td>
                <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update-roteiro/<?= $roteiro['id'] ?>" class="btn btn-update">Atualizar</a>
                
                <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/delete-roteiro" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $roteiro['id'] ?>" />
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir este roteiro?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7" class="no-data">Nenhum roteiro cadastrado.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<div style="text-align:center;">
    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/roteiro" class="novo-roteiro">+ Novo Roteiro</a>
</div>

</body>
</html>
