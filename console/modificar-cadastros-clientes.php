<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

$cliente = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_term = trim($_POST['search_term']);
    if (!empty($search_term)) {
        $sql = "SELECT * FROM CLIENTES WHERE IdCli = ? OR Nome LIKE ?";
        $stmt = $conexao->prepare($sql);
        $like_term = "%" . $search_term . "%";
        $stmt->bind_param("is", $search_term, $like_term);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Cliente</title>
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
  <a href="modificar-cadastros-tipos.php">Tipos</a>
  <a href="modificar-cadastros-marcas.php">Marcas</a>
  <a href="modificar-cadastros-veiculos.php">Veiculos</a>
  <a href="modificar-cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Modificar Cliente</h2>
  <p>Pesquise pelo ID ou nome do cliente para modificar suas informações.</p>

  <!-- Formulário de Pesquisa de Cliente -->
  <form action="modificar-cadastros-clientes.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="search_term" class="form-label">ID ou Nome do Cliente</label><br>
      <input type="text" class="form-control" id="search_term" name="search_term" required>
    </div>
    <button type="submit" name="search" class="btn btn-primary">Pesquisar</button>
  </form>

  <!-- Formulário de Modificação de Cliente -->
  <?php if ($cliente): ?>
  <form action="modificar-clientes-exec.php" method="post" class="mt-4">
    <input type="hidden" name="IdCli" value="<?php echo htmlspecialchars($cliente['IdCli']); ?>">
    <div class="mb-3">
      <label for="Tipo_Cliente" class="form-label">Tipo de Cliente</label><br>
      <input type="text" class="form-control" id="Tipo_Cliente" name="Tipo_Cliente" value="<?php echo htmlspecialchars($cliente['Tipo_Cliente']); ?>">
    </div>
    <div class="mb-3">
      <label for="Documento" class="form-label">Documento</label><br>
      <input type="text" class="form-control" id="Documento" name="Documento" value="<?php echo htmlspecialchars($cliente['Documento']); ?>">
    </div>
    <div class="mb-3">
      <label for="Nome" class="form-label">Nome</label><br>
      <input type="text" class="form-control" id="Nome" name="Nome" value="<?php echo htmlspecialchars($cliente['Nome']); ?>" required>
    </div>
    <div class="mb-3">
      <label for="Email" class="form-label">Email</label><br>
      <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($cliente['Email']); ?>">
    </div>
    <div class="mb-3">
      <label for="Telefone" class="form-label">Telefone</label><br>
      <input type="text" class="form-control" id="Telefone" name="Telefone" value="<?php echo htmlspecialchars($cliente['Telefone']); ?>">
    </div>
    <div class="mb-3">
      <label for="Endereco" class="form-label">Endereço</label><br>
      <input type="text" class="form-control" id="Endereco" name="Endereco" value="<?php echo htmlspecialchars($cliente['Endereco']); ?>">
    </div>
    <div class="mb-3">
      <label for="Complemento" class="form-label">Complemento</label><br>
      <input type="text" class="form-control" id="Complemento" name="Complemento" value="<?php echo htmlspecialchars($cliente['Complemento']); ?>">
    </div>
    <div class="mb-3">
      <label for="Bairro" class="form-label">Bairro</label><br>
      <input type="text" class="form-control" id="Bairro" name="Bairro" value="<?php echo htmlspecialchars($cliente['Bairro']); ?>">
    </div>
    <div class="mb-3">
      <label for="Obs" class="form-label">Observações</label><br>
      <textarea class="form-control" id="Obs" name="Obs"><?php echo htmlspecialchars($cliente['Obs']); ?></textarea>
    </div>
    <div class="mb-3">
      <label for="Situacao" class="form-label">Situação</label><br>
      <input type="text" class="form-control" id="Situacao" name="Situacao" value="<?php echo htmlspecialchars($cliente['Situacao']); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Modificar Cliente</button>
  </form>
  <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])): ?>
  <div class="alert alert-danger mt-3">
    Cliente não encontrado.
  </div>
  <?php endif; ?>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php $conexao->close(); ?>
