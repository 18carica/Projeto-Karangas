<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">    
    <!-- Tema Dark -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.0-alpha1/darkly/bootstrap.min.css">
    <link href="./css/login.css" rel="stylesheet">

</head>
<!-- PARA O FUNCIONARIO -->

<body>
    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-4">
                <h2 class="text-center text-white mb-4">Karangas System - Login</h2>
                <div class="row">
                    <?php
                        // Verifica se $_SESSION["msg"] não é nulo e imprime a mensagem
                        if(isset($_SESSION["msg"]) && $_SESSION["msg"] !== null) 
                        {
                            echo $_SESSION["msg"];
                            // Limpa a mensagem para evitar que seja exibida novamente
                            $_SESSION["msg"] = null;
                        }
                    ?>                    
                </div>
                <form method="post" action="exec/index-login-exec.php">
                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Nome de Usuário</label>
                        <input type="text" class="form-control" id="username" name="user" placeholder="Digite seu nome de usuário">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Senha</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
