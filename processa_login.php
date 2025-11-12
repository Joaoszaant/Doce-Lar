<?php
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsuario'])) {
    $email = $_POST['loginUsuario'];
    $senha = $_POST['loginSenha'];

    $sql = "SELECT * FROM USUARIO WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        if (password_verify($senha, $row['senha_hash'])) {
            // **PADRÃO DE SESSÃO UNIFICADO**
            $_SESSION['id_usuario']   = $row['id_usuario'];
            $_SESSION['nome']         = $row['nome'];
            $_SESSION['email']        = $row['email'];
            $_SESSION['telefone']     = $row['telefone'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

            // Redireciona para a home (ajuste o caminho se necessário)
            header("Location: ../VIEW/home.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='../VIEW/login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='../VIEW/login.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
