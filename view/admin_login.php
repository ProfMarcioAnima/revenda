<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><title>Acesso Restrito</title>
    <style>
        body { font-family: sans-serif; background: #e9ecef; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; width: 320px; border-top: 5px solid #004a8d; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        input, button { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #004a8d; color: white; font-weight: bold; border: none; cursor: pointer; }
    </style>
</head>
<body id="body-login">
    <div id="container-login" class="card">
        <h3 id="titulo-login" style="margin-top:0; color:#004a8d; text-align:center;">Painel Administrativo</h3>
        <?php if(isset($erro)) echo "<p id='msg-erro-login' style='color:red; font-size:13px;'>$erro</p>"; ?>
        <form id="form-login" action="index.php?action=login" method="POST">
            <input id="input-usuario" type="text" name="usuario" required autofocus>
            <input id="input-senha" type="password" name="senha" required>
            <button id="btn-entrar" type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>
