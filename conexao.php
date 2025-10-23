<?php
$servername = "cadastro_db";
$username = "seu_usuario";
$password = "sua_senha";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql = "CREATE DATABASE cadastro_db";