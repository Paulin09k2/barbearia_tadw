<?php
//----------- int = i -- decimal = d -- varchar/text/date = s -----------------------------

// === AGENDAMENTO ===
function deletarAgendamento($conexao, $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "DELETE FROM agendamento WHERE id_agendamento = ? AND barbeiro_id_barbeiro = ? AND cliente_id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $id_agendamento, $barbeiro_id_barbeiro, $cliente_id_cliente);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function listarAgendamento($conexao)
{
    $sql = "SELECT * FROM agendamento";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($stmt);
    return $lista;
}

function editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento)
{
    $sql = "UPDATE agendamento SET data_agendamento=?, status=?, barbeiro_id_barbeiro=?, cliente_id_cliente=? WHERE id_agendamento=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssiii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "INSERT INTO agendamento (data_agendamento, status, barbeiro_id_barbeiro, cliente_id_cliente) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

// === BARBEIRO ===
function deletarBarbeiro($conexao, $id_barbeiro)
{
    $sql = "DELETE FROM barbeiro WHERE id_barbeiro = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_barbeiro);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function editarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario, $id_barbeiro)
{
    $sql = "UPDATE barbeiro SET nome=?, telefone=?, cpf=?, data_nascimento=?, data_admissao=?, usuario_idusuario=? WHERE id_barbeiro=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssiii', $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario, $id_barbeiro);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function salvarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario)
{
    $sql = "INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssi', $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function listarBarbeiro($conexao)
{
    $sql = "SELECT * FROM barbeiro";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($stmt);
    return $lista;
}

// === CLIENTE ===
function deletarCliente($conexao, $id_cliente)
{
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_cliente);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function editarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $senha_cliente, $id_cliente)
{
    $sql = "UPDATE cliente SET nome=?, email=?, telefone=?, endereco=?, data_nascimento=?, senha_cliente=? WHERE id_cliente=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $nome, $email, $telefone, $endereco, $data_nascimento, $senha_cliente, $id_cliente);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function listarCliente($conexao)
{
    $sql = "SELECT * FROM cliente";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($stmt);
    return $lista;
}
function cadastrarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente)
{
    $senha_hash = password_hash($senha_cliente, PASSWORD_DEFAULT);
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro, senha_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_hash);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}
function salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente)
{
    $sql = "INSERT INTO cliente (nome, email, telefone, endereco, data_nascimento, data_cadastro, senha_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $nome, $email, $telefone, $endereco, $data_nascimento, $data_cadastro, $senha_cliente);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

// === SERVIÇO ===
function salvarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado)
{
    $sql = "INSERT INTO servico (nome_servico, descricao, preco, tempo_estimado) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdi', $nome_servico, $descricao, $preco, $tempo_estimado);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function editarServico($conexao, $nome_servico, $descricao, $preco, $tempo_estimado, $id_servico)
{
    $sql = "UPDATE servico SET nome_servico=?, descricao=?, preco=?, tempo_estimado=? WHERE id_servico=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdii', $nome_servico, $descricao, $preco, $tempo_estimado, $id_servico);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function deletarServico($conexao, $id_servico)
{
    $sql = "DELETE FROM servico WHERE id_servico=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_servico);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function listarServico($conexao)
{
    $sql = "SELECT * FROM servico";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($stmt);
    return $lista;
}

// === AVALIAÇÃO ===
function deletarAvaliacao($conexao, $idavaliacao)
{
    $sql = "DELETE FROM avaliacao WHERE idavaliacao=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $idavaliacao);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao)
{
    $sql = "UPDATE avaliacao SET estrela=?, comentario=?, barbeiro_id_barbeiro=?, servico_id_servico=?, foto=? WHERE idavaliacao=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'isissi', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function listarAvaliacao($conexao)
{
    $sql = "SELECT * FROM avaliacao";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($stmt);
    return $lista;
}

function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto)
{
    $sql = "INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'isiss', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $ok;
}

function pesquisarClienteId($conexao, $id_cliente)
{
    $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_cliente);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cliente = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $cliente ? $cliente : null;
}
function verificarLogin($conexao, $email, $senha)
{
    $sql = "SELECT id_cliente, senha_cliente FROM cliente WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($usuario && password_verify($senha, $usuario['senha_cliente'])) {
        return $usuario['id_cliente'];
    } else {
        return false;
    }
}
function hashPassword($senha)
{
    return password_hash($senha, PASSWORD_DEFAULT);
}
?>
