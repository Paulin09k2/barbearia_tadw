<?php
    require_once "../conexao.php";
    require_once "../funcoes.php";

    $nome = "Fulano";
    $cpf = "321.456.234-11";
    $telefone = "(11) 91234-5678";
    $email = "fulano@example.com";
    $data_nascimento = "1990-01-01";
    $data_cadastro = "2023-10-01";
    $senha_cliente = "senha123";
    $endereco = "Rua 1";

<<<<<<< HEAD
    salvarCliente($conexao, $nome, $cpf, $endereco, $telefone, $email, $data_nascimento, $data_cadastro, $senha_cliente);
=======
    salvarCliente($conexao,$nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);
>>>>>>> 482088502678d101ae870a7e6e0c25727af45d03
?>