<!-- ../views/update_perfil_form.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Perfil</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #222;
            color: #fff;
        }

        /* Container do formulário */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #303030;
            border-radius: 12px;
            border: 1px solid #555;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #FFD700;
        }

        /* Foto de perfil */
        .fotoperfil {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .fotoperfil img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #5B4CAF;
        }

        /* Seção de colunas */
        .form-section {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .coluna-esquerda, .coluna-direita {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .campo {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, textarea {
            padding: 10px;
            border: 1px solid #555;
            border-radius: 8px;
            font-size: 14px;
            background-color: #dddfff;
            color: #000;
        }

        input[type="file"] {
            background-color: #fff;
        }

        button {
            padding: 12px;
            background-color: #4E4CAF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #5345A0;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Foto atual dentro do formulário */
        .current-photo {
            margin-top: 10px;
            max-width: 150px;
            max-height: 150px;
            border-radius: 50%;
            border: 2px solid #5B4CAF;
            object-fit: cover;
        }

        /* Pequenos ajustes responsivos */
        @media (max-width: 700px) {
            .form-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Atualizar Perfil</h2>

    <div class="fotoperfil">
        <?php if (!empty($perfilInfo['foto_url'])): ?>
            <img src="/GitHub/whileplay/while-play/projeto_whileplay/back-end/<?= htmlspecialchars($perfilInfo['foto_url']) ?>" alt="Foto do Perfil">
        <?php else: ?>
            <img src="https://via.placeholder.com/150?text=Sem+Foto" alt="Sem Foto">
        <?php endif; ?>
    </div>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/update_perfil.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($perfilInfo['id']) ?>">

        <div class="form-section">
            <div class="coluna-esquerda">
                <div class="campo">
                    <label for="nome_completo">Nome Completo:</label>
                    <input type="text" id="nome_completo" name="nome_completo" value="<?= htmlspecialchars($perfilInfo['nome_completo']) ?>" required>
                </div>

                <div class="campo">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($perfilInfo['username']) ?>" required>
                </div>

                <div class="campo">
                    <label for="biografia">Biografia:</label>
                    <textarea id="biografia" name="biografia" rows="4"><?= htmlspecialchars($perfilInfo['biografia']) ?></textarea>
                </div>
            </div>

            <div class="coluna-direita">
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($perfilInfo['email']) ?>" required>
                </div>

                <div class="campo">
                    <label for="senha">Senha: <small>(Deixe em branco para manter a atual)</small></label>
                    <input type="password" id="senha" name="senha" placeholder="Nova senha">
                </div>

                <div class="campo">
                    <label for="data_criacao">Data de Criação:</label>
                    <input type="date" id="data_criacao" name="data_criacao" value="<?= htmlspecialchars($perfilInfo['data_criacao']) ?>" required>
                </div>

                <div class="campo">
                    <label for="imagem">Alterar Foto:</label>
                    <input type="file" id="imagem" name="imagem" accept="image/*">
                </div>

                <button type="submit">Salvar Alterações</button>
            </div>
        </div>
    </form>

    <a class="back-link" href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-perfils">← Voltar para Lista de Perfis</a>
</div>

</body>
</html>
