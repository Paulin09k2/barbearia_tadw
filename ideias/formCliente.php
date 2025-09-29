<?php
    if (isset($_GET['id'])) {
        require_once "../tests/conexao.php";
        require_once "../tests/funcoes.php";

        $id = $_GET['id'];
        $cliente = pesquisarClienteId($conexao, $id);

        $nome = $cliente['nome'];
        $email = $cliente['email'];
        $telefone = $cliente['telefone'];
        $endereco = $cliente['endereco'];
        $cpf = $cliente['cpf'];
        $data_nascimento = $cliente['data_nascimento'];
        $data_cadastro = $cliente['data_cadastro'];
        $senha_cliente = $cliente['senha_cliente'];

        $botao = "Atualizar";
    }
    else {
        $id = 0;
        $nome = "";
        $email = "";
        $telefone = "";
        $endereco = "";
        $cpf = "";
        $data_nascimento = "";
        $data_cadastro = "";
        $senha_cliente = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="login" href="logo2.png">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">

        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required> <br><br>

        Email: <br>
        <input type="email" name="email" value="<?php echo $email; ?>" required> <br><br>
        
        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>" required> <br><br>

        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>" required> <br><br>

        CPF: <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>" required pattern="\d{11}" maxlength="11" title="Digite apenas números, 11 dígitos"> <br><br>

        Data de Nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>"> <br><br>

        
        Data de Cadastro: <br>
        <input type="date" id="data" name="data" required min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>"> <br><br>

        Senha: <br>
        <input type="password" name="senha_cliente" value="<?php echo $senha_cliente; ?>" required> <br><br>


        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>
</html>