<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idfun = !empty($_POST['idfun']) ? intval($_POST['idfun']) : null;
    $nome_completo = !empty($_POST['nome_completo']) ? $_POST['nome_completo'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $situacao = !empty($_POST['situacao']) ? $_POST['situacao'] : '1'; // Valor padrão '1' se não for fornecido

    if ($idfun === null) {
        die('ID do funcionário não fornecido.');
    }

    // Preparação da consulta SQL
    $sql = "UPDATE funcionarios 
            SET nome_completo = ?, email = ?, data_alteracao = NOW(), situacao = ? 
            WHERE idfun = ?";

    // Preparação da declaração
    $stmt = $conexao->prepare($sql);

    // Verificação se a preparação ocorreu corretamente
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    // Vinculação dos parâmetros
    $stmt->bind_param("sssi", $nome_completo, $email, $situacao, $idfun);

    // Execução da consulta
    if ($stmt->execute()) {
        $mensagem = "Funcionário modificado com sucesso!";
    } else {
        $mensagem = "Erro ao modificar o funcionário: " . $stmt->error;
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
  <title>Modificar Funcionário</title>
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
  <a href="modificar-cadastros-funcionarios.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

<!-- Bootstrap JS e dependências opcionais -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
<?php $conexao->close(); ?>
