<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #eaeff3; margin: 0; padding: 40px; }
        .card { background: white; max-width: 800px; margin: auto; padding: 25px; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-top: 4px solid #004a8d; }
        h2 { margin-top: 0; color: #004a8d; }
        .item { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #eee; }
        .item-details { display: flex; align-items: center; gap: 15px; }
        .item-details img { width: 80px; height: 60px; object-fit: cover; border-radius: 4px; }
        .btn-remove { color: #d9534f; text-decoration: none; font-size: 14px; }
        .total-box { margin-top: 20px; display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; }
        .actions { margin-top: 30px; display: flex; justify-content: space-between; }
        .btn { padding: 12px 20px; border-radius: 4px; text-decoration: none; font-weight: bold; }
        .btn-back { background: #6c757d; color: white; }
        .btn-checkout { background: #ffcc00; color: #004a8d; }
    </style>
</head>
<body id="body-carrinho">
    <div id="container-carrinho" class="card">
        <h2 id="titulo-carrinho">Carrinho de Compras</h2>
        <?php if(empty($itens)): ?>
            <p id="msg-carrinho-vazio">Seu carrinho está vazio.</p>
        <?php else: ?>
            <div id="lista-itens-carrinho">
            <?php $total = 0; foreach($itens as $i): $total += $i['valor']; ?>
                <div id="item-carrinho-<?php echo $i['id']; ?>" class="item">
                    <div id="detalhes-item-<?php echo $i['id']; ?>" class="item-details">
                        <img id="img-item-<?php echo $i['id']; ?>" src="uploads/<?php echo $i['imagem']; ?>">
                        <div id="texto-item-<?php echo $i['id']; ?>">
                            <strong id="nome-item-<?php echo $i['id']; ?>"><?php echo htmlspecialchars($i['marca'] . ' ' . $i['modelo']); ?></strong><br>
                            <span id="ano-item-<?php echo $i['id']; ?>" style="font-size:13px; color:#666;"><?php echo $i['year']; ?></span>
                        </div>
                    </div>
                    <div id="acoes-item-<?php echo $i['id']; ?>">
                        <span id="preco-item-<?php echo $i['id']; ?>" style="font-weight:bold; margin-right:15px;">R$ <?php echo number_format($i['valor'], 2, ',', '.'); ?></span>
                        <a id="remover-<?php echo $i['id']; ?>" href="index.php?action=carrinho&remove=<?php echo $i['id']; ?>" class="btn-remove">Remover</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div id="caixa-total-carrinho" class="total-box">
                <span id="label-total">Total do Pedido:</span>
                <span id="valor-total" style="color:#004a8d;">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
            </div>
        <?php endif; ?>
        <div id="botoes-acao-carrinho" class="actions">
            <a id="continuar-comprando" href="index.php" class="btn btn-back">Continuar Comprando</a>
            <?php if(!empty($itens)): ?>
                <a id="finalizar-compra" href="#" class="btn btn-checkout">Finalizar Compra</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
