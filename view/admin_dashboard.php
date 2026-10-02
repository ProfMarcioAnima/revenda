<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><title>Controle de Estoque</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #eaeff3; margin: 0; padding: 25px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 15px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; }
        .btn-add { background: #27ae60; color: white; }
        .btn-logout { background: #d9534f; color: white; }
        table { width: 100%; background: white; border-collapse: collapse; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #004a8d; color: white; }
        .badge { padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: bold; }
        .badge-vis { background: #e3faf2; color: #27ae60; }
        .badge-ocu { background: #fff0f0; color: #d9534f; }
    </style>
</head>
<body id="body-dashboard">
    <div id="header-dashboard" class="header">
        <h2 id="titulo-dashboard">Gerenciamento de Veículos - Senac</h2>
        <div id="acoes-dashboard">
            <a id="btn-novo-carro" href="index.php?action=admin_form" class="btn btn-add">+ Cadastrar Carro</a>
            <a id="btn-sair" href="index.php?action=logout" class="btn btn-logout">Sair</a>
        </div>
    </div>
    <table id="tabela-veiculos">
        <thead id="cabecalho-tabela">
            <tr id="linha-cabecalho">
                <th id="th-foto">Foto</th>
                <th id="th-marca">Marca/Modelo</th>
                <th id="th-ano">Ano</th>
                <th id="th-valor">Valor</th>
                <th id="th-visibilidade">Visibilidade</th>
                <th id="th-status">Status</th>
                <th id="th-acoes">Ações</th>
            </tr>
        </thead>
        <tbody id="corpo-tabela">
            <?php foreach($lista as $c): ?>
            <tr id="linha-carro-<?php echo $c['id']; ?>">
                <td id="td-foto-<?php echo $c['id']; ?>"><img id="img-lista-<?php echo $c['id']; ?>" src="uploads/<?php echo $c['imagem']; ?>" width="60" height="45" style="object-fit:cover;"></td>
                <td id="td-marca-<?php echo $c['id']; ?>"><strong id="nome-lista-<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['marca'] . ' ' . $c['modelo']); ?></strong></td>
                <td id="td-ano-<?php echo $c['id']; ?>"><?php echo $c['year']; ?></td>
                <td id="td-valor-<?php echo $c['id']; ?>">R$ <?php echo number_format($c['valor'], 2, ',', '.'); ?></td>
                <td id="td-visibilidade-<?php echo $c['id']; ?>">
                    <span id="badge-visibilidade-<?php echo $c['id']; ?>" class="badge <?php echo $c['visivel'] ? 'badge-vis' : 'badge-ocu'; ?>">
                        <?php echo $c['visivel'] ? 'Visível' : 'Oculto'; ?>
                    </span>
                </td>
                <td id="td-status-<?php echo $c['id']; ?>"><strong id="status-lista-<?php echo $c['id']; ?>"><?php echo $c['status']; ?></strong></td>
                <td id="td-acoes-<?php echo $c['id']; ?>">
                    <a id="editar-<?php echo $c['id']; ?>" href="index.php?action=admin_form&id=<?php echo $c['id']; ?>" style="color:#004a8d; margin-right:10px;">Editar</a>
                    <a id="excluir-<?php echo $c['id']; ?>" href="index.php?action=admin_excluir&id=<?php echo $c['id']; ?>" style="color:#d9534f;">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p id="paragrafo-voltar"><a id="link-voltar-site" href="index.php">Ir para o Site Público</a></p>
</body>
</html>
