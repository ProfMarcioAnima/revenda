<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Super Veículos</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; margin: 0; background: #eaeff3; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #004a8d; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid #ffcc00; }
        header h1 { margin: 0; font-size: 24px; color: #ffcc00; }
        header a { color: #fff; text-decoration: none; font-weight: bold; }
        .container { display: flex; flex: 1; width: 100%; max-width: 1400px; margin: 20px auto; gap: 20px; padding: 0 20px; }
        .sidebar { width: 280px; background: #fff; padding: 20px; border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); height: fit-content; }
        .sidebar h3 { margin-top: 0; border-bottom: 2px solid #004a8d; padding-bottom: 8px; color: #004a8d; }
        .filter-group { margin-bottom: 15px; }
        .filter-group label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; color: #555; }
        .filter-group select, .filter-group input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .main-content { flex: 1; }
        .search-box { width: 100%; padding: 15px; border: 2px solid #004a8d; border-radius: 4px; font-size: 16px; margin-bottom: 20px; outline: none; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .card { background: #fff; border-radius: 4px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #e1e8ed; position: relative; display: flex; flex-direction: column; text-decoration: none; color: inherit; transition: transform 0.2s; }
        .card:hover { transform: translateY(-3px); }
        .img-container { width: 100%; height: 180px; background: #f8f9fa; position: relative; }
        .img-container img { width: 100%; height: 100%; object-fit: cover; }
        .tarja-vendido { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 204, 0, 0.85); color: #004a8d; display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .card-body { padding: 15px; flex: 1; display: flex; flex-direction: column; }
        .card-body h4 { margin: 0 0 10px 0; font-size: 16px; color: #333; }
        .card-info { font-size: 12px; color: #777; margin-bottom: 15px; }
        .card-price { font-size: 20px; font-weight: bold; color: #004a8d; margin-top: auto; }
        footer { background: #2c3e50; color: #fff; padding: 20px; text-align: center; font-size: 13px; margin-top: auto; border-top: 4px solid #ffcc00; }
        footer a { color: #ffcc00; text-decoration: none; margin-left: 10px; }
        .btn-clear { display: block; text-align: center; padding: 10px; background: #e0e0e0; color: #333; text-decoration: none; border-radius: 4px; margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body id="body-catalogo">
    <header id="header-catalogo">
        <h1 id="titulo-header">Super Veículos</h1>
        <a id="link-carrinho" href="index.php?action=carrinho">Carrinho (<?php echo count($_SESSION['carrinho'] ?? []); ?>)</a>
    </header>
    <div id="container-principal" class="container">
        <div id="container-sidebar" class="sidebar">
            <h3 id="titulo-filtros">Filtros Refinados</h3>
            <form id="filterForm" method="GET" action="index.php">
                <input type="hidden" name="busca" id="hiddenBusca" value="<?php echo htmlspecialchars($busca); ?>">
                <div id="grupo-ordem" class="filter-group">
                    <label id="label-ordem">Ordenar por</label>
                    <select id="filtro-ordem" name="ordem" onchange="document.getElementById('filterForm').submit()">
                        <option id="ordem-menor" value="menor" <?php echo $filtros['ordem'] == 'menor' ? 'selected' : ''; ?>>Menor Valor</option>
                        <option id="ordem-maior" value="maior" <?php echo $filtros['ordem'] == 'maior' ? 'selected' : ''; ?>>Maior Valor</option>
                    </select>
                </div>
                <div id="grupo-filtro-valor" class="filter-group">
                    <label id="label-valor-max">Valor Máximo (R$)</label>
                    <input type="number" id="filtro-valor-max" name="valor_max" value="<?php echo htmlspecialchars($filtros['valor_max']); ?>" onchange="document.getElementById('filterForm').submit()" placeholder="Ex: 80000">
                </div>
                <div id="grupo-filtro-ano" class="filter-group">
                    <label id="label-ano">Ano</label>
                    <select id="filtro-ano" name="year" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Todos</option>
                        <?php foreach($opcoes['anos'] as $ano): ?>
                            <option id="opcao-ano-<?php echo $ano; ?>" value="<?php echo $ano; ?>" <?php echo $filtros['year'] == $ano ? 'selected' : ''; ?>><?php echo $ano; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="grupo-filtro-km" class="filter-group">
                    <label id="label-km">KM Máxima</label>
                    <input type="number" id="filtro-km" name="km_max" value="<?php echo htmlspecialchars($filtros['km_max']); ?>" onchange="document.getElementById('filterForm').submit()">
                </div>
                <div id="grupo-filtro-cor" class="filter-group">
                    <label id="label-cor">Cor</label>
                    <select id="filtro-cor" name="cor" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Todas</option>
                        <?php foreach($opcoes['cores'] as $cor): ?>
                            <option id="opcao-cor-<?php echo htmlspecialchars($cor); ?>" value="<?php echo htmlspecialchars($cor); ?>" <?php echo $filtros['cor'] == $cor ? 'selected' : ''; ?>><?php echo $cor; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="grupo-filtro-motor" class="filter-group">
                    <label id="label-motor">Motor</label>
                    <select id="filtro-motor" name="motor" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Todos</option>
                        <?php foreach($opcoes['motores'] as $motor): ?>
                            <option id="opcao-motor-<?php echo str_replace('.', '_', $motor); ?>" value="<?php echo $motor; ?>" <?php echo $filtros['motor'] == $motor ? 'selected' : ''; ?>><?php echo number_format($motor, 1); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="grupo-filtro-cambio" class="filter-group">
                    <label id="label-cambio">Câmbio</label>
                    <select id="filtro-cambio" name="cambio" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Todos</option>
                        <?php foreach($opcoes['cambios'] as $cambio): ?>
                            <option id="opcao-cambio-<?php echo htmlspecialchars($cambio); ?>" value="<?php echo htmlspecialchars($cambio); ?>" <?php echo $filtros['cambio'] == $cambio ? 'selected' : ''; ?>><?php echo $cambio; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="grupo-filtro-ar" class="filter-group">
                    <label id="label-ar">Ar Condicionado</label>
                    <select id="filtro-ar" name="ar" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Todos</option>
                        <option id="opcao-ar-sim" value="1" <?php echo $filtros['ar'] === '1' ? 'selected' : ''; ?>>Com Ar</option>
                        <option id="opcao-ar-nao" value="0" <?php echo $filtros['ar'] === '0' ? 'selected' : ''; ?>>Sem Ar</option>
                    </select>
                </div>
                <a href="index.php" id="btn-limpar-filtros" class="btn-clear">Limpar Filtros</a>
            </form>
        </div>
        <div id="container-conteudo" class="main-content">
            <input type="text" id="mainSearch" class="search-box" placeholder="(busca pelo veículo)" value="<?php echo htmlspecialchars($busca); ?>">
            <div id="grid-veiculos" class="grid">
                <?php foreach($lista as $carro): ?>
                    <a id="detalhe-<?php echo $carro['id']; ?>" href="index.php?action=detalhes&id=<?php echo $carro['id']; ?>" class="card">
                        <div id="container-img-<?php echo $carro['id']; ?>" class="img-container">
                            <img id="img-carro-<?php echo $carro['id']; ?>" src="uploads/<?php echo $carro['imagem']; ?>" alt="Carro">
                            <?php if($carro['status'] == 'Vendido'): ?>
                                <div id="tarja-vendido-<?php echo $carro['id']; ?>" class="tarja-vendido">Vendido</div>
                            <?php endif; ?>
                        </div>
                        <div id="corpo-card-<?php echo $carro['id']; ?>" class="card-body">
                            <h4 id="titulo-carro-<?php echo $carro['id']; ?>"><?php echo htmlspecialchars($carro['marca'] . ' ' . $carro['modelo']); ?></h4>
                            <div id="info-carro-<?php echo $carro['id']; ?>" class="card-info">
                                <?php echo $carro['year']; ?> • <?php echo number_format($carro['kilometragem'], 0, ',', '.'); ?> KM • <?php echo htmlspecialchars($carro['cambio']); ?>
                            </div>
                            <div id="preco-carro-<?php echo $carro['id']; ?>" class="card-price">R$ <?php echo number_format($carro['valor'], 2, ',', '.'); ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer id="footer-catalogo">
        &copy; <?php echo date('Y'); ?> Super Veículos | <a id="link-admin" href="index.php?action=login">Painel Administrativo</a>
    </footer>
    <script>
        let searchTimer;
        document.getElementById('mainSearch').addEventListener('input', function(e) {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                document.getElementById('hiddenBusca').value = e.target.value;
                document.getElementById('filterForm').submit();
            }, 500);
        });
    </script>
</body>
</html>
