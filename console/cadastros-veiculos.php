<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";
include "exec/cadastros-veiculos-exec.php";

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
  <a href="cadastros-funcionarios.php">Funcionários</a>
  <a href="cadastros-clientes.php">Clientes</a>
  <a href="cadastros-tipos.php">Tipos</a>
  <a href="cadastros-marcas.php">Marcas</a>
  <a href="cadastros-veiculos.php">Veículos</a>
  <a href="cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a> <!-- Botão Sair -->
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>CADASTROS DE VEÍCULOS</h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod dolor nec magna bibendum, nec rutrum justo condimentum. Vivamus non libero at nisl fermentum varius. Phasellus sed interdum lacus. Nulla facilisi. Suspendisse potenti. Fusce id eros enim.</p>

  <!-- Formulário de Cadastro de Veículo -->
  <form action="cadastros-veiculos.php" method="post" class="mt-4" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="IdTipo" class="form-label">Tipo</label><br>
      <select class="form-control" id="IdTipo" name="IdTipo">
        <option value="">Selecione o Tipo</option>
        <?php foreach ($tipos as $tipo): ?>
          <option value="<?php echo $tipo['IdTipo']; ?>"><?php echo $tipo['Tipo_Veiculo']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br>
    <div class="mb-3">
      <label for="IdMarca" class="form-label">Marca</label><br>
      <select class="form-control" id="IdMarca" name="IdMarca">
        <option value="">Selecione a Marca</option>
        <?php foreach ($marcas as $marca): ?>
          <option value="<?php echo $marca['IdMarca']; ?>"><?php echo $marca['Marca']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br>
    <div class="mb-3">
      <label for="IdCli" class="form-label">Cliente</label><br>
      <input type="number" class="form-control" id="IdCli" name="IdCli">
    </div>
    <br>
    <div class="mb-3">
      <label for="Modelo" class="form-label">Modelo</label><br>
      <input type="text" class="form-control" id="Modelo" name="Modelo">
    </div>
    <br>
    <div class="mb-3">
      <label for="Ano_Fab" class="form-label">Ano de Fabricação</label><br>
      <input type="number" class="form-control" id="Ano_Fab" name="Ano_Fab" min="1900" max="<?php echo date('Y'); ?>">
    </div>
    <br>
    <div class="mb-3">
      <label for="Ano_Mod" class="form-label">Ano do Modelo</label><br>
      <input type="number" class="form-control" id="Ano_Mod" name="Ano_Mod" min="1900" max="<?php echo date('Y') + 1; ?>">
    </div>
    <br>
    <div class="mb-3">
      <label for="km" class="form-label">Quilometragem</label><br>
      <input type="number" class="form-control" id="km" name="km">
    </div>
    <br>
    <div class="mb-3">
      <label for="Renavan" class="form-label">Renavan</label><br>
      <input type="text" class="form-control" id="Renavan" name="Renavan">
    </div>
    <br>
    <div class="mb-3">
      <label for="Placa" class="form-label">Placa</label><br>
      <input type="text" class="form-control" id="Placa" name="Placa">
    </div>
    <br>
    <div class="mb-3">
      <label for="Cor" class="form-label">Cor</label><br>
      <input type="text" class="form-control" id="Cor" name="Cor">
    </div>
    <br>
    <div class="mb-3">
      <label for="Combustivel" class="form-label">Combustível</label><br>
      <input type="text" class="form-control" id="Combustivel" name="Combustivel">
    </div>
    <br>
    <div class="mb-3">
      <label for="Cambio" class="form-label">Câmbio</label><br>
      <input type="text" class="form-control" id="Cambio" name="Cambio">
    </div>
    <br>
    <div class="mb-3">
      <label for="Categoria" class="form-label">Categoria</label><br>
      <input type="text" class="form-control" id="Categoria" name="Categoria">
    </div>
    <br>
    <div class="mb-3">
      <label for="Portas" class="form-label">Portas</label><br>
      <input type="number" class="form-control" id="Portas" name="Portas">
    </div>
    <br>
    <div class="mb-3">
      <label for="ValorIn" class="form-label">Valor de Entrada</label><br>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" step="0.01" class="form-control" id="ValorIn" name="ValorIn" placeholder="0,00">
      </div>
    </div>
    <br>
    <div class="mb-3">
      <label for="ValorOut" class="form-label">Valor de Saída</label><br>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" step="0.01" class="form-control" id="ValorOut" name="ValorOut" placeholder="0,00">
      </div>
    </div>
    <br>
    <!-- Campos para Upload de Fotos -->
    <div class="mb-3">
      <label for="foto1" class="form-label">Foto 1</label><br>
      <input type="file" class="form-control" id="foto1" name="foto1" accept="image/*">
    </div>
    <br>
    <div class="mb-3">
      <label for="foto2" class="form-label">Foto 2</label><br>
      <input type="file" class="form-control" id="foto2" name="foto2" accept="image/*">
    </div>
    <br>
    <div class="mb-3">
      <label for="foto3" class="form-label">Foto 3</label><br>
      <input type="file" class="form-control" id="foto3" name="foto3" accept="image/*">
    </div>
    <br>
    <div class="mb-3">
      <label for="foto4" class="form-label">Foto 4</label><br>
      <input type="file" class="form-control" id="foto4" name="foto4" accept="image/*">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
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
