<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../oracle.php';

    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    $username = $_POST["user"];
    $password = $_POST["password"];

    $stmt = $conexao->prepare("SELECT logins.idfun, logins.senha, funcionarios.nome_completo
                              FROM logins
                              INNER JOIN funcionarios ON logins.idfun = funcionarios.idfun
                              WHERE logins.usuario = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        $passHash = $dados['senha'];

        if (password_verify($password, $passHash)) {
            $_SESSION["idfun"] = $dados['idfun'];
            $_SESSION["nome"] = $dados['nome_completo'];
            $_SESSION["start"] = strtotime('now');
            $_SESSION["expire"] = strtotime('+30 minutes', $_SESSION["start"]);
            $_SESSION["msg"] = "<div class='alert alert-primary' role='aviso'>
                                    Olá <strong>".$_SESSION["nome"].".</strong>, Login Efetuado com sucesso!
                                </div>";
            mysqli_close($conexao);                    
            header('Location: ../index2.php');
            exit();
        } else {
            $_SESSION["msg"] = "<div class='alert alert-danger' role='aviso'>
                                    Senha incorreta. Por favor, tente novamente.
                                </div>";
            mysqli_close($conexao);
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION["msg"] = "<div class='alert alert-warning' role='aviso'>
                                Usuário não encontrado. Por favor, verifique suas credenciais.
                            </div>";
        mysqli_close($conexao);
        header('Location: ../index.php');
        exit();
    }
    
    header('Location: ../index.php');
    exit();
}
?>

