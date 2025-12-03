<?php
session_start();
require_once '../CORE/conexao.php';
$conn = Conexao::getConexao();

if ($_SESSION['tipo_usuario'] !== 'ONG') {
    header("Location: confirmar_usuario.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'] ?: null;
    $porte = $_POST['porte'];
    $raca = $_POST['raca'];
    $descricao = $_POST['descricao'];
    $status_adocao = $_POST['status_adocao'];
    $cidade = $_POST['cidade'];
    $estado = strtoupper($_POST['estado']);
    $id_ong = $_SESSION['id_usuario'];

    $foto_caminho = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

        $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $tipoArquivo = mime_content_type($_FILES['foto']['tmp_name']);

        if (!in_array($tipoArquivo, $permitidos)) {
            echo "<script>alert('Formato inválido! Envie JPG, PNG ou WEBP.'); window.history.back();</script>";
            exit;
        }

        if ($_FILES['foto']['size'] > 4 * 1024 * 1024) {
            echo "<script>alert('Imagem muito grande! Máximo 4MB.'); window.history.back();</script>";
            exit;
        }

        $pasta = "../uploads/";
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid("img_", true) . "." . strtolower($extensao);
        $caminho_arquivo = $pasta . $nome_arquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_arquivo)) {
            $foto_caminho = "uploads/" . $nome_arquivo;
        }
    }

    $sql = "INSERT INTO ANIMAL
        (nome, especie, sexo, data_nascimento, porte, raca, descricao, status_adocao, cidade, estado, id_ong_abrigo, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss",
        $nome, $especie, $sexo, $data_nascimento, $porte, $raca,
        $descricao, $status_adocao, $cidade, $estado, $id_ong, $foto_caminho
    );

    if ($stmt->execute()) {
        echo "<script>alert('Animal cadastrado com sucesso!'); window.location.href='pets.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar o animal.');</script>";
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Cadastrar Animal — Adote um Amigo</title>
  <link rel="stylesheet" href="css/adicionar_aimal.css">
</head>
<body>
  <h1>Cadastro de Animal</h1>

  <form id="form-animal" enctype="multipart/form-data" method="post">
    <label for="nome">Nome do animal *</label>
    <input type="text" id="nome" name="nome" maxlength="50" required>

    <label for="especie">Espécie *</label>
    <select id="especie" name="especie" required>
      <option value="">Selecione...</option>
      <option value="Cachorro">Cachorro</option>
    </select>

    <label for="sexo">Sexo *</label>
    <select id="sexo" name="sexo" required>
      <option value="">Selecione...</option>
      <option value="Macho">Macho</option>
      <option value="Fêmea">Fêmea</option>
    </select>

    <label for="data_nascimento">Data de nascimento</label>
    <input type="date" id="data_nascimento" name="data_nascimento">

    <label for="porte">Porte *</label>
    <select id="porte" name="porte" required>
      <option value="">Selecione...</option>
      <option value="Pequeno">Pequeno</option>
      <option value="Médio">Médio</option>
      <option value="Grande">Grande</option>
    </select>

    <label for="raca">Raça</label>
    <input type="text" id="raca" name="raca" maxlength="50">

    <label for="descricao">Descrição</label>
    <textarea id="descricao" name="descricao" placeholder="Fale um pouco sobre o animal..."></textarea>

    <label for="status_adocao">Status de adoção *</label>
    <select id="status_adocao" name="status_adocao" required>
      <option value="Disponível" selected>Disponível</option>
    
    </select>

    <label for="cidade">Cidade *</label>
    <input type="text" id="cidade" name="cidade" maxlength="50" required>

    <label for="estado">Estado (UF) *</label>
    <input type="text" id="estado" name="estado" maxlength="2" required style="text-transform:uppercase">

    <label for="foto">Foto do animal</label>
    <input type="file" id="foto" name="foto" accept="image/*">

    <button type="submit" class="btn">Cadastrar</button>
  </form>
</body>
</html>