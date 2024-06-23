<?php
    include "console/oracle.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karanga! A sua loja de carros.</title>
    <link rel="stylesheet" href="./console/css/karanga.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-bordered th,
        .table-bordered td {
            border: 1px solid Black;
        }
        /* CSS para alinhar*/
        .alinhar {
            text-align: center;
        }
        .img-thumbnail {
            width: 100px;
            height: auto;
        }

        table {
            width: 300%;
            border-collapse: collapse;
        }

        th{
            background-color: grey;
            color: white;
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
                    // Ajustar a consulta SQL para fazer o JOIN entre VEICULOS e MARCAS_VEICULOS, e obter apenas a primeira foto
                    $sql = "SELECT v.IdVeic, 
                                   mv.Marca AS Marca, 
                                   v.Modelo, 
                                   v.Ano_Fab, 
                                   v.km, 
                                   v.ValorOut, 
                                   vf.Caminho_Foto 
                            FROM VEICULOS v 
                            JOIN MARCAS_VEICULOS mv ON v.IdMarca = mv.IdMarca 
                            LEFT JOIN (
                                SELECT IdVeic, Caminho_Foto,
                                       ROW_NUMBER() OVER (PARTITION BY IdVeic ORDER BY IdFoto) AS RowNumber
                                FROM VEICULOS_FOTOS
                            ) vf ON v.IdVeic = vf.IdVeic AND vf.RowNumber = 1";
                    
                    $result = $conexao->query($sql);
                    
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='alinhar'><a href='detalhes_veiculo.php?id=" . $row['IdVeic'] . "'>" . $row['IdVeic'] . "</a></td>";
                            echo "<td class='alinhar'>";
                            if (!empty($row['Caminho_Foto'])) {
                                echo "<img src='" . $row['Caminho_Foto'] . "' alt='Foto do Veículo' class='img-thumbnail'>";
                            } else {
                                echo "Sem foto";
                            }
                            echo "</td>";
                            echo "<td class='alinhar'>" . $row['Marca'] . "</td>";
                            echo "<td class='alinhar'>" . $row['Modelo'] . "</td>";
                            echo "<td class='alinhar'>" . $row['Ano_Fab'] . "</td>";
                            echo "<td class='alinhar'>" . $row['km'] . "</td>";
                            echo "<td class='alinhar'>" . "R$" . number_format($row['ValorOut'], 2, ',', '.') . "</td>";
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
