<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "exec/cadastros-funcionarios-exec.php";
include "fn/validar_sessao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Funcionários</title>
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
  <a href="cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a>
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Cadastro de Funcionários</h2>
  <p>Preencha as informações abaixo para cadastrar um novo funcionário.</p>

  <!-- Formulário de Cadastro de Funcionário -->
  <form action="cadastros-funcionarios.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="nome_completo" class="form-label">Nome Completo</label><br>
      <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label><br>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
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
