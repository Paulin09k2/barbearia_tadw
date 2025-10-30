<?php
require_once "./conexao.php";
require_once "./funcoes.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$data_nascimento = $_POST['data_nascimento'];
$data_cadastro = $_POST['data_cadastro'];
$senha_cliente = $_POST['senha_cliente'];
$idusuario = $_POST['idusuario'];
if ($id == 0) {
    // Cadastro novo
    $usuario = salvarUsuario($conexao, $email, $senha_cliente, '1');
    
    if ($usuario === null) {
        echo "<script>alert('Erro ao salvar usuário.');</script>";
    } else {
        $idusuario = $usuario;
        salvarCliente(
            $conexao,
            $nome,
            $telefone,
            $endereco,
            $data_nascimento,
            $data_cadastro,
            $idusuario
        );
    }
    header("Location: index.php");
} else {
    // Atualização
    $usuario = editarUsuario($conexao, $email, $senha_cliente, 1, $idusuario);
    editarCliente(
    $conexao,
    $nome,
    $telefone,
    $endereco,
    $data_nascimento,
    $idusuario
);
    header("Location: ./cliente/index.php");
}

exit;
