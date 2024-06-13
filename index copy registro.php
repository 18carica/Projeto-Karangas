<?php
    include "console/oracle.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karanga! A sua loja de carros.</title>
    <link rel="stylesheet" href="console/css/karanga.css">
</head>
<!-- PARA O CLIENTE -->
<body>
    <header>
        <img src="imagens/logo_karanga.png" alt="Logo da Karanga">
        <span><p>Karanga! Carros especiais.</p></span>
    </header>
    <main>
        <section id="cadastro">
        <h4>Crie seu Login</h4>
            <form action="console/index2.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>
                <input type="submit" value="Register">
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; Karanga 2024 Uma aula demo</p>
    </footer>
</body>
</html>
<?php
    $conexao->close();
?>