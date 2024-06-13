<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php";
include "fn/validar_sessao.php";


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Karangas Dashboard</title>
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
  <a href="modificar-cadastro-acessorios.php">Acessórios</a>  
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>MODIFICAR CADASTROS</h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod dolor nec magna bibendum, nec rutrum justo condimentum. Vivamus non libero at nisl fermentum varius. Phasellus sed interdum lacus. Nulla facilisi. Suspendisse potenti. Fusce id eros enim.</p>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php mysqli_close($conexao); ?>
