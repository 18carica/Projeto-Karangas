<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdCli = !empty($_POST['IdCli']) ? intval($_POST['IdCli']) : null;
    $Tipo_Cliente = !empty($_POST['Tipo_Cliente']) ? $_POST['Tipo_Cliente'] : null;
    $Documento = !empty($_POST['Documento']) ? $_POST['Documento'] : null;
    $Nome = !empty($_POST['Nome']) ? $_POST['Nome'] : null;
    $Email = !empty($_POST['Email']) ? $_POST['Email'] : null;
    $Telefone = !empty($_POST['Telefone']) ? $_POST['Telefone'] : null;
    $Endereco = !empty($_POST['Endereco']) ? $_POST['Endereco'] : null;
    $Complemento = !empty($_POST['Complemento']) ? $_POST['Complemento'] : null;
    $Bairro = !empty($_POST['Bairro']) ? $_POST['Bairro'] : null;
    $Obs = !empty($_POST['Obs']) ? $_POST['Obs'] : null;
    $Situacao = !empty($_POST['Situacao']) ? $_POST['Situacao'] : '1'; // Valor padrão '1' se não for fornecido

    if ($IdCli === null) {
        die('ID do cliente não fornecido.');
    }

    // Preparação da consulta SQL
    $sql = "UPDATE CLIENTES 
            SET Tipo_Cliente = ?, Documento = ?, Nome = ?, Email = ?, Telefone = ?, Endereco = ?, Complemento = ?, Bairro = ?, Obs = ?, Dt_Alt = NOW(), Situacao = ? 
            WHERE IdCli = ?";

    // Preparação da declaração
    $stmt = $conexao->prepare($sql);

    // Verificação se a preparação ocorreu corretamente
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    // Vinculação dos parâmetros
    $stmt->bind_param("sssssssssii", $Tipo_Cliente, $Documento, $Nome, $Email, $Telefone, $Endereco, $Complemento, $Bairro, $Obs, $Situacao, $IdCli);

    // Execução da consulta
    if ($stmt->execute()) {
        $mensagem = "Cliente modificado com sucesso!";
    } else {
        $mensagem = "Erro ao modificar o cliente: " . $stmt->error;
    }

    // Fechamento da declaração
    $stmt->close();
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
<!-- Conteúdo -->
<div class="conteudo">
  <!-- Mensagem de Feedback -->
  <?php if (isset($mensagem)): ?>
  <div class="alert alert-info mt-3">
    <?php echo $mensagem; ?>
  </div>
  <?php endif; ?>
  <a href="modificar-cadastros-clientes.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php $conexao->close(); ?>
