<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$data_cadastro = $_POST['data']; // campo "data" do formulário
$senha_cliente = $_POST['senha_cliente'];

if ($id == 0) {
    // Cadastro novo
    $senha_hash = password_hash($senha_cliente, PASSWORD_DEFAULT);
    salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_hash);
} else {
    // Atualização
    $senha_hash = password_hash($senha_cliente, PASSWORD_DEFAULT);
    editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $senha_hash, $id);
}

header("Location: index.php");
exit;
?>