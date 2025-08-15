<?php
include 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeProduto = $_POST['nomeProduto'];
    $precoProduto = $_POST['precoProduto'];
    $descricao = $_POST['descricao'];
    $sql = "UPDATE produtos SET nomeProduto='$nomeProduto', preçoProduto='$precoProduto', descriçao='$descricao' WHERE idProduto=$id";
    if ($conn->query($sql) === true) {
        echo "Produto atualizado com sucesso.<a href='read_produto.php'>Ver produtos.</a>";
    } else {
        echo "Erro: " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit();
}
$sql = "SELECT * FROM produtos WHERE idProduto=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <form method="POST" action="update_produto.php?id=<?php echo $row['idProduto']; ?>">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" name="nomeProduto" value="<?php echo $row['nomeProduto']; ?>" required>
        <label for="precoProduto">Preço:</label>
        <input type="number" step="0.01" name="precoProduto" value="<?php echo $row['preçoProduto']; ?>" required>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo $row['descriçao']; ?>" required>
        <input type="submit" value="Atualizar Produto">
    </form>
    <a href="read_produto.php">Ver produtos cadastrados</a>
</body>
</html>
