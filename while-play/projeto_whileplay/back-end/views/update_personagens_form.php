<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Personagem</title>
    <style>
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        label, input, textarea {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        input[type="text"], input[type="file"], textarea {
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #aaa;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        img {
            max-width: 150px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Editar Personagem</h2>

<form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/update-personagens" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_sobre" value="<?= htmlspecialchars($personagemInfo['id_sobre']) ?>">
    
    <label for="nome">Nome do Personagem:</label>
    <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($personagemInfo['nome']) ?>" required>
    
    <label for="descricao">Descrição:</label>
    <textarea name="descricao" id="descricao" rows="4" required><?= htmlspecialchars($personagemInfo['descricao']) ?></textarea>

    <label for="imagem">Imagem Atual:</label>
    <?php if (!empty($personagemInfo['caminho_imagem'])): ?>
        <img src="/GitHub/whileplay/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($personagemInfo['caminho_imagem']) ?>" alt="Imagem Atual">
    <?php else: ?>
        <p>Sem imagem.</p>
    <?php endif; ?>

    <label for="imagem">Nova Imagem (opcional):</label>
    <input type="file" name="imagem" id="imagem" accept="image/*">

    <input type="submit" value="Salvar Alterações">
    <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($personagemInfo['usuario_id'] ?? '') ?>">
</form>

</body>
</html>
