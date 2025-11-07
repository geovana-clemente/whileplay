<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Perfil</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* RESET BÁSICO */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            background-color: #222222;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            padding: 30px 20px;
            background: rgb(48, 48, 48);
            border: 1px solid #ccc;
            border-radius: 12px;
        }

        .form-section {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .coluna-esquerda,
        .coluna-direita {
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
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            resize: vertical;
            background-color: rgb(221, 239, 255);
            color: #000;
        }

        button {
            padding: 12px;
            background: rgb(78, 76, 175);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background: rgb(83, 69, 160);
        }

        @media (max-width: 700px) {
            .form-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Criar Novo Perfil</h2>

        <form class="form-section" action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-perfil" method="POST" enctype="multipart/form-data">
            <div class="coluna-esquerda">
                <div class="campo">
                    <label for="nome_completo">Nome Completo:</label>
                    <input type="text" id="nome_completo" name="nome_completo" required>
                </div>

                <div class="campo">
                    <label for="username">Nome de Usuário:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="campo">
                    <label for="biografia">Biografia:</label>
                    <textarea id="biografia" name="biografia" rows="4"></textarea>
                </div>

                <div class="campo">
                    <label for="imagem">Foto de Perfil:</label>
                    <input type="file" id="imagem" name="imagem" accept="image/*">
                </div>
            </div>

            <div class="coluna-direita">
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="campo">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="campo">
                    <label for="data_criacao">Data de Criação:</label>
                    <input type="date" id="data_criacao" name="data_criacao" required>
                </div>

                <button type="submit">Salvar Perfil</button>
            </div>
        </form>
    </div>

</body>
</html>
