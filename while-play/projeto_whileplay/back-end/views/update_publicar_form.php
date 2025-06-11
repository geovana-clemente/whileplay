<!-- ../views/update_publicar_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Atualizar Publicação</title>
    <style>
        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #aaa;
            box-sizing: border-box;
            font-size: 1em;
        }
        button {
            margin-top: 20px;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 25px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .current-image {
            margin-top: 10px;
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ccc;
            border-radius: 6px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<form action="/meu_projeto/update-publicar" method="POST" enctype="multipart/form-data">
    <h2>Atualizar Publicação</h2>

    <!-- Campo oculto para identificar a publicação -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($publicarInfo['id']) ?>">

    <label for="usuario_id">ID do Usuário:</label>
    <input type="text" id="usuario_id" name="usuario_id" value="<?= htmlspecialchars($publicarInfo['usuario_id']) ?>" required>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($publicarInfo['titulo']) ?>" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($publicarInfo['email'] ?? '') ?>" required>

    <label for="sinopse">Sinopse:</label>
    <textarea id="sinopse" name="sinopse" rows="4" required><?= htmlspecialchars($publicarInfo['sinopse']) ?></textarea>

    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
        <option value="roteiro" <?= ($publicarInfo['tipo'] == 'roteiro') ? 'selected' : '' ?>>Roteiro</option>
        <option value="personagem" <?= ($publicarInfo['tipo'] == 'personagem') ? 'selected' : '' ?>>Personagem</option>
        <option value="outro" <?= ($publicarInfo['tipo'] == 'outro') ? 'selected' : '' ?>>Outro</option>
    </select>

    <label for="data_criacao">Data de Criação:</label>
    <input type="date" id="data_criacao" name="data_criacao" value="<?= htmlspecialchars($publicarInfo['data_criacao']) ?>" required>

    <label>Arquivo Atual:</label>
    <?php if (!empty($publicarInfo['arquivo_url'])): ?>
        <a href="/meu_projeto/<?= htmlspecialchars($publicarInfo['arquivo_url']) ?>" target="_blank">Ver arquivo atual</a>
    <?php else: ?>
        <p>Sem arquivo disponível.</p>
    <?php endif; ?>

    <label for="arquivo">Alterar Arquivo (PNG, DOC, DOCX):</label>
    <input type="file" id="arquivo" name="arquivo" accept=".png,.doc,.docx">

    <label for="publicado">Publicado:</label>
    <select id="publicado" name="publicado" required>
        <option value="1" <?= ($publicarInfo['publicado'] == 1) ? 'selected' : '' ?>>Sim</option>
        <option value="0" <?= ($publicarInfo['publicado'] == 0) ? 'selected' : '' ?>>Não</option>
    </select>

    <button type="submit">Salvar Alterações</button>
</form>

<a href="/meu_projeto/list-publicados" class="back-link">← Voltar para Lista de Publicações</a>

</body>
</html>
