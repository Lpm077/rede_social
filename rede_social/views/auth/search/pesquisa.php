<!doctype html>
<html>
<head><meta charset="utf-8"><title>Pesquisar</title></head>
<body>
<h2>Pesquisar usuários</h2>
<a href="feed.php">Voltar</a>
<form method="get" action="pesquisa.php">
  <input name="q" value="<?=htmlspecialchars($_GET['q'] ?? '')?>" placeholder="Nome ou username">
  <button type="submit">Buscar</button>
</form>

<?php if (!empty($results)): foreach ($results as $r): ?>
  <div style="border:1px solid #ddd;padding:6px;margin:6px 0">
    <img src="<?=htmlspecialchars($r['imagem_perfil'] ?? 'public/uploads/default.png')?>" width="50" alt="avatar">
    <strong><?=htmlspecialchars($r['nome_completo'])?></strong> (@<?=htmlspecialchars($r['username'])?>)
    <form method="post" style="display:inline">
      <input type="hidden" name="following_id" value="<?= $r['id'] ?>">
      <input type="hidden" name="last_q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
      <button type="submit" name="toggle_follow">Seguir / Deixar de seguir</button>
    </form>
  </div>
<?php endforeach; else: if (isset($_GET['q'])): ?>
  <p>Nenhum usuário encontrado.</p>
<?php endif; endif; ?>
</body>
</html>
