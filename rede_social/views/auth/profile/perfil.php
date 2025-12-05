<!doctype html>
<html>
<head><meta charset="utf-8"><title>Perfil</title></head>
<body>
<h2>Meu perfil</h2>
<a href="feed.php">Voltar ao Feed</a> | <a href="logout.php">Sair</a>
<div>
  <img src="<?=htmlspecialchars($user['imagem_perfil'] ?? 'public/uploads/default.png')?>" alt="avatar" width="100">
  <p><?=htmlspecialchars($user['nome_completo'])?> (<?=htmlspecialchars($user['username'])?>)</p>
  <p>Email: <?=htmlspecialchars($user['email'])?></p>
  <p>Nasceu em: <?=htmlspecialchars($user['data_nascimento'])?></p>
  <p>Gênero: <?=htmlspecialchars($user['genero'])?></p>
</div>

<h3>Editar perfil</h3>
<form method="post" enctype="multipart/form-data">
  <label>Nome completo: <input name="nome_completo" value="<?=htmlspecialchars($user['nome_completo'])?>"></label><br>
  <label>Username: <input name="username" value="<?=htmlspecialchars($user['username'])?>"></label><br>
  <label>Data nascimento: <input name="data_nascimento" type="date" value="<?=htmlspecialchars($user['data_nascimento'])?>"></label><br>
  <label>Gênero:
    <select name="genero">
      <option value="Feminino" <?=($user['genero']=='Feminino')?'selected':''?>>Feminino</option>
      <option value="Masculino" <?=($user['genero']=='Masculino')?'selected':''?>>Masculino</option>
      <option value="Outro" <?=($user['genero']=='Outro')?'selected':''?>>Outro</option>
    </select>
  </label><br>
  <label>Alterar imagem de perfil: <input type="file" name="imagem"></label><br>
  <button type="submit">Salvar</button>
</form>
</body>
</html>
