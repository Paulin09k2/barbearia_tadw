<?php
// Editar cliente pelo ID
function editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $senha_cliente, $id_cliente)
{
    $sql = "UPDATE cliente 
            SET nome=?, email=?, telefone=?, endereco=?, data_nascimento=?, senha_cliente=? 
            WHERE id_cliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssssi', $nome, $email, $telefone, $endereco, $data_nascimento, $senha_cliente, $id_cliente);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

// Listar todos os clientes
function listarCliente($conexao)
{
    $sql = "SELECT * FROM cliente";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);
    $lista_clientes = [];
    while ($cliente = mysqli_fetch_assoc($resultados)) {
        $lista_clientes[] = $cliente;
    }
    mysqli_stmt_close($comando);
    return $lista_clientes;
}

// Salvar novo cliente
function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente)
{
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro, senha_cliente) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

// ==================== AVALIAÇÃO ====================

// Deletar avaliação pelo ID
function deletarAvaliacao($conexao, $id_avaliacao)
{
    $sql = "DELETE FROM avaliacao WHERE id_avaliacao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_avaliacao);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

// Editar avaliação pelo ID
function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id_avaliacao)
{
    $sql = "UPDATE avaliacao 
            SET estrela=?, comentario=?, barbeiro_id_barbeiro=?, servico_id_servico=? 
            WHERE id_avaliacao=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isiii', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id_avaliacao);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

// Listar todas as avaliações
function listarAvaliacao($conexao)
{
    $sql = "SELECT * FROM avaliacao";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);
    $lista_avaliacao = [];
    while ($avaliacao = mysqli_fetch_assoc($resultados)) {
        $lista_avaliacao[] = $avaliacao;
    }
    mysqli_stmt_close($comando);
    return $lista_avaliacao;
}

// Salvar nova avaliação
function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico)
{
    $sql = "INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico) 
            VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isii', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

?>