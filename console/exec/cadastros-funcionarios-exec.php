<?php
    
// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = !empty($_POST['nome_completo']) ? $_POST['nome_completo'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $situacao = !empty($_POST['situacao']) ? $_POST['situacao'] : '1'; // Valor padrão '1' se não for fornecido

    // Preparação da consulta SQL
    $sql = "INSERT INTO funcionarios (nome_completo, email, data_cadastro, data_alteracao, situacao) 
            VALUES (?, ?, NOW(), NOW(), ?)";

    // Preparação da declaração
    $stmt = $conexao->prepare($sql);

    // Verificação se a preparação ocorreu corretamente
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    // Vinculação dos parâmetros
    $stmt->bind_param("sss", $nome_completo, $email, $situacao);

    // Execução da consulta
    if ($stmt->execute()) {
        $mensagem = "Funcionário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar o funcionário: " . $stmt->error;
    }

    // Fechamento da declaração
    $stmt->close();
}
?>