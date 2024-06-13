<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdVeic = $_POST['IdVeic'];
    $Vidro_eletrico = isset($_POST['Vidro_eletrico']) ? '1' : '0';
    $Ar_Condicionado = isset($_POST['Ar_Condicionado']) ? '1' : '0';
    $Bancos = isset($_POST['Bancos']) ? '1' : '0';

    $sql = "INSERT INTO VEICULOS_ACESSORIO (IdVeic, Vidro_eletrico, Ar_Condicionado, Bancos) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("isss", $IdVeic, $Vidro_eletrico, $Ar_Condicionado, $Bancos);

    if ($stmt->execute()) {
        $mensagem = "Acessórios cadastrados com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar os acessórios: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Acessórios</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php" class="active">Home</a>
  <a href="cadastros-funcionarios.php">Funcionários</a>
  <a href="cadastros-clientes.php">Clientes</a>
  <a href="cadastros-tipos.php">Tipos</a>
  <a href="cadastros-marcas.php">Marcas</a>
  <a href="cadastros-veiculos.php">Veículos</a>
  <a href="cadastros-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a>
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Cadastro de Acessórios de Veículos</h2>
  <form action="cadastro-acessorios.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="IdVeic" class="form-label">ID do Veículo</label>
      <input type="number" class="form-control" id="IdVeic" name="IdVeic" required>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Vidro_eletrico" name="Vidro_eletrico">
      <label class="form-check-label" for="Vidro_eletrico">Vidro Elétrico</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Ar_Condicionado" name="Ar_Condicionado">
      <label class="form-check-label" for="Ar_Condicionado">Ar Condicionado</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="Bancos" name="Bancos">
      <label class="form-check-label" for="Bancos">Bancos de Couro</label>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Cadastrar Acessórios</button>
  </form>

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
