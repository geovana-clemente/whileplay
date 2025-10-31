<?php
require_once __DIR__ . '/../models/Publicar.php';

$publicar = new Publicar();

// Handle POST create/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $id = !empty($post['id']) ? (int)$post['id'] : null;

    $dados = [
        'usuario_id' => $post['usuario_id'] ?? null,
        'titulo' => $post['titulo'] ?? null,
        'sinopse' => $post['sinopse'] ?? null,
        'tipo' => $post['tipo'] ?? null,
        'arquivo_url' => $post['arquivo_url'] ?? null,
        'publicado' => isset($post['publicado']) ? (int)$post['publicado'] : 1,
        'status' => $post['status'] ?? 'rascunho'
    ];

  try {
    if ($id) {
      $publicar->atualizar($id, $dados);
    } else {
      $publicar->criar($dados);
    }
  } catch (Exception $e) {
    echo '<p style="color:red">Erro ao salvar publicação: ' . htmlspecialchars($e->getMessage()) . '</p>';
    exit;
  }

  $base = rtrim(dirname($_SERVER['REQUEST_URI']), '/\\');
  $redirect = $base . '/publicar_list.php';
  header('Location: ' . $redirect);
  exit;
}
 
// If editing, load item
$editing = false;
$item = null;
if (isset($_GET['id'])) {
    $editing = true;
    $item = $publicar->buscarPorId((int)$_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f5f6fa; margin:0; padding:0; }
    main { max-width:800px; margin:2rem auto; background:#fff; padding:2rem; border-radius:8px; }
    input, textarea, select { width:100%; padding:0.6rem; margin-bottom:0.8rem; }
    button { background:#0097e6; color:#fff; padding:0.7rem 1rem; border:none; border-radius:4px; }
    a { color:#0097e6; }
  </style>
</head>
<body>
  <main>
    <h1><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></h1>
  <form method="post" action="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/save-publicar">
      <input type="hidden" name="id" value="<?php echo $editing ? (int)$item['id'] : ''; ?>" />
      <input type="number" name="usuario_id" placeholder="ID do Usuário" required value="<?php echo $editing ? htmlspecialchars($item['usuario_id']) : ''; ?>" />
      <input type="text" name="titulo" placeholder="Título" required value="<?php echo $editing ? htmlspecialchars($item['titulo']) : ''; ?>" />
      <textarea name="sinopse" placeholder="Sinopse"><?php echo $editing ? htmlspecialchars($item['sinopse']) : ''; ?></textarea>
      <select name="tipo">
        <option value="roteiro" <?php echo ($editing && ($item['tipo'] ?? '') === 'roteiro') ? 'selected' : ''; ?>>Roteiro</option>
        <option value="personagem" <?php echo ($editing && ($item['tipo'] ?? '') === 'personagem') ? 'selected' : ''; ?>>Personagem</option>
      </select>
      <input type="text" name="arquivo_url" placeholder="URL do arquivo (opcional)" value="<?php echo $editing ? htmlspecialchars($item['arquivo_url'] ?? '') : ''; ?>" />
      <select name="status">
        <option value="rascunho" <?php echo ($editing && ($item['status'] ?? '') === 'rascunho') ? 'selected' : ''; ?>>Rascunho</option>
        <option value="publicado" <?php echo ($editing && ($item['status'] ?? '') === 'publicado') ? 'selected' : ''; ?>>Publicado</option>
        <option value="rejeitado" <?php echo ($editing && ($item['status'] ?? '') === 'rejeitado') ? 'selected' : ''; ?>>Rejeitado</option>
      </select>
      <input type="hidden" name="publicado" value="1" />
      <button type="submit"><?php echo $editing ? 'Atualizar' : 'Salvar'; ?></button>
    </form>
  <p><a href="/GitHub/whileplay/while-play/projeto_whileplay/back-end/public/list-publicar">⬅️ Voltar para a lista</a></p>
  </main>
</body>
</html>