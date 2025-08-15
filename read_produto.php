<?php
include 'db.php';
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border ='1'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['idProduto']}</td>
                <td>{$row['nomeProduto']}</td>
                <td>R$ {$row['preçoProduto']}</td>
                <td>{$row['descriçao']}</td>
                <td>
                    <a href='update_produto.php?id={$row['idProduto']}'>Editar</a>
                    <a href='delete_produto.php?id={$row['idProduto']}'>Excluir</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum produto cadastrado.";
}
$conn->close();
echo "<a href='create_produto.php'>Cadastrar novo Produto</a>";
