<?php
$agora = date('Y-m-d H:i:s');

$host  = "localhost";
$user  = "root";
$pass  = "admin";
$banco = "karangas";
$porta = 3306;
//$br = "</br>";

// Criando a conexão MySQLi
$conexao = mysqli_connect($host, $user, $pass, $banco, $porta);
mysqli_set_charset($conexao, "utf8");

// Verificando se ocorreu algum erro na conexão
if (!$conexao) 
 {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error()); 
 }

mysqli_set_charset($conexao, "utf8");

// Fechando a conexão ao final do script (opcional)
//mysqli_close($conexao
?>