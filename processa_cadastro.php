<?php
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade']; 
    $telefone = $_POST['telefone'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmarSenha'];


    if ($senha !== $confirmar) {
        echo "<script>alert('As senhas não coincidem!'); window.location.href='../VIEW/login.php';</script>";
        exit;
    }

    $senhaCript = password_hash($senha, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO USUARIO (nome, email, senha_hash, telefone, cidade, estado, tipo_usuario) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $email, $senhaCript, $telefone, $cidade, $estado, $tipo_usuario);

    // Executa e trata o resultado
    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso! Faça login para continuar.'); window.location.href='../VIEW/login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.location.href='../VIEW/cadastro.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
