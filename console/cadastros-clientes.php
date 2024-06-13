<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "exec/cadastros-clientes-exec.php";
include "fn/validar_sessao.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Karangas Dashboard - Cadastro de Clientes</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php">Home</a>
  <a href="cadastros-funcionarios.php">Funcionários</a>
  <a href="cadastros-tipos.php">Tipos</a>
  <a href="cadastros-marcas.php">Marcas</a>
  <a href="cadastros-veiculos.php">Veículos</a>
  <a href="cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>CADASTRO DE CLIENTES</h2>

  <!-- Formulário de Cadastro de Cliente -->
  <form action="cadastros-clientes.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="Tipo_Cliente" class="form-label">Tipo de Cliente</label><br>
      <select class="form-control" id="Tipo_Cliente" name="Tipo_Cliente">
        <option value="">Selecione o Tipo de Cliente</option>
        <option value="PF">Pessoa Física</option>
        <option value="PJ">Pessoa Jurídica</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="Documento" class="form-label">Documento</label><br>
      <input type="text" class="form-control" id="Documento" name="Documento" required>
    </div>
    <div class="mb-3">
      <label for="Nome" class="form-label">Nome</label><br>
      <input type="text" class="form-control" id="Nome" name="Nome" required>
    </div>
    <div class="mb-3">
      <label for="Email" class="form-label">Email</label><br>
      <input type="email" class="form-control" id="Email" name="Email" required>
    </div>
    <div class="mb-3">
      <label for="Telefone" class="form-label">Telefone</label><br>
      <input type="text" class="form-control" id="Telefone" name="Telefone">
    </div>
    <div class="mb-3">
      <label for="Endereco" class="form-label">Endereço</label><br>
      <input type="text" class="form-control" id="Endereco" name="Endereco">
    </div>
    <div class="mb-3">
      <label for="Complemento" class="form-label">Complemento</label><br>
      <input type="text" class="form-control" id="Complemento" name="Complemento">
    </div>
    <div class="mb-3">
      <label for="Bairro" class="form-label">Bairro</label><br>
      <input type="text" class="form-control" id="Bairro" name="Bairro">
    </div>
    <div class="mb-3">
      <label for="Obs" class="form-label">Observações</label><br>
      <textarea class="form-control" id="Obs" name="Obs" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>

  <!-- Exibição de Mensagens -->
  <?php if (isset($mensagem)): ?>
    <div class="alert alert-info mt-3" role="alert">
      <?php echo $mensagem; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Scripts Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
