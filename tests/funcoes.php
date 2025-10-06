<?php
//----------- int = i -- decimal = d -- varchar/text/date = s ----------------------------------------------------------------------------------------------------

// === AGENDAMENTO ===
function deletarAgendamento($conexao, $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "DELETE FROM agendamento WHERE id_agendamento = ? AND barbeiro_id_barbeiro = ? AND cliente_id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'iii', $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarAgendamento($conexao)
{
    $sql = "SELECT * FROM agendamento";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_agendamento = [];
    while ($agendamento = mysqli_fetch_assoc($resultados)) {
        $lista_agendamento[] = $agendamento;
    }

    mysqli_stmt_close($comando);
    return $lista_agendamento;
}

function editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento)
{
    $sql = "UPDATE agendamento 
            SET data_agendamento=?, status=?, barbeiro_id_barbeiro=?, cliente_id_cliente=? 
            WHERE id_agendamento=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssiii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "INSERT INTO agendamento (data_agendamento, status, barbeiro_id_barbeiro, cliente_id_cliente) 
            VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}


// === BARBEIRO ===
function deletarBarbeiro($conexao, $id_barbeiro)
{
    $sql = "DELETE FROM barbeiro WHERE id_barbeiro = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_barbeiro);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $id_barbeiro)
{
    $sql = "UPDATE barbeiro 
            SET nome=?, telefone=?, cpf=?, data_nascimento=?, data_admissao=? 
            WHERE id_barbeiro=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssi', $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $id_barbeiro);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function salvarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario)
{
    $sql = "INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssi', $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarBarbeiro($conexao)
{
    $sql = "SELECT * FROM barbeiro";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }
    mysqli_stmt_close($comando);
    return $lista;
}


// === CLIENTE ===
function deletarCliente($conexao, $id_cliente)
{
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarCliente($conexao, $nome, $telefone, $endereco, $data_nascimento, $id_cliente)
{
    $sql = "UPDATE cliente 
            SET nome=?, telefone=?, endereco=?, data_nascimento=? 
            WHERE id_cliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome, $telefone, $endereco, $data_nascimento, $id_cliente);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarCliente($conexao)
{
    $sql = "SELECT * FROM cliente";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro)
{
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro)
            VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssssss", $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro);
    $funcionou = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $funcionou;
}


// === SERVIÇO ===
function salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado)
{
    $sql = "INSERT INTO servico (nome_servico, descricao, preco, tempo_estimado) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssdi', $nome_servico, $descricao, $preco, $tempo_estimado);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado, $id_servico)
{
    $sql = "UPDATE servico 
            SET nome_servico=?, descricao=?, preco=?, tempo_estimado=? 
            WHERE id_servico=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssdii', $nome_servico, $descricao, $preco, $tempo_estimado, $id_servico);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function deletarServico($conexao, $id_servico)
{
    $sql = "DELETE FROM servico WHERE id_servico = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_servico);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarServico($conexao)
{
    $sql = "SELECT * FROM servico";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }
    mysqli_stmt_close($comando);
    return $lista;
}


// === AVALIAÇÃO ===
function deletarAvaliacao($conexao, $idavaliacao)
{
    $sql = "DELETE FROM avaliacao WHERE idavaliacao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idavaliacao);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao)
{
    $sql = "UPDATE avaliacao 
            SET estrela=?, comentario=?, barbeiro_id_barbeiro=?, servico_id_servico=?, foto=? 
            WHERE idavaliacao=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isissi', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarAvaliacao($conexao)
{
    $sql = "SELECT * FROM avaliacao";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }
    mysqli_stmt_close($comando);
    return $lista;
}

function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto)
{
    $sql = "INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico, foto) 
            VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isiss', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}
?>
