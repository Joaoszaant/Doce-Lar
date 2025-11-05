<?php
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $usuario = $_POST['email']; // email é o "usuario"
    $nome = $_POST['nome'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmar = $_POST['confirmarSenha'];

    if ($senha !== $confirmar) {
        echo "<script>alert('As senhas não coincidem!'); window.location.href='login.php';</script>";
        exit;
    } else {
        $senhaCript = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (usuario, nome, estado, cidade, telefone, senha) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $usuario, $nome, $estado, $cidade, $telefone, $senhaCript);

        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso! Faça login para continuar.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: ".$stmt->error."'); window.location.href='login.php';</script>";
        }

        $stmt->close();
    }
}
$conn->close();
?>
