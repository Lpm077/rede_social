<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
<h2>Login</h2>
<?php if (!empty($_GET['registered'])): ?>
  <div style="color:green">Cadastro realizado com sucesso. Faça login.</div>
<?php endif; ?>
<?php if (!empty($errors)): foreach($errors as $e): ?>
  <div style="color:red"><?=htmlspecialchars($e)?></div>
<?php endforeach; endif; ?>
<form method="post" action="index.php">
  <label>Email: <input type="email" name="email" required value="<?=htmlspecialchars($_POST['email'] ?? '')?>"></label><br>
  <label>Senha: <input type="password" name="senha" required></label><br>
  <button type="submit">Entrar</button>
</form>
<a href="cadastro.php">Criar conta</a>
</body>
</html>
