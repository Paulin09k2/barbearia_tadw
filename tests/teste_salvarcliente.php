<?php
require_once "conexao.php";
require_once "funcoes.php";

    $nome = "ulo";
    $cpf = "321.450.235-11";
    $endereco = "Rua 1";
    $email = "ipo@gmail.com";
    $telefone = "1234567890";
    $data_nascimento = "1990-01-01";
    $data_cadastro = "1999-06-01";
    $senha_cliente = "senha123"; // Adicionando a senha do cliente

    salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);


?>
