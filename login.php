<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Doce Lar</title>
  <link rel="stylesheet" href="login_cadastro.css">
</head>
<body>
  <div class="auth-container">
    <h1 class="logo">🐾 Doce Lar</h1>
    <div class="form-card">
      <h2>Entrar</h2>
      <form method="post" action="../MODEL/processa_login.php">

        <label for="loginUsuario">E-mail</label>
        <input type="email" id="loginUsuario" name="loginUsuario" placeholder="Digite seu e-mail" required>

        <label for="loginSenha">Senha</label>
        <input type="password" id="loginSenha" name="loginSenha" placeholder="Digite sua senha" required>

        <button type="submit" class="btn">Entrar</button>
      </form>

      <p class="link-text">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
  </div>
</body>
</html>
