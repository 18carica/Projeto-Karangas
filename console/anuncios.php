<?php
// Inclua o arquivo de conexão com o banco de dados
include "console/oracle.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anúncios de Veículos - Karanga!</title>
    <link rel="stylesheet" href="console/css/karanga.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px; /* Altura fixa para as imagens dos veículos */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <header>
        <img src="imagens/logo_karanga.png" alt="Logo da Karanga">
        <span><p>Karanga! Carros especiais.</p></span>
    </header>
    <main class="container mt-4">
        <h2 class="mb-4">Anúncios de Veículos</h2>
        <div class="row">
            <?php
            // Consulta SQL para selecionar todos os veículos e suas fotos
            $sql = "SELECT v.IdVeic, 
                           mv.Marca AS Marca, 
                           v.Modelo, 
                           v.Ano_Fab, 
                           v.ValorOut, 
                           vf.Caminho_Foto 
                    FROM VEICULOS v 
                    JOIN MARCAS_VEICULOS mv ON v.IdMarca = mv.IdMarca 
                    LEFT JOIN VEICULOS_FOTOS vf ON v.IdVeic = vf.IdVeic";
            
            $result = $conexao->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <?php if (!empty($row['Caminho_Foto'])): ?>
                                <img src="<?php echo $row['Caminho_Foto']; ?>" class="card-img-top" alt="Foto do Veículo">
                            <?php else: ?>
                                <img src="imagens/default_vehicle.jpg" class="card-img-top" alt="Foto Indisponível">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Marca'] . ' ' . $row['Modelo']; ?></h5>
                                <p class="card-text">Ano: <?php echo $row['Ano_Fab']; ?></p>
                                <p class="card-text">Valor: R$ <?php echo number_format($row['ValorOut'], 2, ',', '.'); ?></p>
                                <a href="detalhes_veiculo.php?id=<?php echo $row['IdVeic']; ?>" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Nenhum veículo encontrado.</p>";
            }
            ?>
        </div>
    </main>
    <footer class="mt-5">
        <p>&copy; Karanga 2024 - Uma aula demo</p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Fechar conexão com o banco de dados
$conexao->close();
?>
