<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Tipo_Veiculo = $_POST['Tipo_Veiculo'];
    
    // Validar entrada
    if (!empty($Tipo_Veiculo)) {
        // Verificar se a marca já existe
        $sql_check = "SELECT COUNT(*) as count FROM tiposveiculos WHERE Tipo_Veiculo = ?";
        $stmt_check = $conexao->prepare($sql_check);
        $stmt_check->bind_param("s", $Tipo_Veiculo);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            $mensagem = "Tipo de Veiculo já cadastrado!";
        } else {
            // Inserir a nova marca
            $sql = "INSERT INTO tiposveiculos (Tipo_Veiculo) VALUES (?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $Tipo_Veiculo);
            if ($stmt->execute()) {
                $mensagem = "Tipo de veiculo cadastrado com sucesso!";
            } else {
                $mensagem = "Erro ao cadastrar o tipo de veiculo: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $mensagem = "Por favor, preencha o tipo de veiculo.";
    }
}
?>
