<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

$acessorio = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_term = trim($_POST['search_term']);
    if (!empty($search_term)) {
        $sql = "SELECT * FROM VEICULOS_ACESSORIO WHERE Idvc = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $search_term);
        $stmt->execute();
        $result = $stmt->get_result();
        $acessorio = $result->fetch_assoc();
        $stmt->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $Idvc = $_POST['Idvc'];
    $Vidro_eletrico = isset($_POST['Vidro_eletrico']) ? '1' : '0';
    $Ar_Condicionado = isset($_POST['Ar_Condicionado']) ? '1' : '0';
    $Bancos = isset($_POST['Bancos']) ? '1' : '0';

    $sql = "UPDATE VEICULOS_ACESSORIO SET Vidro_eletrico = ?, Ar_Condicionado = ?, Bancos = ? WHERE Idvc = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $Vidro_eletrico, $Ar_Condicionado, $Bancos, $Idvc);

    if ($stmt->execute()) {
        $mensagem = "Acessórios atualizados com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar os acessórios: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Acessórios</title>
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
  <a href="modificar-cadastros-marcas.php">Marcas</a>
  <a href="modificar-cadastros-veiculos.php">Veiculos</a>  
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Modificar Acessórios de Veículos</h2>
  <form action="modificar-cadastro-acessorios.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="search_term" class="form-label">Pesquisar por ID</label>
      <input type="number" class="form-control" id="search_term" name="search_term" required>
    </div>
    <button type="submit" name="search" class="btn btn-primary">Pesquisar</button>
  </form>

  <?php if ($acessorio): ?>
  <form action="modificar-cadastro-acessorios.php" method="post" class="mt-4">
    <input type="hidden" name="Idvc" value="<?php echo $acessorio['Idvc']; ?>">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Vidro_eletrico" name="Vidro_eletrico" <?php if ($acessorio['Vidro_eletrico'] == '1') echo 'checked'; ?>>
      <label class="form-check-label" for="Vidro_eletrico">Vidro Elétrico</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Ar_Condicionado" name="Ar_Condicionado" <?php if ($acessorio['Ar_Condicionado'] == '1') echo 'checked'; ?>>
      <label class="form-check-label" for="Ar_Condicionado">Ar Condicionado</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Bancos" name="Bancos" <?php if ($acessorio['Bancos'] == '1') echo 'checked'; ?>>
      <label class="form-check-label" for="Bancos">Bancos de Couro</label>
    </div>
    <button type="submit" name="update" class="btn btn-primary mt-3">Atualizar Acessórios</button>
  </form>
  <?php endif; ?>

  <!-- Mensagem de Feedback -->
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
