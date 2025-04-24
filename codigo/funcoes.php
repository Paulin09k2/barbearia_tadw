<?php
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------Kaio:
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
function editaragendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento) {
    $sql = "UPDATE agendamento SET data_agendamento=?, status=?, barbeiro_id_barbeiro=?, cliente_id_cliente=? WHERE id_agendamento=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssi', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
}
function deletaragendamento($conexao, $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente) {
    $sql = "DELETE FROM agendamento WHERE id_agendamento = ? AND barbeiro_id_barbeiro = ? AND cliente_id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'iii', $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
} 
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------Paulo Ricardo:

function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro) {
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
    
    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
}



function editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $id) {
    $sql = "UPDATE cliente SET nome=?, email=?, telefone=?, endereco=?, data_nascimento=?, data_cadastro=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $id);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;    
}



function deletarCliente($conexao, $id_cliente) {
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'i', $id_cliente);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou;
}

function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico) {
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

}

function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id) {
    $sql = "UPDATE cliente SET nome=?, email=?, telefone=?, endereco=?, data_nascimento=?, data_cadastro=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssi', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $id);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;    
}
 
function deletarAvaliacao($conexao, $idavaliacao) {
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
 

}
#Funções André

function listarCliente($conexao) {
    $sql = "SELECT * FROM tb_cliente";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_clientes = [];
    while ($cliente = mysqli_fetch_assoc($resultados)) {
        $lista_clientes[] = $cliente;
    }
    mysqli_stmt_close($comando);

    return $lista_clientes; }

function listarBarbeiro($conexao) {
    $sql = "SELECT * FROM tb_barbeiro"
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_barbeiro
    while ($barbeiro_fetch_assoc($resultados)) {
        $lista_barbeiro[] = $barbeiro
    }
    mysqli_stmt_close($comando);

    return $lista_barbeiro;}

function salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado) {
    $sql = "INSERT INTO cliente (nome_servico, descricao, preco, tempo_estimado) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'issdi', $nome_servico, $descricao, $preco, $tempo_estimado);
    
    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    }

function editarServico($conexao,$nome_servico, $descricao, $preco, $tempo_estimado) {
    $sql = "UPDATE cliente SET nome_servico=?, descricao=?, preco=?, tempo_estimado=? WHERE idservico=?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'issdi', $nome_servico, $descricao, $preco, $tempo_estimado );
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
 }

function deletarServico($conexao, $id_servico) {
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'i', $id_servico);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $funcionou; }

function listaServico($conexao) {
    $sql = "SELECT * FROM tb_servico";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_servico = [];
    while ($servico = mysqli_fetch_assoc($resultados)) {
        $lista_servico[] = $servico;
    }
    mysqli_stmt_close($comando);

    return $lista_servico; }









?>