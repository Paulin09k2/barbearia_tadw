<?php

function salvarbarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao) {
    $sql = "INSERT INTO barbeiro (nome, email, telefone, $cpf, data_nascimento, data_admissao) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}
function editarbarbeiro($conexao, $nome, $cpf, $endereco, $id) {
    $sql = "UPDATE tb_cliente SET nome=?, cpf=?, endereco=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $cpf, $endereco, $id);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;    
}
?>