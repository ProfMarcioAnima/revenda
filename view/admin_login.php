<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <style>
        body { font-family: sans-serif; background: #eaeff3; padding: 40px; }
        .card { background: white; max-width: 400px; margin: auto; padding: 30px; border-top: 4px solid #004a8d; }
        .row { margin-bottom: 15px; }
        label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .erro { color: #d9534f; background: #fdf2f2; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 13px; font-weight: bold; text-align: center; }
    </style>
</head>
<body id="body-login">
    <?php if (isset($_GET['deslogado'])): ?>
        <script>
            alert("Você foi desconectado com sucesso.");
        </script>
    <?php endif; ?>
    <div id="container-login" class="card">
        <h3 id="titulo-login">Acesso ao Sistema</h3>
        <?php if (isset($_GET['erro'])): ?>
            <div id="msg-erro" class="erro">Usuário ou senha incorretos.</div>
        <?php endif; ?>
        <form id="form-login" action="index.php?action=login" method="POST">
            <div id="linha-usuario" class="row">
                <label id="label-usuario">Usuário</label>
                <input id="input-usuario" type="text" name="usuario" required>
            </div>
            <div id="linha-senha" class="row">
                <label id="label-senha">Senha</label>
                <input id="input-senha" type="password" name="senha" required>
            </div>
            <button id="btn-entrar" type="submit" style="padding:10px 20px; background:#004a8d; color:white; border:none; font-weight:bold; cursor:pointer; width:100%;">ENTRAR</button>
        </form>
    </div>
</body>
</html>