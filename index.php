<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pãodango - Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
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
                <!-- Exemplo de produto, substitua por loop PHP futuramente -->
                <div style="background:#fff8ec; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:18px; text-align:center;">
                    <img src="logo.png" alt="Pão Francês" style="width:80px; margin-bottom:12px;">
                    <h3 style="color:#4e3c1e;">Pão Francês</h3>
                    <p style="color:#7a5c2e; font-size:1.1rem;">R$ 0,80 unidade</p>
                    <button class="btn-cadastro">Adicionar ao Carrinho</button>
                </div>
                <div style="background:#fff8ec; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:18px; text-align:center;">
                    <img src="logo.png" alt="Sonho de Padaria" style="width:80px; margin-bottom:12px;">
                    <h3 style="color:#4e3c1e;">Sonho de Padaria</h3>
                    <p style="color:#7a5c2e; font-size:1.1rem;">R$ 4,50 unidade</p>
                    <button class="btn-cadastro">Adicionar ao Carrinho</button>
                </div>
                <div style="background:#fff8ec; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.06); padding:18px; text-align:center;">
                    <img src="logo.png" alt="Baguete" style="width:80px; margin-bottom:12px;">
                    <h3 style="color:#4e3c1e;">Baguete</h3>
                    <p style="color:#7a5c2e; font-size:1.1rem;">R$ 3,00 unidade</p>
                    <button class="btn-cadastro">Adicionar ao Carrinho</button>
                </div>
                <!-- Adicione mais produtos conforme necessário -->
            </div>
        </section>
        <!-- Espaço para carrinho e login futuramente -->
    </div>
</body>
</html>
