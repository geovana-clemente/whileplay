<?php
require_once __DIR__ . '/../models/Publicar.php';

$publicar = new Publicar();
$dados = $publicar->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Publicações</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
        }

        header {
            background: #2f3640;
            color: #f5f6fa;
            padding: 1rem;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h2, h1 {
            margin-bottom: 1rem;
        }

        .card {
            background: #f1f2f6;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .actions {
            margin-top: 1rem;
        }

        .actions button {
            background: #44bd32;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            margin-right: 8px;
        }

        .actions button.delete {
            background: #e84118;
        }

        button.add {
            background: #0097e6;
            color: white;
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            margin-bottom: 1rem;
        }

        button.add:hover {
            background: #0984e3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lista de Publicações</h1>
    </header>

    <main>
    <a class="add" href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar">➕ Nova Publicação</a>
        <section id="listaPublicacoes">
            <?php if (empty($dados)): ?>
                <p>Nenhuma publicação encontrada.</p>
            <?php else: ?>
                <?php foreach ($dados as $pub): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($pub['titulo'] ?? '(Sem título)'); ?></h3>
                        <p><b>ID:</b> <?php echo (int)($pub['id'] ?? 0); ?> <b>Tipo:</b> <?php echo htmlspecialchars($pub['tipo'] ?? ''); ?></p>
                        <p><b>Status:</b> <?php echo htmlspecialchars($pub['status'] ?? ''); ?></p>
                        <p><b>Usuário:</b> <?php echo htmlspecialchars($pub['usuario_id'] ?? ''); ?></p>
                        <?php if (!empty($pub['arquivo_url'])): ?>
                            <?php
                                $arquivoVal = $pub['arquivo_url'];
                                $isAbsolute = preg_match('~^(https?:)?//~i', $arquivoVal) || strpos($arquivoVal, '/') === 0;
                                $imgSrc = $isAbsolute ? $arquivoVal : '/GitHub/whileplay/while-play/projeto_whileplay/front-end/public/MEDIA/imagens/' . $arquivoVal;
                            ?>
                            <p><img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="imagem" style="max-width:200px; display:block; margin-bottom:8px;" /></p>
                        <?php endif; ?>
                        <p><?php echo nl2br(htmlspecialchars($pub['sinopse'] ?? '(Sem sinopse)')); ?></p>
                        <div class="actions">
                            <a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/publicar?id=<?php echo (int)$pub['id']; ?>">Editar</a>
                            <form method="post" action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/delete-publicar" style="display:inline" onsubmit="return confirm('Deseja realmente excluir esta publicação?')">
                                <input type="hidden" name="id" value="<?php echo (int)$pub['id']; ?>" />
                                <button type="submit" class="delete">Excluir</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>