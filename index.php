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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid Black;
        }
        /* CSS para alinhar à direita apenas a coluna "Valor de Saída" */
        .alinhar-direita {
            text-align: right;
        }
        .img-thumbnail {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <img src="imagens/logo_karanga.png" alt="Logo da Karanga">
        <span><p>Karanga! Carros especiais.</p></span>
    </header>
    <main>
        <section id="veiculos">
            <h4>Veículos Cadastrados</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>KM</th>
                        <th>Valor de Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ajustar a consulta SQL para fazer o JOIN entre VEICULOS e MARCAS_VEICULOS, e obter a primeira foto
                    $sql = "SELECT VEICULOS.IdVeic, 
                                   MARCAS_VEICULOS.Marca AS Marca, 
                                   VEICULOS.Modelo, 
                                   VEICULOS.Ano_Fab, 
                                   VEICULOS.km, 
                                   VEICULOS.ValorOut, 
                                   (SELECT Caminho_Foto FROM VEICULOS_FOTOS WHERE VEICULOS_FOTOS.IdVeic = VEICULOS.IdVeic LIMIT 1) AS Foto 
                            FROM VEICULOS 
                            JOIN MARCAS_VEICULOS ON VEICULOS.IdMarca = MARCAS_VEICULOS.IdMarca";
                    $result = $conexao->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='detalhes_veiculo.php?id=" . $row['IdVeic'] . "'>" . $row['IdVeic'] . "</a></td>";
                            echo "<td>";
                            if (!empty($row['Foto'])) {
                                echo "<img src='" . $row['Foto'] . "' alt='Foto do Veículo' class='img-thumbnail'>";
                            } else {
                                echo "Sem foto";
                            }
                            echo "</td>";
                            echo "<td>" . $row['Marca'] . "</td>";
                            echo "<td>" . $row['Modelo'] . "</td>";
                            echo "<td>" . $row['Ano_Fab'] . "</td>";
                            echo "<td class='alinhar-direita'>" . $row['km'] . "</td>";
                            echo "<td class='alinhar-direita'>" . "R$" . number_format($row['ValorOut'], 2, ',', '.') . "</td>"; // Adicionando "R$" antes do valor de ValorOut e alinhando à direita
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Nenhum veículo cadastrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; Karanga 2024 Uma aula demo</p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    $conexao->close();
?>
