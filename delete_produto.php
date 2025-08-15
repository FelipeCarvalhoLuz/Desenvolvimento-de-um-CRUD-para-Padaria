<?php
include 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE idProduto=$id";
if ($conn->query($sql) === true) {
    echo "Produto excluído com sucesso.<a href='read_produto.php'>Ver produtos.</a>";
} else {
    echo "Erro: " . $sql . '<br>' . $conn->error;
}
$conn->close();
exit();
