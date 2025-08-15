<?php
// Configuração da tabela a ser listada
$tabela = 'pedidos'; // Altere para 'usuarios', 'clientes' ou 'produtos' conforme necessário

require_once 'db.php';

// Consulta SQL para buscar todos os pedidos
$sql = "SELECT * FROM pedidos ORDER BY idPedido DESC";
$result = $conn->query($sql);

// Função para buscar os itens de um pedido
function buscarItensPedido($conn, $pedido_id) {
    $itens = [];
    $sql = "SELECT produto, quantidade, preco FROM itens_pedido WHERE pedido_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $pedido_id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $itens[] = $row;
    }
    $stmt->close();
    return $itens;
}

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
            echo '<thead><tr>';
            echo '<th>idPedido</th>';
            echo '<th>dataPedido</th>';
            echo '<th>Produto</th>';
            echo '<th>Qtd</th>';
            echo '<th>Preço</th>';
            echo '<th>Total do Pedido (R$)</th>';
            echo '</tr></thead><tbody>';
            while ($row = $result->fetch_assoc()) {
                $itens = buscarItensPedido($conn, $row['idPedido']);
                $total = 0;
                $numItens = count($itens);
                if ($numItens > 0) {
                    foreach ($itens as $idx => $item) {
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $total += $subtotal;
                        echo '<tr>';
                        // idPedido e dataPedido só na primeira linha do pedido
                        if ($idx === 0) {
                            echo '<td rowspan="' . $numItens . '">' . esc($row['idPedido']) . '</td>';
                            echo '<td rowspan="' . $numItens . '">' . esc($row['dataPedido']) . '</td>';
                        }
                        // Produto, Qtd, Preço
                        echo '<td>' . esc($item['produto']) . '</td>';
                        echo '<td>' . esc($item['quantidade']) . '</td>';
                        echo '<td>R$ ' . number_format($item['preco'], 2, ',', '.') . '</td>';
                        // Total só na primeira linha do pedido
                        if ($idx === 0) {
                            echo '<td rowspan="' . $numItens . '"><b>R$ ' . number_format($total, 2, ',', '.') . '</b></td>';
                        }
                        echo '</tr>';
                    }
                } else {
                    // Pedido sem itens
                    echo '<tr>';
                    echo '<td>' . esc($row['idPedido']) . '</td>';
                    echo '<td>' . esc($row['dataPedido']) . '</td>';
                    echo '<td colspan="3">Nenhum item</td>';
                    echo '<td>R$ 0,00</td>';
                    echo '</tr>';
                }
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
