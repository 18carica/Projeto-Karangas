<?php

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Tipo_Cliente = !empty($_POST['Tipo_Cliente']) ? $_POST['Tipo_Cliente'] : null;
  $Documento = !empty($_POST['Documento']) ? $_POST['Documento'] : null;
  $Nome = !empty($_POST['Nome']) ? $_POST['Nome'] : null;
  $Email = !empty($_POST['Email']) ? $_POST['Email'] : null;
  $Telefone = !empty($_POST['Telefone']) ? $_POST['Telefone'] : null;
  $Endereco = !empty($_POST['Endereco']) ? $_POST['Endereco'] : null;
  $Complemento = !empty($_POST['Complemento']) ? $_POST['Complemento'] : null;
  $Bairro = !empty($_POST['Bairro']) ? $_POST['Bairro'] : null;
  $Obs = !empty($_POST['Obs']) ? $_POST['Obs'] : null;
/*
  echo $Tipo_Cliente.$br;
  echo $Documento.$br;
  echo $Nome.$br;
  echo $Email.$br;
  echo $Telefone.$br;
  echo $Endereco.$br;
  echo $Complemento.$br;
  echo $Bairro.$br;
  echo $Obs.$br;}
*/
  // Inserir o novo cliente
  $sql = "INSERT INTO CLIENTES (Tipo_Cliente, Documento, Nome, Email, Telefone, Endereco, Complemento, Bairro, Obs, Dt_Criacao, Dt_Alt, Situacao) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), 1)";
  $stmt = $conexao->prepare($sql);

  // Verifica se a preparação da query foi feita corretamente
  if ($stmt === false) {
      die('Erro na preparação da consulta: ' . $conexao->error);
  }

  // Define os tipos de parâmetros
  $types = "sssssssss"; // 11 "s" para 11 parâmetros de string

  // Vincula os parâmetros
  $stmt->bind_param($types, $Tipo_Cliente, $Documento, $Nome, $Email, $Telefone, $Endereco, $Complemento, $Bairro, $Obs);

  // Executa a consulta
  if ($stmt->execute()) {
      $mensagem = "Cliente cadastrado com sucesso!";
  } else {
      $mensagem = "Erro ao cadastrar o cliente: " . $stmt->error;
  }

  // Fecha a declaração
  $stmt->close();
}


?>