<?php
// Recuperar os dados de Tipos e Marcas
$tipos = [];
$marcas = [];

$sql_tipos = "SELECT IdTipo, Tipo_Veiculo FROM TIPOSVEICULOS";
$result_tipos = $conexao->query($sql_tipos);
if ($result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $tipos[] = $row;
    }
}

$sql_marcas = "SELECT IdMarca, Marca FROM MARCAS_VEICULOS";
$result_marcas = $conexao->query($sql_marcas);
if ($result_marcas->num_rows > 0) {
    while ($row = $result_marcas->fetch_assoc()) {
        $marcas[] = $row;
    }
}

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdTipo = $_POST['IdTipo'] ?? null;
    $IdMarca = $_POST['IdMarca'] ?? null;
    $IdCli = $_POST['IdCli'] ?? null;
    $Modelo = $_POST['Modelo'] ?? null;
    $Ano_Fab = $_POST['Ano_Fab'] ?? null;
    $Ano_Mod = $_POST['Ano_Mod'] ?? null;
    $km = $_POST['km'] ?? null;
    $Renavan = $_POST['Renavan'] ?? null;
    $Placa = $_POST['Placa'] ?? null;
    $Cor = $_POST['Cor'] ?? null;
    $Combustivel = $_POST['Combustivel'] ?? null;
    $Cambio = $_POST['Cambio'] ?? null;
    $Categoria = $_POST['Categoria'] ?? null;
    $Portas = $_POST['Portas'] ?? null;
    $ValorIn = $_POST['ValorIn'] ?? null;
    $ValorOut = $_POST['ValorOut'] ?? null;

    // Inserir o novo veículo
    $sql = "INSERT INTO VEICULOS (IdTipo, IdMarca, IdCli, Modelo, Ano_Fab, Ano_Mod, km, Renavan, Placa, Cor, Combustivel, Cambio, Categoria, Portas, ValorIn, ValorOut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    // Tratar campos opcionais
    $stmt->bind_param("iiisssissssssiid", $IdTipo, $IdMarca, $IdCli, $Modelo, $Ano_Fab, $Ano_Mod, $km, $Renavan, $Placa, $Cor, $Combustivel, $Cambio, $Categoria, $Portas, $ValorIn, $ValorOut);

    // Substituir valores vazios por NULL
    foreach ([$IdCli, $Modelo, $Ano_Fab, $Ano_Mod, $km, $Renavan, $Placa, $Cor, $Combustivel, $Cambio, $Categoria, $Portas, $ValorIn, $ValorOut] as &$value) {
        if (empty($value)) {
            $value = NULL;
        }
    }

    if ($stmt->execute()) {
        $IdVeic = $stmt->insert_id; // Obter o ID do veículo recém-inserido
        $mensagem = "Veículo cadastrado com sucesso!";
        
        // Processar upload de fotos
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_FILES["foto$i"]) && $_FILES["foto$i"]['error'] == UPLOAD_ERR_OK) {
                $extensao = pathinfo($_FILES["foto$i"]['name'], PATHINFO_EXTENSION);
                $novo_nome = $IdVeic . "_foto$i." . $extensao;
                $caminho = "uploads/" . $novo_nome;

                if (move_uploaded_file($_FILES["foto$i"]['tmp_name'], $caminho)) {
                    $sql_foto = "INSERT INTO VEICULOS_FOTOS (IdVeic, Caminho_Foto) VALUES (?, ?)";
                    $stmt_foto = $conexao->prepare($sql_foto);
                    $stmt_foto->bind_param("is", $IdVeic, $caminho);
                    $stmt_foto->execute();
                    $stmt_foto->close();
                }
            }
        }
    } else {
        $mensagem = "Erro ao cadastrar o veículo: " . $stmt->error;
    }
    $stmt->close();
}
?>