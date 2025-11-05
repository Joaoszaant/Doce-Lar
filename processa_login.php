<?php
include '../../MODEL/conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsuario'])) {
    $usuario = $_POST['loginUsuario'];
    $senha = $_POST['loginSenha'];

    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['usuario'] = $row['usuario']; // salva a sessão
            header("Location: ../index.php"); // redireciona para página principal
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
