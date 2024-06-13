<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST['marca'];
    
    // Validar entrada
    if (!empty($marca)) {
        // Verificar se a marca já existe
        $sql_check = "SELECT COUNT(*) as count FROM MARCAS_VEICULOS WHERE Marca = ?";
        $stmt_check = $conexao->prepare($sql_check);
        $stmt_check->bind_param("s", $marca);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            $mensagem = "Marca já cadastrada!";
        } else {
            // Inserir a nova marca
            $sql = "INSERT INTO MARCAS_VEICULOS (Marca) VALUES (?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $marca);
            if ($stmt->execute()) {
                $mensagem = "Marca cadastrada com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar a marca: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $mensagem = "Por favor, preencha o nome da marca.";
    }
}
?>