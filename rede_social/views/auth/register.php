<!doctype html>
<html>
<head><meta charset="utf-8"><title>Cadastro</title></head>
<body>
<h2>Cadastro</h2>
<?php if (!empty($result['errors'])): foreach($result['errors'] as $err): ?>
  <div style="color:red"><?=htmlspecialchars($err)?></div>
<?php endforeach; endif; ?>

<form method="post" enctype="multipart/form-data" action="cadastro.php">
  <label>Nome completo: <input name="nome_completo" value="<?=htmlspecialchars($result['old']['nome_completo'] ?? '')?>" required></label><br>
  <label>Username: <input name="username" value="<?=htmlspecialchars($result['old']['username'] ?? '')?>" required></label><br>
  <label>Email: <input type="email" name="email" value="<?=htmlspecialchars($result['old']['email'] ?? '')?>" required></label><br>
  <label>Senha: <input type="password" name="senha" required></label><br>
  <label>Confirmação: <input type="password" name="senha_conf" required></label><br>
  <label>Data nascimento: <input type="date" name="data_nascimento" value="<?=htmlspecialchars($result['old']['data_nascimento'] ?? '')?>" required></label><br>
  <label>Gênero:
    <select name="genero" required>
      <option value="">--</option>
      <option <?= (isset($result['old']['genero']) && $result['old']['genero']=='Feminino')?'selected':''?>>Feminino</option>
      <option <?= (isset($result['old']['genero']) && $result['old']['genero']=='Masculino')?'selected':''?>>Masculino</option>
      <option <?= (isset($result['old']['genero']) && $result['old']['genero']=='Outro')?'selected':''?>>Outro</option>
    </select>
  </label><br>
  <label>Imagem de perfil (opcional): <input type="file" name="imagem" accept="image/*"></label><br>
  <button type="submit">Cadastrar</button>
</form>
<a href="index.php">Voltar ao login</a>
</body>
</html>
