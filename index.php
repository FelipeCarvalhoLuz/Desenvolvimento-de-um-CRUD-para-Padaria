<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pãodango - Loja Virtual</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <div class="main-bg">
        <nav class="navbar">
            <img src="logo.png" alt="Logo Padaria" class="logo-navbar">
            <span class="navbar-title">Pãodango</span>
            <div style="margin-left:auto; display:flex; gap:24px; align-items:center;">
                <a href="index.html" style="color:#fff; text-decoration:none; font-weight:bold;">Home</a>
                <a href="#produtos" style="color:#fff; text-decoration:none; font-weight:bold;">Produtos</a>
                <button id="carrinho-btn" class="carrinho-btn">
                    <span>🛒</span>
                    <span id="carrinho-count">0</span>
                </button>
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
            <div class="produtos-grid destaque-grid">
                <div class="produto-card">
                    <img src="logo.png" alt="Pão Francês" class="produto-img">
                    <h3>Pão Francês</h3>
                    <p class="preco">R$ 0,80</p>
                    <p class="descricao">Pão francês tradicional, crocante por fora e macio por dentro</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Pão Francês', 0.80, this)">Adicionar ao Carrinho</button>
                </div>
                <div class="produto-card">
                    <img src="logo.png" alt="Sonho de Padaria" class="produto-img">
                    <h3>Sonho de Padaria</h3>
                    <p class="preco">R$ 4,50</p>
                    <p class="descricao">Delicioso sonho recheado com doce de leite cremoso</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Sonho de Padaria', 4.50, this)">Adicionar ao Carrinho</button>
                </div>
                <div class="produto-card">
                    <img src="logo.png" alt="Baguete" class="produto-img">
                    <h3>Baguete</h3>
                    <p class="preco">R$ 3,00</p>
                    <p class="descricao">Baguete francesa artesanal com crosta dourada</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Baguete', 3.00, this)">Adicionar ao Carrinho</button>
                </div>
                <div class="produto-card">
                    <img src="logo.png" alt="Croissant" class="produto-img">
                    <h3>Croissant</h3>
                    <p class="preco">R$ 5,00</p>
                    <p class="descricao">Croissant folhado amanteigado, perfeito para o café da manhã</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Croissant', 5.00, this)">Adicionar ao Carrinho</button>
                </div>
                <div class="produto-card">
                    <img src="logo.png" alt="Pão de Açúcar" class="produto-img">
                    <h3>Pão de Açúcar</h3>
                    <p class="preco">R$ 2,50</p>
                    <p class="descricao">Pão doce tradicional com cobertura de açúcar cristal</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Pão de Açúcar', 2.50, this)">Adicionar ao Carrinho</button>
                </div>
                <div class="produto-card">
                    <img src="logo.png" alt="Brigadeiro" class="produto-img">
                    <h3>Brigadeiro</h3>
                    <p class="preco">R$ 3,50</p>
                    <p class="descricao">Brigadeiro gourmet com chocolate belga e granulado</p>
                    <div class="qtd-controls">
                        <button class="menos">-</button>
                        <input type="number" class="input-qtd" value="1" min="1">
                        <button class="mais">+</button>
                    </div>
                    <button class="btn-adicionar" onclick="adicionarAoCarrinho('Brigadeiro', 3.50, this)">Adicionar ao Carrinho</button>
                </div>
            </div>
        </section>
    </div>

    <div id="carrinho-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Seu Carrinho</h2>
                <span class="close" onclick="fecharCarrinho()">&times;</span>
            </div>
            <div class="modal-body">
                <div id="carrinho-items"></div>
                <div class="carrinho-total">
                    <strong>Total: R$ <span id="total-carrinho">0,00</span></strong>
                </div>
                <div class="carrinho-actions">
                    <button class="btn-limpar" onclick="limparCarrinho()">Limpar Carrinho</button>
                    <button class="btn-finalizar" onclick="finalizarPedido()">Finalizar Pedido</button>
                </div>
            </div>
        </div>
    </div>

    <div id="notificacao" class="notificacao"></div>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0; top: 0; width: 100vw; height: 100vh;
        background: rgba(0,0,0,0.25);
        align-items: center;
        justify-content: center;
    }
    .modal[style*="display: block"] {
        display: flex !important;
    }
    .modal-content {
        background: #fff;
        border-radius: 16px;
        max-width: 400px;
        margin: auto;
        padding: 32px 24px 24px 24px;
        box-shadow: 0 4px 32px rgba(0,0,0,0.18);
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    </style>
</body>
</html>

