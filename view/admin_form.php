<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><title>Salvar Veículo</title>
    <style>
        body { font-family: sans-serif; background: #eaeff3; padding: 40px; }
        .card { background: white; max-width: 600px; margin: auto; padding: 30px; border-top: 4px solid #004a8d; }
        .row { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
    </style>
</head>
<body id="body-form-admin">
    <div id="container-form" class="card">
        <h3 id="titulo-form"><?php echo isset($veiculo) ? 'Editar Veículo' : 'Cadastrar Novo Veículo'; ?></h3>
        <form id="form-carro" action="index.php?action=admin_form<?php echo isset($veiculo) ? '&id='.$veiculo['id'] : ''; ?>" method="POST" enctype="multipart/form-data">
            <div id="linha-marca" class="row"><label id="label-marca">Marca</label><input id="input-marca" type="text" name="marca" value="<?php echo htmlspecialchars($veiculo['marca'] ?? ''); ?>" required></div>
            <div id="linha-modelo" class="row"><label id="label-modelo">Modelo</label><input id="input-modelo" type="text" name="modelo" value="<?php echo htmlspecialchars($veiculo['modelo'] ?? ''); ?>" required></div>
            <div id="linha-ano" class="row"><label id="label-ano">Ano</label><input id="input-ano" type="number" name="year" value="<?php echo htmlspecialchars($veiculo['year'] ?? ''); ?>" required></div>
            <div id="linha-km" class="row"><label id="label-km">Kilometragem</label><input id="input-km" type="number" name="kilometragem" value="<?php echo htmlspecialchars($veiculo['kilometragem'] ?? ''); ?>" required></div>
            <div id="linha-cor" class="row"><label id="label-cor">Cor</label><input id="input-cor" type="text" name="cor" value="<?php echo htmlspecialchars($veiculo['cor'] ?? ''); ?>"></div>
            <div id="linha-motor" class="row"><label id="label-motor">Motor</label><input id="input-motor" type="number" step="0.1" name="motor" value="<?php echo htmlspecialchars($veiculo['motor'] ?? ''); ?>" required></div>
            <div id="linha-cambio" class="row"><label id="label-cambio">Câmbio</label><input id="input-cambio" type="text" name="cambio" value="<?php echo htmlspecialchars($veiculo['cambio'] ?? ''); ?>"></div>
            <div id="linha-ar" class="row">
                <label id="label-ar-checkbox"><input id="input-ar" type="checkbox" name="ar_condicionado" value="1" <?php echo (!empty($veiculo['ar_condicionado'])) ? 'checked' : ''; ?> style="width:auto;"> Ar Condicionado</label>
            </div>
            <div id="linha-valor" class="row"><label id="label-valor">Valor</label><input id="input-valor" type="number" step="0.01" name="valor" value="<?php echo htmlspecialchars($veiculo['valor'] ?? ''); ?>" required></div>
            <div id="linha-status" class="row">
                <label id="label-status">Status Operacional</label>
                <select id="select-status" name="status">
                    <option id="opcao-disponivel" value="Disponível" <?php echo (isset($veiculo) && $veiculo['status'] == 'Disponível') ? 'selected' : ''; ?>>Disponível</option>
                    <option id="opcao-vendido" value="Vendido" <?php echo (isset($veiculo) && $veiculo['status'] == 'Vendido') ? 'selected' : ''; ?>>Vendido</option>
                </select>
            </div>
            <div id="linha-visivel" class="row">
                <label id="label-visivel-checkbox"><input id="input-visivel" type="checkbox" name="visivel" value="1" <?php echo (!isset($veiculo) || $veiculo['visivel']) ? 'checked' : ''; ?> style="width:auto;"> Visível no Site Público</label>
            </div>
            <div id="linha-imagem" class="row">
                <label id="label-imagem">Foto do Carro</label>
                <input id="input-imagem" type="file" name="imagem">
            </div>
            <button id="btn-salvar-carro" type="submit" style="padding:10px 20px; background:#004a8d; color:white; border:none; font-weight:bold; cursor:pointer;">SALVAR VEÍCULO</button>
            <a id="btn-voltar-dashboard" href="index.php?action=admin_dashboard" style="margin-left:15px; color:#666;">Voltar</a>
        </form>
    </div>
</body>
</html>
