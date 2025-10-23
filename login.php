<?php
//oi jota//
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Cadastro</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">

        <!-- Área de Login -->
        <div id="login">
            <h2>Login</h2>
            <form id="loginForm" method="post" action="">
                <label for="loginUsuario">Usuário:</label>
                <input type="text" id="loginUsuario" name="loginUsuario" required>

                <label for="loginSenha">Senha:</label>
                <input type="password" id="loginSenha" name="loginSenha" required>

                <button type="submit">Entrar</button>
            </form>
            <p>Ainda não tem uma conta? <a href="#" id="switchToSignup">Cadastre-se aqui</a></p>
        </div>

        <!-- Área de Cadastro -->
        <div id="signup" style="display: none;">
            <h2>Cadastro</h2>
            <form id="signupForm" method="post" action="">
                
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        
             <br><br>
             <select name="estado"> 
            <option value="estado">Selecione o Estado</option> 
            <option value="ac">Acre</option> 
            <option value="al">Alagoas</option> 
            <option value="am">Amazonas</option> 
            <option value="ap">Amapá</option> 
            <option value="ba">Bahia</option> 
            <option value="ce">Ceará</option> 
            <option value="df">Distrito Federal</option> 
            <option value="es">Espírito Santo</option> 
            <option value="go">Goiás</option> 
            <option value="ma">Maranhão</option> 
            <option value="mt">Mato Grosso</option> 
            <option value="ms">Mato Grosso do Sul</option> 
            <option value="mg">Minas Gerais</option> 
            <option value="pa">Pará</option> 
            <option value="pb">Paraíba</option> 
            <option value="pr">Paraná</option> 
            <option value="pe">Pernambuco</option> 
            <option value="pi">Piauí</option> 
            <option value="rj">Rio de Janeiro</option> 
            <option value="rn">Rio Grande do Norte</option> 
            <option value="ro">Rondônia</option> 
            <option value="rs">Rio Grande do Sul</option> 
            <option value="rr">Roraima</option> 
            <option value="sc">Santa Catarina</option> 
            <option value="se">Sergipe</option> 
            <option value="sp">São Paulo</option> 
            <option value="to">Tocantins</option> 
    </select>
<br>
           <!-- <select name="cidades"> 
            <option class="ma" value="cidade1">Cidade 1</option> -->


                 <label for="endereco">Cidade:</label>
                <input type="text" id="endereco" name="Cidade" required>

                

                <label for="telefone">Número de telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <label for="confirmarSenha">Confirmar senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha" required>

                <button type="submit">Cadastrar</button>
            </form>
            <p>Já tem uma conta? <a href="#" id="switchToLogin">Entre aqui</a></p>
        </div>

    </div>

    <script src="login.js"></script>
</body>

</html>
