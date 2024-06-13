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
  <!-- Bootstrap CSS conflitando
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  -->
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php" class="active">Home</a>
  <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Cadastros
    <i class="fa fa-caret-down"></i>
  </button>

  <div class="dropdown-content" id="myDropdown">
    <a href="cadastros.php">NOVO</a>
    <br>
    <a href="modificar.php">MODIFICAR</a>
  </div>
  </div>
  <a href="anuncios.php">Anuncios</a>  
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Conteúdo da Página</h2>
  <?php
    // Verifica se $_SESSION["msg"] não é nulo e imprime a mensagem
    if(isset($_SESSION["msg"]) && $_SESSION["msg"] !== null) 
     {
        echo $_SESSION["msg"];
        // Limpa a mensagem para evitar que seja exibida novamente
        $_SESSION["msg"] = null;
     }
  ?>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod dolor nec magna bibendum, nec rutrum justo condimentum. Vivamus non libero at nisl fermentum varius. Phasellus sed interdum lacus. Nulla facilisi. Suspendisse potenti. Fusce id eros enim.</p>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/dropdown.js"></script>

</body>
</html>
<?php mysqli_close($conexao); ?>
