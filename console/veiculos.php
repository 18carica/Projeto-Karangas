<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "oracle.php"; // Certifique-se de que este arquivo contém a conexão correta ao banco de dados
include "fn/validar_sessao.php";


// Inicialize a variável de mensagem
$mensagem = "";

// Processar a busca
$search = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Consulta para obter os veículos
$sql = "SELECT * FROM veiculos";
if (!empty($search)) {
    $sql .= " WHERE modelo LIKE ? OR placa LIKE ? OR renavam LIKE ?";
    $stmt = $conexao->prepare($sql);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexao->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listam de Veículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Veículos</h1>

        <!-- Barra de Pesquisa -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar por modelo, placa ou RENAVAM" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- Mensagem -->
        <?php if (!empty($mensagem)) { echo '<div class="alert alert-info">' . $mensagem . '</div>'; } ?>

        <!-- Listagem de Veículos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Modelo</th>
                    <th>Ano Fab</th>
                    <th>Ano Mod</th>
                    <th>Valor In</th>
                    <th>Valor Out</th>
                    <th>Placa</th>
                    <th>Cor</th>
                    <th>Combustível</th>
                    <th>Câmbio</th>
                    <th>RENAVAM</th>
                    <th>Quilometragem</th>
                    <th>Descrição</th>
                    <th>Data Cadastro</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['idveiculo']}</td>
                            <td>{$row['idmarca']}</td>
                            <td>{$row['idtipo']}</td>
                            <td>{$row['modelo']}</td>
                            <td>{$row['ano_fab']}</td>
                            <td>{$row['ano_mod']}</td>
                            <td>{$row['valorin']}</td>
                            <td>{$row['valorout']}</td>
                            <td>{$row['placa']}</td>
                            <td>{$row['cor']}</td>
                            <td>{$row['combustivel']}</td>
                            <td>{$row['tipocambio']}</td>
                            <td>{$row['renavam']}</td>
                            <td>{$row['quilometragem']}</td>
                            <td>{$row['descricao']}</td>
                            <td>{$row['data_cadastro']}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='17'>Nenhum veículo encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conexao->close();
?>
