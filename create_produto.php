<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeProduto = $_POST['nomeProduto'];
    $precoProduto = $_POST['precoProduto'];
    $descricao = $_POST['descricao'];
    $idUsuario = $_POST['idUsuario'];
    $sql = "INSERT INTO produtos (nomeProduto, preçoProduto, descriçao, idUsuario) VALUES ('$nomeProduto', '$precoProduto', '$descricao', '$idUsuario')";
    if ($conn->query($sql) === true) {
        echo "Novo produto cadastrado com sucesso.";
    } else {
        echo "Erro: " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <form method="POST" action="create_produto.php">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" name="nomeProduto" required>
        <label for="precoProduto">Preço:</label>
        <input type="number" step="0.01" name="precoProduto" required>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" required>
        <label for="idUsuario">ID do Usuário (quem cadastrou):</label>
        <input type="number" name="idUsuario" required>
        <input type="submit" value="Adicionar Produto">
    </form>
    <a href="read_produto.php">Ver produtos cadastrados</a>
</body>
</html>
