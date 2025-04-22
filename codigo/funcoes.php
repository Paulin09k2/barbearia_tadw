<?php

function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro) {
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}
?>