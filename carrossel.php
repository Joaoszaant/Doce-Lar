<?php
include 'barra.php';
$imagens = [
    "imagens/cachorro1.jpeg",
    "imagens/cachorro2.jpeg",
    "imagens/cachorro3.jpeg",
    "imagens/cachorro4.jpeg",
    "imagens/cachorro5.jpeg"
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel de Pets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="carrossel-container">
    <button class="seta esquerda" onclick="voltar()">❮</button>

    <div class="carrossel">
        <?php foreach ($imagens as $img): ?>
            <div class="item">
                <img src="<?= $img ?>" alt="Pet">
            </div>
        <?php endforeach; ?>
    </div>

    <button class="seta direita" onclick="avancar()">❯</button>
</div>

<script src="carrossel.js"></script>
</body>
</html>