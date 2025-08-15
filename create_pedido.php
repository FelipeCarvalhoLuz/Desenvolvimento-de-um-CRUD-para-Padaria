<?php
header('Content-Type: application/json');
require_once 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['itens']) || !is_array($data['itens']) || count($data['itens']) === 0) {
    echo json_encode(['sucesso' => false, 'erro' => 'Carrinho vazio']);
    exit;
}

try {
    $conn->begin_transaction();
    $sql = "INSERT INTO pedidos (dataPedido) VALUES (NOW())";
    if (!$conn->query($sql)) throw new Exception('Erro ao criar pedido');
    $pedido_id = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO itens_pedido (pedido_id, produto, preco, quantidade) VALUES (?, ?, ?, ?)");
    foreach ($data['itens'] as $item) {
        $nome = $item['nome'];
        $preco = $item['preco'];
        $qtd = $item['qtd'];
        $stmt->bind_param('isdi', $pedido_id, $nome, $preco, $qtd);
        if (!$stmt->execute()) throw new Exception('Erro ao inserir item');
    }
    $conn->commit();
    echo json_encode(['sucesso' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
}
