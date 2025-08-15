CREATE TABLE itens_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT,
    produto VARCHAR(100),
    preco DECIMAL(10,2),
    quantidade INT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(idPedido)
);
CREATE DATABASE PaoDango_Equipe8;

USE PaoDango_Equipe8;

CREATE TABLE usuarios(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(45),
    endereço VARCHAR(45),
    cpfUsuario CHAR(11),
    telefone VARCHAR(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produtos(
    idProduto INT PRIMARY KEY AUTO_INCREMENT,
    nomeProduto VARCHAR(45),
    preçoProduto FLOAT(10,2),
    descriçao VARCHAR(100)
);

CREATE TABLE clientes (
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(45),
    endereço VARCHAR(45),
    cpfUsuario CHAR(11),
    telefone VARCHAR(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pedidos (
    idPedido INT PRIMARY KEY AUTO_INCREMENT,
    idCliente INT,
    dataPedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    valorTotal DECIMAL(10,2) DEFAULT 0,
    FOREIGN KEY (idCliente) REFERENCES clientes(idUsuario)
);


ALTER TABLE produtos 
ADD COLUMN idUsuario INT,
ADD FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario);

ALTER TABLE pedidos 
DROP FOREIGN KEY pedidos_ibfk_1;

ALTER TABLE pedidos 
DROP COLUMN idCliente;


ALTER TABLE pedidos
ADD COLUMN idClientePrincipal INT,
ADD COLUMN clientesAdicionais TEXT,
ADD FOREIGN KEY (idClientePrincipal) REFERENCES clientes(idUsuario);

