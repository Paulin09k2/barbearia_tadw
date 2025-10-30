<?php
require_once "./conexao.php";
require_once "./funcoes.php";
session_start();

$idusuario = $_SESSION['idusuario']??null;

// Se não vier um ID via GET, usa o ID da sessão
$id = isset($_GET['id']) ? $_GET['id'] : $idusuario;

// Busca os dados do cliente e do usuário
$barbeiro = pesquisarBarbeiroId($conexao, $id);
$usuario = pesquisarUsuarioId($conexao, $id);

// Se encontrar o cliente, preenche os campos para edição
if ($barbeiro && $usuario) {
    $id = $barbeiro['id_barbeiro'];
    $idusuario = $usuario['idusuario'];
    $nome = $barbeiro['nome'];
    $email = $usuario['email'];
    $telefone = $barbeiro['telefone'];
    $cpf = $barbeiro['cpf'];
    $data_nascimento = $barbeiro['data_nascimento'];
    $data_admissao = $barbeiro['data_admissao'];
    $senha_cliente = ""; // nunca exibir senha real
    $botao = "Editar";
} else {
    // Caso seja cadastro novo
    $id = 0;
    $nome = "";
    $email = "";
    $telefone = "";
    $cpf = "";
    $data_nascimento = "";
    $data_admissao = date('Y-m-d');
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
    <title><?php echo $botao?></title>
</head>

<body>
    <h1><?php echo $botao ?> Barbeiro</h1>
    <form action="salvarBarbeiro.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required> <br><br>

        Email: <br>
        <input type="email" name="email" value="<?php echo $email; ?>" required> <br><br>

        Telefone: <br>
        <input type="text" name="telefone" value="<?php echo $telefone; ?>" required> <br><br>

        Cpf: -- <br>
        <input type="text" name="cpf" value="<?php echo $cpf; ?>" maxlength="11" required> <br><br>

        Data de Nascimento: <br>
        <input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>" required max="<?= date('Y-m-d') ?>"> <br><br>

        Data de Admissao: <br>
        <input type="date" name="data" value="<?php echo $data_admissao; ?>" required ><br><br>

        Senha: <br>
        <input type="password" name="senha" value="" required> <br><br>

        <input type="submit" value="<?php echo $botao; ?>">
    </form>
</body>

</html>