<?php
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

if (!isset($_GET['id'])) {
    echo "Animal não encontrado.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM ANIMAL WHERE id_animal = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Animal não encontrado.";
    exit;
}

$animal = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($animal['nome']); ?> — Detalhes</title>
  <link rel="stylesheet" href="detalhes.css">
</head>
<body>
  <div class="animal-detalhes">
    <?php
   $foto = !empty($row['foto']) ? "../" . htmlspecialchars($row['foto']) : "sem_foto.png";

    ?>
    <img src="<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($animal['nome']); ?>">

    <h1><?php echo htmlspecialchars($animal['nome']); ?></h1>
    <p><strong>Espécie:</strong> <?php echo htmlspecialchars($animal['especie']); ?></p>
    <p><strong>Sexo:</strong> <?php echo htmlspecialchars($animal['sexo']); ?></p>
    <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal['porte']); ?></p>
    <p><strong>Raça:</strong> <?php echo htmlspecialchars($animal['raca']); ?></p>
    <p><strong>Cidade:</strong> <?php echo htmlspecialchars($animal['cidade']); ?> - <?php echo htmlspecialchars($animal['estado']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($animal['status_adocao']); ?></p>
    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($animal['descricao'])); ?></p>

    <button onclick="window.location.href='pets.php'">Voltar</button>
  </div>
</body>
</html>
