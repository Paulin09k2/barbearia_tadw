<?php
<<<<<<< HEAD
    require_once "conexao.php";
    require_once "funcoes.php";

    $nome = "paulo";
    $cpf = "321.456.235-11";
    $endereco = "Rua 1";
    $email = "iyg@gmail.com";
    $telefone = "1234567890";
    $data_nascimento = "1990-01-01";
    $data_cadastro = "1999-06-01";
    $senha_cliente = "senha123"; // Adicionando a senha do cliente

    salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);

    $resultado = salvarCliente($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha);

if ($resultado) {
    echo "Barbeiro salvo com sucesso!";
} else {
    echo "Erro ao salvar barbeiro.";
}
?>
?>
=======
require_once "conexao.php";      
require_once "../funcoes.php";   


$nome = "Kaio";
$email = "kaio@email.com";
$telefone = "87999998888";
$endereco = "Rua 1, Bairro Central";
$data_nascimento = "2000-08-15";
$data_cadastro = "8900-06-17";


salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
?>
>>>>>>> 65d4d3f12220b8438005b5daf57450df89f33ce6
