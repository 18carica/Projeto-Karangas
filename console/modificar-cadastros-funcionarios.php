<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
//include "modificar-funcionarios-exec.php";
include "fn/validar_sessao.php";

$funcionario = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_term = trim($_POST['search_term']);
    if (!empty($search_term)) {
        $sql = "SELECT * FROM funcionarios WHERE idfun = ? OR nome_completo LIKE ?";
        $stmt = $conexao->prepare($sql);
        $like_term = "%" . $search_term . "%";
        $stmt->bind_param("is", $search_term, $like_term);
        $stmt->execute();
        $result = $stmt->get_result();
        $funcionario = $result->fetch_assoc();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Funcionário</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php" class="active">Home</a>
  <a href="modificar-cadastros-clientes.php">Clientes</a>
  <a href="modificar-cadastros-tipos.php">Tipos</a>
  <a href="modificar-cadastros-marcas.php">Marcas</a>
  <a href="modificar-cadastros-veiculos.php">Veiculos</a>
  <a href="modificar-cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Modificar Funcionário</h2>
  <p>Pesquise pelo ID ou nome do funcionário para modificar suas informações.</p>

  <!-- Formulário de Pesquisa de Funcionário -->
  <form action="modificar-cadastros-funcionarios.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="search_term" class="form-label">ID ou Nome do Funcionário</label><br>
      <input type="text" class="form-control" id="search_term" name="search_term" required>
    </div>
    <button type="submit" name="search" class="btn btn-primary">Pesquisar</button>
  </form>

  <!-- Formulário de Modificação de Funcionário -->
  <?php if ($funcionario): ?>
  <form action="modificar-funcionarios-exec.php" method="post" class="mt-4">
    <input type="hidden" name="idfun" value="<?php echo htmlspecialchars($funcionario['idfun']); ?>">
    <div class="mb-3">
      <label for="nome_completo" class="form-label">Nome Completo</label><br>
      <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($funcionario['nome_completo']); ?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label><br>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($funcionario['email']); ?>">
    </div>
    <div class="mb-3">
      <label for="situacao" class="form-label">Situação</label><br>
      <input type="text" class="form-control" id="situacao" name="situacao" value="<?php echo htmlspecialchars($funcionario['situacao']); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Modificar Funcionário</button>
  </form>
  <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])): ?>
  <div class="alert alert-danger mt-3">
    Funcionário não encontrado.
  </div>
  <?php endif; ?>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php $conexao->close(); ?>
