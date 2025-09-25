<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="login" href="logo.png">
</head>
<body>
    <h1>Login</h1>

    <form action="verificarLogin.php" method="post">
        E-mail: <br>
        <input type="text" name="email"> <br><br>
        Senha: <br>
        <input type="text" name="senha"> <br><br>

        <a href="formCliente.php">Primeiro acesso</a> <br><br>
        <input type="submit" value="Acessar">

       <br><br> <button> <a href="index.php">Sair</a> </button> <br><br>
    </form>
</body>
</html>