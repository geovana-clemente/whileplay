<!-- ../views/publicar_form.php -->
<?php include __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Publicação</title>
    <style>
        form {
            width: 90%;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Nova Publicação</h2>

<<<<<<< HEAD
    <form action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/save-publicar" method="POST" enctype="multipart/form-data">
=======
    <form action="/while_play/save-publicar" method="POST" enctype="multipart/form-data">
>>>>>>> 9695a197319bc3fcf7ccf52e0f98dbd6385d44b1
        <label for="usuario_id">ID do Usuário:</label>
        <input type="number" name="usuario_id" id="usuario_id" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="titulo">Título do Projeto:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="sinopse">Sinopse:</label>
        <textarea name="sinopse" id="sinopse" required></textarea>

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="roteiro">Roteiro</option>
            <option value="outro">Outro</option>
        </select>

        <label for="arquivo">Arquivo (PNG ou DOC):</label>
        <input type="file" name="arquivo" id="arquivo" accept=".png,.doc,.docx" required>

        <label for="data_criacao">Data de Criação:</label>
        <input type="date" name="data_criacao" id="data_criacao" value="<?php echo date('Y-m-d'); ?>">

        <label for="publicado">Publicado?</label>
        <select name="publicado" id="publicado">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>

        <button type="submit">Publicar</button>
    </form>

</body>
</html>
