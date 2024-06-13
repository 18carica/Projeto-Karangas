<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

$marca = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_term = trim($_POST['search_term']);
    if (!empty($search_term)) {
        $sql = "SELECT * FROM MARCAS_VEICULOS WHERE IdMarca = ? OR Marca LIKE ?";
        $stmt = $conexao->prepare($sql);
        $like_term = "%" . $search_term . "%";
        $stmt->bind_param("is", $search_term, $like_term);
        $stmt->execute();
        $result = $stmt->get_result();
        $marca = $result->fetch_assoc();
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $IdMarca = $_POST['IdMarca'];
    $Marca = $_POST['Marca'];

    $sql = "UPDATE MARCAS_VEICULOS SET Marca = ? WHERE IdMarca = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $Marca, $IdMarca);
    if ($stmt->execute()) {
        $mensagem = "Marca de veículo atualizada com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar a marca de veículo: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Marcas de Veículos</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php" class="active">Home</a>
  <a href="modificar-cadastros-funcionarios.php">Funcionarios</a>
  <a href="modificar-cadastros-clientes.php">Clientes</a>
  <a href="modificar-cadastros-tipos.php">Tipos</a>
  <a href="modificar-cadastros-veiculos.php">Veiculos</a>
  <a href="modificar-cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Modificar Marcas de Veículos</h2>
  <form action="modificar-cadastros-marcas.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="search_term" class="form-label">Pesquisar por ID ou Nome</label>
      <input type="text" class="form-control" id="search_term" name="search_term" required>
    </div>
    <button type="submit" name="search" class="btn btn-primary">Pesquisar</button>
  </form>

  <?php if ($marca): ?>
  <form action="modificar-cadastros-marcas.php" method="post" class="mt-4">
    <input type="hidden" name="IdMarca" value="<?php echo $marca['IdMarca']; ?>">
    <div class="mb-3">
      <label for="Marca" class="form-label">Marca</label>
      <input type="text" class="form-control" id="Marca" name="Marca" value="<?php echo $marca['Marca']; ?>" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
  </form>
  <?php endif; ?>

  <?php if (isset($mensagem)): ?>
  <div class="alert alert-info mt-3">
    <?php echo $mensagem; ?>
  </div>
  <?php endif; ?>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php $conexao->close(); ?>
