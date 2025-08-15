// Carrinho funcional e fluido
function atualizarCarrinhoVisual() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    document.getElementById('carrinho-count').textContent = carrinho.reduce((s, item) => s + item.qtd, 0);
}
function adicionarAoCarrinho(nome, preco, btn) {
    const card = btn.closest('.produto-card');
    const qtd = parseInt(card.querySelector('.input-qtd').value) || 1;
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    const idx = carrinho.findIndex(p => p.nome === nome);
    if (idx >= 0) {
        carrinho[idx].qtd += qtd;
    } else {
        carrinho.push({ nome, preco, qtd });
    }
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    atualizarCarrinhoVisual();
    mostrarNotificacao(nome + ' adicionado ao carrinho!');
}
function mostrarNotificacao(msg) {
    const n = document.getElementById('notificacao');
    n.textContent = msg;
    n.style.display = 'block';
    setTimeout(() => { n.style.display = 'none'; }, 1800);
}
document.addEventListener('DOMContentLoaded', function() {
    atualizarCarrinhoVisual();
    document.querySelectorAll('.qtd-controls').forEach(ctrl => {
        const input = ctrl.querySelector('input');
        ctrl.querySelector('.menos').onclick = () => {
            let v = parseInt(input.value) || 1;
            if (v > 1) input.value = v - 1;
        };
        ctrl.querySelector('.mais').onclick = () => {
            let v = parseInt(input.value) || 1;
            input.value = v + 1;
        };
    });
    document.getElementById('carrinho-btn').onclick = abrirCarrinho;
});
function abrirCarrinho() {
    const modal = document.getElementById('carrinho-modal');
    const itemsDiv = document.getElementById('carrinho-items');
    const carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    let html = '';
    let total = 0;
    if (carrinho.length === 0) {
        html = '<p>Seu carrinho está vazio.</p>';
    } else {
        html = '<ul style="padding-left:0;">';
        carrinho.forEach(item => {
            html += `<li style='margin-bottom:10px;list-style:none;'>${item.nome} x${item.qtd} <span style='float:right;'>R$ ${(item.preco*item.qtd).toFixed(2)}</span></li>`;
            total += item.preco * item.qtd;
        });
        html += '</ul>';
    }
    itemsDiv.innerHTML = html;
    document.getElementById('total-carrinho').textContent = total.toFixed(2);
    modal.style.display = 'block';
}
function fecharCarrinho() {
    document.getElementById('carrinho-modal').style.display = 'none';
}
function limparCarrinho() {
    localStorage.removeItem('carrinho');
    atualizarCarrinhoVisual();
    abrirCarrinho();
}
function finalizarPedido() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    if (carrinho.length === 0) {
        mostrarNotificacao('Carrinho vazio!');
        return;
    }
    fetch('create_pedido.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ itens: carrinho })
    })
    .then(res => res.json())
    .then(data => {
        if (data.sucesso) {
            localStorage.removeItem('carrinho');
            atualizarCarrinhoVisual();
            fecharCarrinho();
            mostrarNotificacao('Pedido realizado com sucesso!');
            setTimeout(() => {
                window.location.href = 'listar_insercoes.php';
            }, 1200);
        } else {
            mostrarNotificacao('Erro ao finalizar pedido: ' + (data.erro || ''));
        }
    })
    .catch((e) => mostrarNotificacao('Erro ao conectar ao servidor!'));
}