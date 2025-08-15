<?php
// Configuração da tabela a ser listada
$tabela = 'produtos'; // Altere para 'usuarios', 'clientes' ou 'pedidos' conforme necessário

require_once 'db.php';

// Consulta SQL para buscar todos os registros ordenados por ID decrescente
$sql = "SELECT * FROM `$tabela` ORDER BY id DESC";
$result = $conn->query($sql);

// Função para escapar valores
function esc($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Inserções - <?php echo esc($tabela); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header style="margin-bottom: 20px;">
            <nav>
                <a href="listar_insercoes.php" style="font-weight: bold; text-decoration: underline;">Ver Inserções</a>
            </nav>
        </header>
        <h1>Registros da Tabela: <?php echo esc($tabela); ?></h1>
        <form method="get" style="margin-bottom: 20px;">
            <button type="submit">Atualizar</button>
        </form>
        <div class="table-responsive">
        <?php
        if ($result && $result->num_rows > 0) {
            echo '<table>';
            // Cabeçalho dinâmico
            echo '<thead><tr>';
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                echo '<th>' . esc($field->name) . '</th>';
            }
            echo '</tr></thead><tbody>';
            // Dados
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . esc($value) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Nenhum dado encontrado.</p>';
        }
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
