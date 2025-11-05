<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Roteiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        /* Correção: garantir que o SELECT esteja acima de outros elementos e possa ser clicado */
        select {
            background: #fff;
            position: relative;
            z-index: 9999; /* fica acima de outros elementos */
            -webkit-appearance: menulist-button;
            appearance: menulist-button;
        }

        /* manter file input atrás do select caso haja sobreposição */
        input[type="file"] {
            position: relative;
            z-index: 1;
        }

        /* garantir que o botão de submit não sobreponha o select dropdown */
        input[type="submit"] {
            position: relative;
            z-index: 1;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Criar Novo Roteiro</h1>

    <?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=while_play;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $assinaturas = $pdo->query("
            SELECT a.id, a.usuario_id, a.cidade, a.cep, p.nome_completo 
            FROM assinaturas a
            INNER JOIN perfil p ON a.usuario_id = p.id 
            WHERE a.status = 'ativa'
        ")->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p style='color: red; text-align: center;'>Erro ao carregar assinaturas: " . $e->getMessage() . "</p>";
        $assinaturas = [];
    }
    ?>

    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-roteiro" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria" required>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required>

        <label for="visualizacoes">Visualizações:</label>
        <input type="number" id="visualizacoes" name="visualizacoes" value="0" min="0">
        </select>

        <input type="submit" value="Salvar Roteiro">
    </form>

    <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/list-roteiros">Ver todos os roteiros</a>

    <script>
    // Evita que outros ouvintes de clique no documento interfiram ao abrir o select
    document.addEventListener('DOMContentLoaded', function(){
        var sel = document.getElementById('assinatura_id');
        if (!sel) return;
        // Evita propagação de eventos que possam fechar o dropdown imediatamente
        sel.addEventListener('mousedown', function(e){ e.stopPropagation(); }, true);
        sel.addEventListener('click', function(e){ e.stopPropagation(); });
    });
    </script>

</body>
</html>
