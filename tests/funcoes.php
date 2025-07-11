<?php
//-----------------------------------------------------------------------------------------------------------------------------------------Kaio:
function salvarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha_barbeiro )
{
    $sql = "INSERT INTO barbeiro (nome, email, telefone, cpf, data_nascimento, data_admissao, senha_barbeiro) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssss', $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $senha_barbeiro);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}



function editarBarbeiro($conexao, $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id)
{
    $sql = "UPDATE barbeiro SET nome=?, $email=?, telefone=?, $cpf, data_nascimento=?, data_admissao=? WHERE id_barbeiro=?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $email, $telefone, $cpf, $data_nascimento, $data_admissao, $id);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
}
function deletarBarbeito($conexao, $id_barbeiro)
{
    $sql = "DELETE FROM barbeiro WHERE id_barbeiro = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_barbeiro);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}
function salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "INSERT INTO agendamento (data_agendamento, status, barbeiro_id_barbeiro, cliente_id_cliente) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssss', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}
function editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento)
{
    $sql = "UPDATE agendamento SET data_agendamento=?, status=?, barbeiro_id_barbeiro=?, cliente_id_cliente=? WHERE id_agendamento=?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssssi', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
}
function deletarAgendamento($conexao, $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "DELETE FROM agendamento WHERE id_agendamento = ? AND barbeiro_id_barbeiro = ? AND cliente_id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'iii', $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}
//-----------int = 1 -- decimal = d -- varchar = s -- date = s --text = s----------------------------------------------------------------------------------------------------Paulo Ricardo:

function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente )
{
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro, senha_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'sssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);

    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
}



function editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $id)
{
    $sql = "UPDATE cliente SET nome=?, email=?, telefone=?, endereco=?, data_nascimento=?, data_cadastro=? WHERE idcliente=?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssssssi', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $id);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
}



function deletarCliente($conexao, $id_cliente)
{
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_cliente);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}

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


function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico)
{
    $sql = "INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);


    mysqli_stmt_bind_param($comando, 'isii', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id)
{
    $sql = "UPDATE avaliacao SET estrela=?, comentario=?, barbeiro_id_barbeiro=?, servico_id_servico=? WHERE id_avaliacao=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isiii', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $id);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

function deletarAvaliacao($conexao, $idavaliacao)
{
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idavaliacao);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}

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

#Funções André



function listarBarbeiro($conexao) {
    $sql = "SELECT * FROM barbeiro";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_Barbeiro = [];
    while ($barbeiro = mysqli_fetch_assoc($resultados)) {
        $lista_Barbeiro[] = $barbeiro;
    }
    mysqli_stmt_close($comando);

    return $lista_Barbeiro;
}

function salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado)
{
    $sql = "INSERT INTO servico (nome_servico, descricao, preco, tempo_estimado) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssss', $nome_servico, $descricao, $preco, $tempo_estimado);

    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
}


function editarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado)
{
    $sql = "UPDATE cliente SET nome_servico=?, descricao=?, preco=?, tempo_estimado=? WHERE idservico=?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssss', $nome_servico, $descricao, $preco, $tempo_estimado);
    $funcionou = mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);
    return $funcionou;
}

function deletarServico($conexao, $id_servico)
{
    $sql = "DELETE FROM cliente WHERE idcliente = ?";
    $sql = "DELETE FROM servico WHERE id_servico = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id_servico);
    mysqli_stmt_bind_param($comando, 'i', $servico_id_servico);

    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    return $funcionou;
}

function listaServico($conexao)
{
    $sql = "SELECT * FROM tb_servico";
    $sql = "SELECT * FROM servico";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_servico = [];
    while ($servico = mysqli_fetch_assoc($resultados)) {
        $lista_servico[] = $servico;
    }

    mysqli_stmt_close($comando);
    return $lista_servico;
}

?>