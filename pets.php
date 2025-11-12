<?php
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

// Busca animais no BD
$sql = "SELECT id_animal, nome, sexo, data_nascimento, cidade, estado, foto FROM ANIMAL ORDER BY data_cadastro DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Animais Disponíveis</title>
  <link rel="stylesheet" href="pets.css">
</head>
<body>
  <h1>Animais Disponíveis para Adoção</h1>

  <?php if (isset($_GET['sucesso'])): ?>
    <p style="color:green;">Animal cadastrado com sucesso!</p>
  <?php endif; ?>

  <div class="animal-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="animal-card">
        <?php
      
        $foto = !empty($row['foto']) ? "../" . htmlspecialchars($row['foto']) : "sem_foto.png";


        ?>
        <img src="<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>">
        
        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
        <p>
          <?php echo htmlspecialchars($row['sexo']); ?> | 
          <?php
            if (!empty($row['data_nascimento'])) {
                $birth = new DateTime($row['data_nascimento']);
                $today = new DateTime();
                $age = $today->diff($birth)->y;
                echo $age . ' anos';
            } else {
                echo 'Idade não informada';
            }
          ?>
          | <?php echo htmlspecialchars($row['cidade']) . ' - ' . htmlspecialchars($row['estado']); ?>
        </p>

        <a href="detalhes.php?id=<?php echo $row['id_animal']; ?>" class="btn">Quero Adotar</a>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
