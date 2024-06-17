<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados

$veiculo = null;
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search'])) {
        $search_term = trim($_POST['search_term']);
        if (!empty($search_term)) {
            $sql = "SELECT * FROM VEICULOS WHERE IdVeic = ? OR Modelo LIKE ?";
            $stmt = $conexao->prepare($sql);
            $like_term = "%" . $search_term . "%";
            $stmt->bind_param("is", $search_term, $like_term);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $veiculo = $result->fetch_assoc();

                // Obter fotos do veículo
                $veiculo['fotos'] = [];
                $sql_fotos = "SELECT Caminho_Foto FROM VEICULOS_FOTOS WHERE IdVeic = ?";
                $stmt_fotos = $conexao->prepare($sql_fotos);
                $stmt_fotos->bind_param("i", $veiculo['IdVeic']);
                $stmt_fotos->execute();
                $result_fotos = $stmt_fotos->get_result();
                while ($row = $result_fotos->fetch_assoc()) {
                    $veiculo['fotos'][] = str_replace('console/', '', $row['Caminho_Foto']); // Remove 'console/' do caminho
                }
                $stmt_fotos->close();
            } else {
                $mensagem = "Nenhum veículo encontrado com o ID ou Modelo especificado.";
            }
            $stmt->close();
        } else {
            $mensagem = "Por favor, insira um termo de pesquisa válido.";
        }
    } elseif (isset($_POST['update'])) {
        // Inicializar todas as variáveis com valores padrão
        $IdVeic = $_POST['IdVeic'] ?? null;
        $IdTipo = $_POST['IdTipo'] ?? '';
        $IdMarca = $_POST['IdMarca'] ?? '';
        $IdCli = $_POST['IdCli'] ?? '';
        $Modelo = $_POST['Modelo'] ?? '';
        $Ano_Fab = $_POST['Ano_Fab'] ?? '';
        $Ano_Mod = $_POST['Ano_Mod'] ?? '';
        $km = $_POST['km'] ?? '';
        $Renavan = $_POST['Renavan'] ?? '';
        $Placa = $_POST['Placa'] ?? '';
        $Cor = $_POST['Cor'] ?? '';
        $Combustivel = $_POST['Combustivel'] ?? '';
        $Cambio = $_POST['Cambio'] ?? '';
        $Categoria = $_POST['Categoria'] ?? '';
        $Portas = $_POST['Portas'] ?? '';
        $ValorIn = $_POST['ValorIn'] ?? '';
        $ValorOut = $_POST['ValorOut'] ?? '';

        $sql = "UPDATE VEICULOS SET IdTipo = ?, IdMarca = ?, IdCli = ?, Modelo = ?, Ano_Fab = ?, Ano_Mod = ?, km = ?, Renavan = ?, Placa = ?, Cor = ?, Combustivel = ?, Cambio = ?, Categoria = ?, Portas = ?, ValorIn = ?, ValorOut = ? WHERE IdVeic = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("iiiisssssssssssii", $IdTipo, $IdMarca, $IdCli, $Modelo, $Ano_Fab, $Ano_Mod, $km, $Renavan, $Placa, $Cor, $Combustivel, $Cambio, $Categoria, $Portas, $ValorIn, $ValorOut, $IdVeic);
        if ($stmt->execute()) {
            $mensagem = "Veículo atualizado com sucesso!";

            // Processar upload de fotos
            for ($i = 1; $i <= 4; $i++) {
                if (isset($_FILES["foto$i"]) && $_FILES["foto$i"]['error'] == UPLOAD_ERR_OK) {
                    $extensao = pathinfo($_FILES["foto$i"]['name'], PATHINFO_EXTENSION);
                    $novo_nome = $IdVeic . "_foto$i." . $extensao;
                    $caminho = "VEICULOS_FOTOS/" . $novo_nome;

                    if (move_uploaded_file($_FILES["foto$i"]['tmp_name'], $caminho)) {
                        $sql_foto = "INSERT INTO VEICULOS_FOTOS (IdVeic, Caminho_Foto) VALUES (?, ?)";
                        $stmt_foto = $conexao->prepare($sql_foto);
                        $caminho_db = "VEICULOS_FOTOS/" . $novo_nome; // Caminho correto para o banco de dados
                        $stmt_foto->bind_param("is", $IdVeic, $caminho_db);
                        $stmt_foto->execute();
                        $stmt_foto->close();
                    }
                }
            }

            // Obter fotos atualizadas do veículo
            $veiculo['fotos'] = [];
            $sql_fotos = "SELECT Caminho_Foto FROM VEICULOS_FOTOS WHERE IdVeic = ?";
            $stmt_fotos = $conexao->prepare($sql_fotos);
            $stmt_fotos->bind_param("i", $IdVeic);
            $stmt_fotos->execute();
            $result_fotos = $stmt_fotos->get_result();
            while ($row = $result_fotos->fetch_assoc()) {
                $veiculo['fotos'][] = str_replace('console/', '', $row['Caminho_Foto']); // Remove 'console/' do caminho
            }
            $stmt_fotos->close();
        } else {
            $mensagem = "Erro ao atualizar o veículo: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Veículos</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Personalizado -->
  <link href="css/customizado.css" rel="stylesheet">
</head>
<body>

<!-- Topnav -->
<nav class="topnav">
  <a href="index2.php" class="active">Home</a>
  <a href="modificar-cadastros-funcionarios.php">Funcionários</a>
  <a href="modificar-cadastros-clientes.php">Clientes</a>
  <a href="modificar-cadastros-tipos.php">Tipos</a>
  <a href="modificar-cadastros-marcas.php">Marcas</a>
  <a href="modificar-cadastros-veiculos.php">Veículos</a>
  <a href="modificar-cadastro-acessorios.php">Acessórios</a>
  <a href="sair.php" class="botao-sair">Sair</a>
</nav>

<!-- Conteúdo -->
<div class="conteudo">
  <h2>Modificar Veículos</h2>
  <form action="modificar-cadastros-veiculos.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="search_term" class="form-label">Pesquisar por ID ou Modelo</label>
      <input type="text" class="form-control" id="search_term" name="search_term" required>
    </div>
    <button type="submit" name="search" class="btn btn-primary">Pesquisar</button>
  </form>

  <?php if ($veiculo): ?>
  <form action="modificar-cadastros-veiculos.php" method="post" class="mt-4" enctype="multipart/form-data">
    <input type="hidden" name="IdVeic" value="<?php echo $veiculo['IdVeic']; ?>">
    <div class="mb-3">
      <label for="IdTipo" class="form-label">Tipo</label>
      <input type="number" class="form-control" id="IdTipo" name="IdTipo" value="<?php echo $veiculo['IdTipo']; ?>">
    </div>
    <div class="mb-3">
      <label for="IdMarca" class="form-label">Marca</label>
      <input type="number" class="form-control" id="IdMarca" name="IdMarca" value="<?php echo $veiculo['IdMarca']; ?>">
    </div>
    <div class="mb-3">
      <label for="IdCli" class="form-label">Cliente</label>
      <input type="number" class="form-control" id="IdCli" name="IdCli" value="<?php echo $veiculo['IdCli']; ?>">
    </div>
    <div class="mb-3">
      <label for="Modelo" class="form-label">Modelo</label>
      <input type="text" class="form-control" id="Modelo" name="Modelo" value="<?php echo $veiculo['Modelo']; ?>">
    </div>
    <div class="mb-3">
      <label for="Ano_Fab" class="form-label">Ano de Fabricação</label>
      <input type="number" class="form-control" id="Ano_Fab" name="Ano_Fab" value="<?php echo $veiculo['Ano_Fab']; ?>">
    </div>
    <div class="mb-3">
      <label for="Ano_Mod" class="form-label">Ano do Modelo</label>
      <input type="number" class="form-control" id="Ano_Mod" name="Ano_Mod" value="<?php echo $veiculo['Ano_Mod']; ?>">
    </div>
    <div class="mb-3">
      <label for="km" class="form-label">Quilometragem</label>
      <input type="number" class="form-control" id="km" name="km" value="<?php echo $veiculo['km']; ?>">
    </div>
    <div class="mb-3">
      <label for="Renavan" class="form-label">Renavan</label>
      <input type="text" class="form-control" id="Renavan" name="Renavan" value="<?php echo $veiculo['Renavan']; ?>">
    </div>
    <div class="mb-3">
      <label for="Placa" class="form-label">Placa</label>
      <input type="text" class="form-control" id="Placa" name="Placa" value="<?php echo $veiculo['Placa']; ?>">
    </div>
    <div class="mb-3">
      <label for="Cor" class="form-label">Cor</label>
      <input type="text" class="form-control" id="Cor" name="Cor" value="<?php echo $veiculo['Cor']; ?>">
    </div>
    <div class="mb-3">
      <label for="Combustivel" class="form-label">Combustível</label>
      <input type="text" class="form-control" id="Combustivel" name="Combustivel" value="<?php echo $veiculo['Combustivel']; ?>">
    </div>
    <div class="mb-3">
      <label for="Cambio" class="form-label">Câmbio</label>
      <input type="text" class="form-control" id="Cambio" name="Cambio" value="<?php echo $veiculo['Cambio']; ?>">
    </div>
    <div class="mb-3">
      <label for="Categoria" class="form-label">Categoria</label>
      <input type="text" class="form-control" id="Categoria" name="Categoria" value="<?php echo $veiculo['Categoria']; ?>">
    </div>
    <div class="mb-3">
      <label for="Portas" class="form-label">Portas</label>
      <input type="number" class="form-control" id="Portas" name="Portas" value="<?php echo $veiculo['Portas']; ?>">
    </div>
    <div class="mb-3">
      <label for="ValorIn" class="form-label">Valor de Entrada</label>
      <input type="number" step="0.01" class="form-control" id="ValorIn" name="ValorIn" value="<?php echo $veiculo['ValorIn']; ?>">
    </div>
    <div class="mb-3">
      <label for="ValorOut" class="form-label">Valor de Saída</label>
      <input type="number" step="0.01" class="form-control" id="ValorOut" name="ValorOut" value="<?php echo $veiculo['ValorOut']; ?>">
    </div>
    <div class="mb-3">
      <label for="fotos" class="form-label">Fotos</label>
      <?php if (!empty($veiculo['fotos'])): ?>
        <div class="mb-3">
          <?php foreach ($veiculo['fotos'] as $index => $foto): ?>
            <div class="d-flex align-items-center mb-2">
              <img src="<?php echo $foto; ?>" alt="Foto do Veículo" class="img-thumbnail me-2" width="150">
              <input type="file" name="foto<?php echo $index + 1; ?>" class="form-control">
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="mb-3">
          <?php for ($i = 1; $i <= 4; $i++): ?>
            <input type="file" name="foto<?php echo $i; ?>" class="form-control mb-2">
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Atualizar Veículo</button>
  </form>
  <?php endif; ?>
  <?php if (!empty($mensagem)): ?>
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
