<!doctype html>
<html>
<head><meta charset="utf-8"><title>Feed</title></head>
<body>
<h2>Feed</h2>
<p>Bem-vindo, <?=htmlspecialchars($user['nome_completo'])?> | <a href="perfil.php">Meu perfil</a> | <a href="pesquisa.php">Pesquisar</a> | <a href="logout.php">Sair</a></p>

<form method="post">
  <textarea name="new_post" placeholder="O que está acontecendo?" required></textarea><br>
  <button type="submit">Postar</button>
</form>

<hr>
<?php foreach ($posts as $p): ?>
  <div style="border:1px solid #ccc;padding:8px;margin-bottom:8px">
    <div>
      <strong><?=htmlspecialchars($p['nome_completo'])?> (<?=htmlspecialchars($p['username'])?>)</strong>
      <small><?=htmlspecialchars($p['criado_em'])?></small>
    </div>
    <div><?=nl2br(htmlspecialchars($p['conteudo']))?></div>
    <div>
      <form method="post" style="display:inline">
        <input type="hidden" name="post_id" value="<?= $p['id'] ?>">
        <button type="submit" name="toggle_like"><?= ($p['liked_by_me']) ? 'Descurtir' : 'Curtir' ?></button>
      </form>
      <span><?=intval($p['likes_count'])?> curtidas</span>
    </div>
  </div>
<?php endforeach; ?>

</body>
</html>
