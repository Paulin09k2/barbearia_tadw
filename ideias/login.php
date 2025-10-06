<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="logo.png">
</head>

<body>
    <h1>Login</h1>

    <form action="verificarLogin.php" method="post">
        E-mail: <br>
        <input type="email" name="email" required> <br><br>
        Senha: <br>
        <input type="password" name="senha" required> <br><br>

        <a href="formCliente.php">Primeiro acesso</a> <br><br>
        <input type="submit" value="Acessar">
        <br><br>
        <a href="index.php">Sair</a>
    </form>

    <?php
    require_once "../tests/conexao.php";
    require_once "../tests/funcoes.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $idusuario = verificarLogin($conexao, $email, $senha);

        if ($idusuario === false) {
            // Login inválido, retorna para login
            header("Location: login.php");
            exit;
        } else {
            // Login válido, busca dados do cliente
            session_start();
            $_SESSION['id_cliente'] = $idusuario;
            header("Location: index.php");
            exit;
        }
    }
    ?>
</body>

</html>