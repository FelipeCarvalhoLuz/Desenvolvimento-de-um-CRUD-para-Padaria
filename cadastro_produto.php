<?php
include 'db.php';
$erro = '';
$sucesso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    if (!$nome || !$preco || !is_numeric($preco)) {
        $erro = 'Preencha todos os campos corretamente!';
    } else {
        $stmt = $conn->prepare("INSERT INTO produtos (nomeProduto, preçoProduto) VALUES (?, ?)");
        $stmt->bind_param("sd", $nome, $preco);
        if ($stmt->execute()) {
            $sucesso = 'Produto cadastrado com sucesso!';
        } else {
            $erro = 'Erro ao cadastrar produto: ' . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto - Padaria</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Cadastro de Produto</h1>
    <?php if (!empty($erro)) echo "<div class='error'>$erro</div>"; ?>
    <?php if (!empty($sucesso)) echo "<div class='success'>$sucesso</div>"; ?>
    <form method="post">
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" id="nome" required>
        <label for="preco">Preço (R$):</label>
        <input type="number" step="0.01" name="preco" id="preco" required>
        <button type="submit">Cadastrar Produto</button>
    </form>
    <a href="index.php">Ir para pedidos</a>
</div>
</body>
</html>
