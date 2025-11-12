<?php
session_start();
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

if (!isset($_SESSION['id_usuario'])) {
    // manda pro login se  a pessoa não tiver logada
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resposta = $_POST['resposta'];
    $id_usuario = $_SESSION['id_usuario'];

    if ($resposta === "sim") {
     // verifica se eh ong
      $sql = "SELECT tipo_usuario FROM USUARIO WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $user['tipo_usuario'] === 'ONG') {
            header("Location: adicionar_animal.php");
            exit;
        } else {
            echo "<script>
                    alert('Você não está cadastrado como ONG. Apenas ONGs podem adicionar animais.');
                    window.location.href = 'home.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Apenas ONGs podem adicionar animais.');
                window.location.href = 'home.php';
              </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Confirmação de Usuário</title>
  <link rel="stylesheet" href="seu-estilo.css">
  
</head>
<body>
  <div class="confirm-container">
    <h2>Confirmação</h2>
    <p>Você está cadastrado como ONG?</p>
    <form method="POST">
      <label>
        <input type="radio" name="resposta" value="sim" required> Sim
      </label>
      <label>
        <input type="radio" name="resposta" value="nao"> Não
      </label>
      <button type="submit">Confirmar Resposta</button>
    </form>
  </div>
</body>
</html>
