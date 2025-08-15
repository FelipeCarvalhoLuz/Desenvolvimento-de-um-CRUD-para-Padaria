<?php
session_start();
include 'db.php';
// Adicionar ao carrinho
if (isset($_POST['add_carrinho'])) {
    $id = $_POST['idProduto'];
    $nome = $_POST['nomeProduto'];
    $preco = $_POST['precoProduto'];
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        $_SESSION['carrinho'][$id] = [
            'nome' => $nome,
            'preco' => $preco,
            'quantidade' => 1
        ];
    }
}
// Remover do carrinho
if (isset($_POST['remove_carrinho'])) {
    $id = $_POST['idProduto'];
    unset($_SESSION['carrinho'][$id]);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pãodango - Loja Virtual</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="main-bg">
        <nav class="navbar">
            <img src="logo.png" alt="Logo Padaria" class="logo-navbar">
            <span class="navbar-title">Pãodango</span>
            <div style="margin-left:auto; display:flex; gap:24px;">
                <a href="index.php" style="color:#fff; text-decoration:none; font-weight:bold;">Home</a>
                <a href="#produtos" style="color:#fff; text-decoration:none; font-weight:bold;">Produtos</a>
                <a href="#carrinho" style="color:#fff; text-decoration:none; font-weight:bold;">Carrinho</a>
                <a href="listar_insercoes.php" style="color:#fff; text-decoration:none; font-weight:bold;">Ver Inserções</a>
                <a href="#login" style="color:#fff; text-decoration:none; font-weight:bold;">Login</a>
            </div>
        </nav>
        <section class="hero">
            <div class="hero-content">
                <h2>Bem-vindo à Pãodango!</h2>
                <p>Os melhores pães, doces e salgados fresquinhos para você. Confira nossos produtos abaixo e monte seu pedido!</p>
            </div>
        </section>
        <section id="produtos" class="container">
            <h1>Produtos em Destaque</h1>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:24px; margin-top:32px;">
                <?php
                $sql = "SELECT * FROM produtos";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div style="background:#fff8ec; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:18px; text-align:center;">';
                        echo '<img src="logo.png" alt="' . htmlspecialchars($row['nomeProduto']) . '" style="width:80px; margin-bottom:12px;">';
                        echo '<h3 style="color:#4e3c1e;">' . htmlspecialchars($row['nomeProduto']) . '</h3>';
                        echo '<p style="color:#7a5c2e; font-size:1.1rem;">R$ ' . number_format($row['preçoProduto'],2,',','.') . ' unidade</p>';
                        echo '<form method="post"><input type="hidden" name="idProduto" value="' . $row['idProduto'] . '" />';
                        echo '<input type="hidden" name="nomeProduto" value="' . htmlspecialchars($row['nomeProduto']) . '" />';
                        echo '<input type="hidden" name="precoProduto" value="' . $row['preçoProduto'] . '" />';
                        echo '<button class="btn-cadastro" type="submit" name="add_carrinho">Adicionar ao Carrinho</button></form>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhum produto cadastrado.</p>';
                }
                ?>
            </div>
        </section>
        <section id="carrinho" class="container">
            <h1>Seu Carrinho</h1>
            <?php
            if (!empty($_SESSION['carrinho'])) {
                echo '<table><tr><th>Produto</th><th>Preço</th><th>Qtd</th><th>Total</th><th>Ação</th></tr>';
                $total = 0;
                foreach ($_SESSION['carrinho'] as $id => $item) {
                    $subtotal = $item['preco'] * $item['quantidade'];
                    $total += $subtotal;
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($item['nome']) . '</td>';
                    echo '<td>R$ ' . number_format($item['preco'],2,',','.') . '</td>';
                    echo '<td>' . $item['quantidade'] . '</td>';
                    echo '<td>R$ ' . number_format($subtotal,2,',','.') . '</td>';
                    echo '<td><form method="post"><input type="hidden" name="idProduto" value="' . $id . '" />';
                    echo '<button type="submit" name="remove_carrinho">Remover</button></form></td>';
                    echo '</tr>';
                }
                echo '<tr><th colspan="3">Total</th><th colspan="2">R$ ' . number_format($total,2,',','.') . '</th></tr>';
                echo '</table>';
                echo '<button style="margin-top:18px;" class="btn-cadastro" disabled>Finalizar Pedido (em breve)</button>';
            } else {
                echo '<p>Seu carrinho está vazio.</p>';
            }
            ?>
        </section>
        <!-- Espaço para login futuramente -->
    </div>
</body>
</html>
