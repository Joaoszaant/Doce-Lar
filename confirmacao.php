<?php
session_start();
require_once '../CORE/conexao.php';

$conn = Conexao::getConexao();

$idAnimal = $_SESSION['id_animal'] ?? null;

if (!$idAnimal) {
    die("Animal não informado.");
}

$query = $conn->prepare("
    SELECT 
        u.nome AS ong_nome,
        u.email AS ong_email,
        u.telefone AS ong_telefone
    FROM ANIMAL a
    JOIN USUARIO u ON a.id_ong_abrigo = u.id_usuario
    WHERE a.id_animal = ?
");
$query->bind_param("i", $idAnimal);
$query->execute();
$result = $query->get_result();
$ong = $result->fetch_assoc();

if (!$ong) {
    die("Erro: ONG responsável não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Adoção Pré-Confirmada</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f6f6f7;
    padding: 30px;
    text-align: center;
}
.container {
    background: #fff;
    padding: 25px;
    width: 500px;
    margin: auto;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
h2 {
    color: #5b2e91;
}
p {
    font-size: 16px;
    margin-top: 10px;
}
</style>
</head>
<body>

<div class="container">
    <h2>🎉 Adoção Pré-Confirmada!</h2>
    <p>O animal foi <strong>reservado para você</strong>!</p>
    <p>Entre em contato com a ONG responsável para concluir a adoção:</p>

    <p><strong>ONG:</strong> <?= $ong['ong_nome'] ?></p>
    <p><strong>Email:</strong> <?= $ong['ong_email'] ?></p>
    <p><strong>Telefone:</strong> <?= $ong['ong_telefone'] ?></p>
</div>

</body>
</html>
