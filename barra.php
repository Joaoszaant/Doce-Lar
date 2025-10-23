<?php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

<link rel="stylesheet" href="style2.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <span class="doce">Doce</span><span class="lar">Lar</span>
        </div>

        <nav class="menu">
            <a href="#">Sobre Nós</a>
            <a href="#">Loja</a>
        </nav>

        <div class="actions">
            <a href="../adotar.php" class="btn-adotar">🐶 Quero Adotar</a>
            <a href="../carrinho.php" class="carrinho">
                <img src="https://cdn-icons-png.flaticon.com/512/833/833314.png" alt="Carrinho" />
            </a>
            <a href="../cadastro/login.php" class="btn-login">Login/Cadastro</a>
        </div>
<?php 
include 'carrossel.php';
?> 
    </header>
</body>
</html>
