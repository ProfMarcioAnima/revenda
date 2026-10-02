<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #eaeff3; }
        header { background: #004a8d; color: #fff; padding: 15px 20px; border-bottom: 4px solid #ffcc00; }
        .container { max-width: 1000px; margin: 30px auto; background: #fff; border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; overflow: hidden; border-top: 4px solid #004a8d; }
        .display-img { width: 50%; background: #f8f9fa; position: relative; }
        .display-img img { width: 100%; height: 100%; object-fit: cover; }
        .tarja { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,204,0,0.85); color: #004a8d; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 24px; }
        .info-panel { width: 50%; padding: 30px; display: flex; flex-direction: column; }
        .info-panel h2 { margin: 0 0 10px 0; color: #333; }
        .price { font-size: 28px; font-weight: bold; color: #004a8d; margin-bottom: 20px; }
        .specs-list { list-style: none; padding: 0; margin: 0 0 30px 0; }
        .specs-list li { padding: 10px 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; font-size: 14px; }
        .specs-list span { font-weight: bold; color: #555; }
        .btn-buy { background: #ffcc00; color: #004a8d; border: none; padding: 15px; border-radius: 4px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none; cursor: pointer; transition: background 0.2s; text-transform: uppercase; }
        .btn-buy:hover { background: #e6b800; }
        .back-link { margin-top: 15px; text-align: center; color: #666; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body id="body-detalhes">
    <header id="header-detalhes"><h1 id="titulo-header-detalhes">Super Veículos</h1></header>
    <div id="container-detalhes" class="container">
        <div id="bloco-imagem-detalhes" class="display-img">
            <img id="img-detalhe-<?php echo $veiculo['id']; ?>" src="uploads/<?php echo $veiculo['imagem']; ?>">
            <?php if($veiculo['status'] == 'Vendido'): ?>
                <div id="tarja-vendido-detalhe-<?php echo $veiculo['id']; ?>" class="tarja">Vendido</div>
            <?php endif; ?>
        </div>
        <div id="bloco-info-detalhes" class="info-panel">
            <h2 id="titulo-veiculo-detalhes"><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></h2>
            <div id="preco-veiculo-detalhes" class="price">R$ <?php echo number_format($veiculo['valor'], 2, ',', '.'); ?></div>
            <ul id="lista-especificacoes" class="specs-list">
                <li id="spec-ano">Ano: <span id="val-ano"><?php echo $veiculo['year']; ?></span></li>
                <li id="spec-km">Quilometragem: <span id="val-km"><?php echo number_format($veiculo['kilometragem'], 0, ',', '.'); ?> KM</span></li>
                <li id="spec-cor">Cor: <span id="val-cor"><?php echo htmlspecialchars($veiculo['cor']); ?></span></li>
                <li id="spec-motor">Motorização: <span id="val-motor"><?php echo number_format($veiculo['motor'], 1); ?></span></li>
                <li id="spec-cambio">Transmissão: <span id="val-cambio"><?php echo htmlspecialchars($veiculo['cambio']); ?></span></li>
                <li id="spec-ar">Ar Condicionado: <span id="val-ar"><?php echo $veiculo['ar_condicionado'] ? 'Sim' : 'Não'; ?></span></li>
            </ul>
            <?php if($veiculo['status'] == 'Disponível'): ?>
                <a id="comprar-<?php echo $veiculo['id']; ?>" href="index.php?action=carrinho&add=<?php echo $veiculo['id']; ?>" class="btn-buy">Comprar Veículo</a>
            <?php endif; ?>
            <a id="voltar-catalogo" href="index.php" class="back-link">Voltar para a listagem</a>
        </div>
    </div>
</body>
</html>
