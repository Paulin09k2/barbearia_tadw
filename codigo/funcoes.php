<?php

function salvarbarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao) {
    $sql = "INSERT INTO barbeiro (nome, email, telefone, $cpf, data_nascimento, data_admissao) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}
function editarbarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id) {
    $sql = "UPDATE barbeiro SET nome=?, $email=?, telefone=?, $cpf, data_nascimento=?, data_admissao=? WHERE id_barbeiro=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;    
}
function deletarbarbeito($conexao, $id_barbeiro) {
    $sql = "DELETE FROM barbeiro WHERE id_barbeiro = ?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'i', $id_barbeiro);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}
function salvaragendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente) {
    $sql = "INSERT INTO agendamento (data_agendamento, status, barbeiro_id_barbeiro, cliente_id_cliente) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente);
    
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}
?>