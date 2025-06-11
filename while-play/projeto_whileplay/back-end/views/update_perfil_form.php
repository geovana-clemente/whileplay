<!-- ../views/update_perfil_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Perfil</title>
    <style>
        form {
            width: 450px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #aaa;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .current-photo {
            margin-top: 10px;
            max-width: 150px;
            max-height: 150px;
            border-radius: 4px;
            border: 1px solid #ccc;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <form action="/meu_projeto/update-perfil" method="POST" enctype="multipart/form-data">
        <h2>Atualizar Perfil</h2>

        <!-- Campo oculto para identificar o perfil -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($perfilInfo['id']) ?>">

        <label for="nome_completo">Nome Completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" value="<?= htmlspecialchars($perfilInfo['nome_completo']) ?>" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($perfilInfo['username']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($perfilInfo['email']) ?>" required>

        <label for="senha">Senha: <small>(Deixe em branco para manter a atual)</small></label>
        <input type="password" id="senha" name="senha" placeholder="Nova senha">

        <label for="biografia">Biografia:</label>
        <textarea id="biografia" name="biografia" rows="4"><?= htmlspecialchars($perfilInfo['biografia']) ?></textarea>

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" id="data_criacao" name="data_criacao" value="<?= htmlspecialchars($perfilInfo['data_criacao']) ?>" required>

        <label>Foto Atual:</label>
        <?php if (!empty($perfilInfo['foto_url'])): ?>
            <img src="/meu_projeto/<?= htmlspecialchars($perfilInfo['foto_url']) ?>" alt="Foto do Perfil" class="current-photo">
        <?php else: ?>
            <p>Sem foto disponível.</p>
        <?php endif; ?>

        <label for="imagem">Alterar Foto:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*">

        <button type="submit">Salvar Alterações</button>
    </form>

    <a class="back-link" href="/meu_projeto/list-perfils">← Voltar para Lista de Perfis</a>

</body>
</html>

