<!DOCTYPE html>
<html>
<head>
    <style>
        input, button {
            display: block;
        }
    </style>
</head>
<body>
    <form method="post" action="{{ route('logar') }}">
        <input type="text" id="login" name="txtLogin"/>
        <input type="password" id="senha" name="txtSenha"/>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
