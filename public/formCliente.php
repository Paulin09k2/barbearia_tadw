<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

$idusuario = $_SESSION['idusuario'] ?? null;

// Se não vier um ID via GET, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca os dados do cliente e do usuário
$usuario = pesquisarUsuarioId($conexao, $id);
$cliente = pesquisarClienteId($conexao, $id);
// var_dump($usuario);
// Se encontrar o cliente, preenche os campos para edição
if ($cliente && $usuario) {
    $id = $cliente['id_cliente'];
    $idusuario = $usuario['idusuario'];
    $nome = $cliente['nome'];
    $email = $usuario['email'];
    $telefone = $cliente['telefone'];
    $endereco = $cliente['endereco'];
    $data_nascimento = $cliente['data_nascimento'];
    $data_cadastro = $cliente['data_cadastro'];
    $senha_cliente = ""; // nunca exibir senha real
    $botao = "Editar";
} else {
    // Caso seja cadastro novo
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $endereco = "";
    $data_nascimento = "";
    $data_cadastro = date('Y-m-d');
    $senha_cliente = "";
    $botao = "Cadastrar";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo2.png">
    <title><?php echo $botao ?></title>
</head>

<body>
    <h1><?php echo $botao ?> Cliente</h1>
    <form action="salvarCliente.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
        <input type="hidden" name="">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required> <br><br>

        Email: <br>
        <input type="email" name="email" value="<?php echo $email; ?>" required> <br><br>

        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>" required> <br><br>

        Endereço: <br>
        <input type="text" name="endereco" value="<?php echo $endereco; ?>" required> <br><br>

        Data de Nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>"> <br><br>

        <input type="hidden" name="data_cadastro" value="<?php echo $data_cadastro; ?>" required min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">

        Senha: <br>
        <input type="password" name="senha_cliente" value="" required> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>

</html>