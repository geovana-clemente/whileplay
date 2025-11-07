<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lista de Perfis</title>
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
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #2e2e2e;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3e3e3e;
            font-weight: bold;
            border-bottom: 2px solid #555;
        }

        tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        tr:hover {
            background-color: #444444;
        }

        img {
            max-width: 80px;
            height: auto;
            border-radius: 50%;
            border: 2px solid #555;
        }

        a, button {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        a {
            background-color: #4e4caf;
            color: #fff;
        }

        a:hover {
            background-color: #6363c2;
        }

        button {
            background-color: #ff4c4c;
            color: #fff;
        }

        button:hover {
            background-color: #e63939;
        }

        .novo-perfil {
            display: inline-block;
            margin-top: 15px;
            background-color: #4caf50;
            color: #fff;
            padding: 10px 25px;
            border-radius: 25px;
            text-align: center;
        }

        .novo-perfil:hover {
            background-color: #66bb6a;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            th, td {
                padding: 10px;
            }

            img {
                max-width: 50px;
            }

            a, button {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
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

    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/perfil" class="novo-perfil">Criar Novo Perfil</a>
</div>
</body>
</html>
