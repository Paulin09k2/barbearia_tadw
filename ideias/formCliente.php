<?php
    if (isset($_GET['id'])) {
        // echo "editar";

        require_once "../conexao.php";
        require_once "../funcoes.php";

        $id = $_GET['id'];
        
        $cliente = pesquisarClienteId($conexao, $id);
        $nome = $cliente['nome'];
        $email = $cliente['cpf'];
        $telefone = $cliente['endereco'];
        $endereco = $cliente['endereco'];
        $data_nascimento = $cliente['data_nascimento'];
        $data_cadastro = $cliente['data_cadastro'];
        $senha_cliente = $cliente['senha_cliente'];



        $botao = "Atualizar";
    }
    else {
        // echo "novo";
        $id = 0;
        $nome = "";
        $cpf = "";
        $endereco = "";

        $botao = "Cadastrar";
    }
?>
<!DOCTYPE html>
<html lang="en">
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
        <input type="email" name="email" value="<?php echo isset($cliente['email']) ? $cliente['email'] : ''; ?>" required> <br><br>
        
        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo isset($cliente['telefone']) ? $cliente['telefone'] : ''; ?>" required> <br><br>

        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>" required> <br><br>
        
         CPF: <br>
        <input type="text" name="cpf" value="<?php echo isset($cliente['cpf']) ? $cliente['cpf'] : ''; ?>" required pattern="\d{11}" maxlength="11" title="Digite apenas números, 11 dígitos"> <br><br>

        Data de Nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo isset($cliente['data_nascimento']) ? $cliente['data_nascimento'] : ''; ?>"> <br><br>
        Data de Cadastro: <br>
        <input type="date" name="data_cadastro" value="<?php echo isset($cliente['data_cadastro']) ? $cliente['data_cadastro']  : ''; ?>"> <br><br>

        <br>Senha: <br>
        <input type="password" name="senha_cliente" value="<?php echo isset($cliente['senha_cliente']) ? $cliente['senha_cliente'] : ''; ?>" required> <br><br>
        <input type="submit" value="<?php echo $botao; ?>">
</body>
</html>