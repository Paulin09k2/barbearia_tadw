<?php
//----------- int = i -- decimal = d -- varchar/text/date = s -----------------------------

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

function listarAgendamento($conexao, $filtros = [])
{    $sql = "SELECT 
                a.id_agendamento,
                a.data_agendamento,
                a.status,
                c.id_cliente,
                c.nome AS cliente_nome,
                s.id_servico,
                GROUP_CONCAT(s.nome_servico SEPARATOR ', ') AS servicos
            FROM agendamento a
            INNER JOIN cliente c ON a.cliente_id_cliente = c.id_cliente
            LEFT JOIN agenda_servico ags ON ags.agendamento_id_agendamento = a.id_agendamento
            LEFT JOIN servico s ON ags.servico_id_servico = s.id_servico
            WHERE 1=1";

    $params = [];
    $tipos  = "";
    if (!empty($filtros['status'])) {
        $sql .= " AND a.status = ?";
        $tipos .= "s";
        $params[] = $filtros['status'];
    }
    if (!empty($filtros['data'])) {
        $sql .= " AND DATE(a.data_agendamento) = ?";
        $tipos .= "s";
        $params[] = $filtros['data'];
    }
    if (!empty($filtros['cliente'])) {
        $sql .= " AND c.nome LIKE ?";
        $tipos .= "s";
        $params[] = '%' . $filtros['cliente'] . '%';
    }
    $sql .= " GROUP BY a.id_agendamento ORDER BY a.data_agendamento DESC";
    $comando = mysqli_prepare($conexao, $sql);
    if (!empty($params)) {
        mysqli_stmt_bind_param($comando, $tipos, ...$params);
    }
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }

    mysqli_stmt_close($comando);
    return $lista;
}

function listarAgendamentoPorCliente($conexao, $id_cliente)
{
    $sql = "SELECT * FROM agendamento WHERE cliente_id_cliente = ? ORDER BY data_agendamento DESC";
    $comando = mysqli_prepare($conexao, $sql);
    if ($comando === false) {
        return []; // prepare falhou
    }

    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    mysqli_stmt_execute($comando);
    $result = mysqli_stmt_get_result($comando);

    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $lista[] = $row;
    }

    mysqli_stmt_close($comando);
    return $lista;
}

function salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente)
{
    $sql = "INSERT INTO agendamento (data_agendamento, status, barbeiro_id_barbeiro, cliente_id_cliente) 
            VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente);

    $ok = mysqli_stmt_execute($comando);

    if (!$ok) {
        error_log("Erro ao salvar agendamento: " . mysqli_error($conexao));
    }

    $id = mysqli_insert_id($conexao); // retorna o ID do novo agendamento
    mysqli_stmt_close($comando);
    return $id;
}

function editarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento)
{
    $sql = "UPDATE agendamento 
            SET data_agendamento = ?, status = ?, barbeiro_id_barbeiro = ?, cliente_id_cliente = ?
            WHERE id_agendamento = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssiii', $data_agendamento, $status, $barbeiro_id_barbeiro, $cliente_id_cliente, $id_agendamento);

    $ok = mysqli_stmt_execute($comando);

    if (!$ok) {
        error_log("Erro ao editar agendamento #$id_agendamento: " . mysqli_error($conexao));
    }

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

function editarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario, $id_barbeiro): bool
{
    // 🔒 Garantir formato de data YYYY-MM-DD
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_admissao)) {
        $data_admissao = date('Y-m-d', strtotime($data_admissao));
    }

    $sql = "UPDATE barbeiro 
            SET nome=?, telefone=?, cpf=?, data_nascimento=?, data_admissao=?, usuario_idusuario=? 
            WHERE id_barbeiro=?";
    
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssii', $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario, $id_barbeiro);
    
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    
    return $ok;
}


function salvarBarbeiro($conexao, $nome, $telefone, $cpf, $data_nascimento, $data_admissao, $usuario_idusuario)
{
    $sql = "INSERT INTO barbeiro (nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario) VALUES (?, ?, ?, ?, ?, ?)";
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
    $result = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
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
    $sql = "UPDATE cliente SET nome=?, telefone=?, endereco=?, data_nascimento=? WHERE id_cliente=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssssi', $nome,  $telefone, $endereco, $data_nascimento, $id_cliente);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function listarCliente($conexao)
{
    $sql = "SELECT * FROM cliente";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $result = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($comando);
    return $lista;
}

function salvarCliente($conexao, $nome, $telefone, $endereco, $data_nascimento, $data_cadastro, $idusuario)
{
    $sql = "INSERT INTO cliente (nome, telefone, endereco, data_nascimento, data_cadastro, usuario_idusuario) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssssi', $nome, $telefone, $endereco, $data_nascimento, $data_cadastro, $idusuario);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
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
    $sql = "UPDATE servico SET nome_servico=?, descricao=?, preco=?, tempo_estimado=? WHERE id_servico=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssdii', $nome_servico, $descricao, $preco, $tempo_estimado, $id_servico);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function deletarServico($conexao, $id_servico)
{
    $sql = "DELETE FROM servico WHERE id_servico=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_servico);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}
function listarServicosDisponiveis($conexao)
{
    $sql = "SELECT * FROM servico ORDER BY nome_servico ASC";
    $comando = mysqli_prepare($conexao, $sql);
    if ($comando === false) {
        return [];
    }

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $servicos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $servicos[] = $row;
    }

    mysqli_stmt_close($comando);
    return $servicos;
}

function listarServico($conexao)
{
    $sql = "SELECT * FROM servico";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $result = mysqli_stmt_get_result($comando);
    $lista = [];
    while ($row = mysqli_fetch_assoc($result)) $lista[] = $row;
    mysqli_stmt_close($comando);
    return $lista;
}

// === AVALIAÇÃO ===
function deletarAvaliacao($conexao, $idavaliacao)
{
    $sql = "DELETE FROM avaliacao WHERE idavaliacao=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idavaliacao);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao)
{
    $sql = "UPDATE avaliacao SET estrela=?, comentario=?, barbeiro_id_barbeiro=?, servico_id_servico=?, foto=? WHERE idavaliacao=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isissi', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto, $idavaliacao);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}


function listarAvaliacoes($conexao)
{
    $sql = "
        SELECT 
            a.idavaliacao,
            a.estrela,
            a.comentario,
            a.foto,
            c.nome AS nome_cliente,
            b.nome AS nome_barbeiro,
            s.nome_servico,
            s.preco,
            a.cliente_id_cliente,
            a.barbeiro_id_barbeiro,
            a.servico_id_servico
        FROM avaliacao a
        INNER JOIN cliente c ON a.cliente_id_cliente = c.id_cliente
        INNER JOIN barbeiro b ON a.barbeiro_id_barbeiro = b.id_barbeiro
        INNER JOIN servico s ON a.servico_id_servico = s.id_servico
        ORDER BY a.idavaliacao DESC
    ";

    $resultado = mysqli_query($conexao, $sql);
    $avaliacoes = [];

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $avaliacoes[] = $linha;
        }
    }

    return $avaliacoes;
}

function excluirAvaliacao($conexao, $idavaliacao)
{
    $sql = "DELETE FROM avaliacao WHERE idavaliacao = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idavaliacao);
    $ok = mysqli_stmt_execute($stmt);

    $linhas = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($ok && $linhas > 0) {
        return ['sucesso' => true, 'mensagem' => 'Avaliação removida com sucesso.'];
    } else {
        return ['sucesso' => false, 'mensagem' => 'Avaliação não encontrada.'];
    }
}


function calcularMediaAvaliacoes($conexao, $id_barbeiro = null)
{
    if ($id_barbeiro) {
        $sql = "SELECT AVG(estrela) AS media FROM avaliacao WHERE barbeiro_id_barbeiro = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_barbeiro);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $linha = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);
        return round($linha['media'] ?? 0, 2);
    } else {
        $sql = "SELECT AVG(estrela) AS media FROM avaliacao";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($resultado);
        return round($linha['media'] ?? 0, 2);
    }
}


function salvarAvaliacao($conexao, $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto)
{
    $sql = "INSERT INTO avaliacao (estrela, comentario, barbeiro_id_barbeiro, servico_id_servico, foto) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'isiss', $estrela, $comentario, $barbeiro_id_barbeiro, $servico_id_servico, $foto);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function pesquisarClienteId($conexao, $id_cliente)
{
    $sql = "SELECT * FROM cliente WHERE usuario_idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    if ($comando === false) {
        return null; // Falha na preparação
    }

    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $cliente = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);

    return $cliente ?: null;
}

// === Usuario ===

function salvarUsuario($conexao, $email, $senha, $tipo_usuario)
{
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (email, senha, tipo_usuario) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sss', $email, $senha_hash, $tipo_usuario);
    $ok = mysqli_stmt_execute($comando);

    $idusuario = mysqli_insert_id($conexao);

    mysqli_stmt_close($comando);
    return $idusuario;
}

function editarUsuario($conexao, $email, $senha, $tipo_usuario, $idusuario)
{
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuario SET email=?, senha=?, tipo_usuario=? WHERE idusuario=?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssi', $email, $senha_hash, $tipo_usuario, $idusuario);
    $ok = mysqli_stmt_execute($comando);
    $idusuarioo = mysqli_insert_id($conexao);
    mysqli_stmt_close($comando);
    return $idusuarioo;
}


function deletarUsuario($conexao, $idusuario)
{
    $sql = "DELETE FROM usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}


function listarUsuario($conexao)
{
    $sql = "SELECT * FROM usuario";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $usuarios = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $row;
    }

    mysqli_stmt_close($comando);
    return $usuarios;
}
function pesquisarUsuarioId($conexao, $idusuario): array|bool|null
{
    $sql = "SELECT * FROM usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);

    if (!$comando) {
        die("Erro ao preparar consulta: " . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($comando, 'i', $idusuario);
    mysqli_stmt_execute($comando);

    $resultado = mysqli_stmt_get_result($comando);
    $usuario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($comando);

    return $usuario ? $usuario : null;
}




function verificarLogin($conexao, $email, $senha)
{
    $sql = "
        SELECT 
            u.idusuario, 
            u.email, 
            u.senha, 
            u.tipo_usuario, 
            c.id_cliente, 
            b.id_barbeiro
        FROM usuario u
        LEFT JOIN cliente c ON u.idusuario = c.usuario_idusuario
        LEFT JOIN barbeiro b ON u.idusuario = b.usuario_idusuario
        WHERE u.email = ?
        LIMIT 1
    ";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $email);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    // var_dump(value: $resultado);
    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica a senha com hash seguro
        if (password_verify($senha, $usuario['senha'])) {
            return $usuario; // Login bem-sucedido
        }
    }

    return null; // Falha no login
}
function listarResumoCliente($conexao, $id_cliente)
{
    $sql = "
        SELECT 
            a.id_agendamento,
            a.data_agendamento,
            a.status,
            b.nome AS nome_barbeiro,
            s.id_servico,
            s.nome_servico,
            s.descricao,
            s.preco,
            s.tempo_estimado
        FROM agendamento a
        INNER JOIN barbeiro b 
            ON a.barbeiro_id_barbeiro = b.id_barbeiro
        INNER JOIN agenda_servico ags 
            ON ags.agendamento_id_agendamento = a.id_agendamento
        INNER JOIN servico s 
            ON ags.servico_id_servico = s.id_servico
        WHERE a.cliente_id_cliente = ?
        ORDER BY a.data_agendamento DESC
    ";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id_cliente);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $resumo = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $resumo[] = $linha;
    }

    mysqli_stmt_close($comando);
    return $resumo;
}

function listarAvaliacaoPorCliente($conexao, $id_cliente)
{
    $sql = "
        SELECT 
            a.idavaliacao,
            a.estrela,
            a.comentario,
            a.foto,
            b.nome AS nome_barbeiro,
            s.nome_servico
        FROM avaliacao a
        INNER JOIN barbeiro b ON a.barbeiro_id_barbeiro = b.id_barbeiro
        INNER JOIN servico s ON a.servico_id_servico = s.id_servico
        INNER JOIN agendamento ag ON ag.barbeiro_id_barbeiro = b.id_barbeiro 
                                   AND ag.cliente_id_cliente = ?
        GROUP BY a.idavaliacao
        ORDER BY a.idavaliacao DESC
    ";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id_cliente);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $avaliacoes = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $avaliacoes[] = $row;
    }

    mysqli_stmt_close($comando);
    return $avaliacoes;
}

function salvarAgendaServico($conexao, $id_agendamento, $id_servico)
{
    $sql = "INSERT INTO agenda_servico (agendamento_id_agendamento, servico_id_servico) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ii", $id_agendamento, $id_servico);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function editarAgendaServico($conexao, $id_agendamento, $novo_id_servico)
{
    $sql = "UPDATE agenda_servico 
            SET servico_id_servico = ? 
            WHERE agendamento_id_agendamento = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ii", $novo_id_servico, $id_agendamento);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}


function listarAgendaServico($conexao, $id_agendamento)
{
    $sql = "SELECT a.agendamento_id_agendamento, s.id_servico, s.nome_servico, s.preco, s.tempo_estimado
            FROM agenda_servico a
            INNER JOIN servico s ON a.servico_id_servico = s.id_servico
            WHERE a.agendamento_id_agendamento = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id_agendamento);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lista[] = $row;
    }

    mysqli_stmt_close($comando);
    return $lista;
}



function deletarAgendaServico($conexao, $id_agendamento)
{
    $sql = "DELETE FROM agenda_servico WHERE agendamento_id_agendamento = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id_agendamento);
    $ok = mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    return $ok;
}

function buscarAgendamentoPorId($conexao, $id_agendamento, $id_cliente)
{
    $sql = "SELECT * FROM agendamento WHERE id_agendamento = ? AND cliente_id_cliente = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_agendamento, $id_cliente);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $agendamento = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);
    return $agendamento ? $agendamento : null;
}

function pesquisarBarbeiroId($conexao, $idusuario)
{
    $sql = "SELECT id_barbeiro, nome, telefone, cpf, data_nascimento, data_admissao, usuario_idusuario
            FROM barbeiro
            WHERE usuario_idusuario = ?";
    if ($comando = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($comando, "i", $idusuario);
        mysqli_stmt_execute($comando);
        $resultado = mysqli_stmt_get_result($comando);
        $barbeiro = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($comando);
        return $barbeiro;
    } else {
        die("Erro ao preparar a consulta: " . mysqli_error($conexao));
    }
}

function obterProximosAgendamentos($conexao, $idBarbeiro, $limite = 5) {
    $agendamentos = [];
    $sql = "
        SELECT a.id_agendamento, a.data_agendamento, c.nome AS nome_cliente
        FROM agendamento a
        INNER JOIN cliente c ON a.cliente_id_cliente = c.id_cliente
        WHERE a.barbeiro_id_barbeiro = ?
        ORDER BY a.data_agendamento ASC
        LIMIT ?;
    ";

    if ($stmt = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $idBarbeiro, $limite);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultado)) {
            $agendamentos[] = $row;
        }
        mysqli_stmt_close($stmt);
    }
    return $agendamentos;
}

function obterTotalClientes($conexao, $idBarbeiro) {
    $total = 0;
    $sql = "
        SELECT COUNT(DISTINCT cliente_id_cliente) AS total_clientes
        FROM agendamento
        WHERE barbeiro_id_barbeiro = ?;
    ";

    if ($stmt = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $idBarbeiro);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultado)) {
            $total = $row['total_clientes'];
        }
        mysqli_stmt_close($stmt);
    }
    return $total;
}

function obterTotalServicos($conexao, $idBarbeiro) {
    $total = 0;
    $sql = "
        SELECT COUNT(DISTINCT s.id_servico) AS total_servicos
        FROM agenda_servico ags
        INNER JOIN agendamento a ON ags.agendamento_id_agendamento = a.id_agendamento
        INNER JOIN servico s ON ags.servico_id_servico = s.id_servico
        WHERE a.barbeiro_id_barbeiro = ?;
    ";

    if ($stmt = mysqli_prepare($conexao, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $idBarbeiro);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultado)) {
            $total = $row['total_servicos'];
        }
        mysqli_stmt_close($stmt);
    }
    return $total;
}

function obterResumoPainelBarbeiro($conexao, $idBarbeiro) {
    $resumo = [];

    $resumo['proximos_agendamentos'] = obterProximosAgendamentos($conexao, $idBarbeiro);
    $resumo['total_clientes'] = obterTotalClientes($conexao, $idBarbeiro);
    $resumo['total_servicos'] = obterTotalServicos($conexao, $idBarbeiro);

    return $resumo;
}

function verificarHorarioDisponivel($conexao, $barbeiro_id, $data_agendamento, $id_agendamento = null)
{
    $sql = "SELECT COUNT(*) AS total 
            FROM agendamento 
            WHERE barbeiro_id_barbeiro = ? 
              AND data_agendamento = ?";

    // Se for edição, ignora o próprio agendamento
    if ($id_agendamento !== null) {
        $sql .= " AND id_agendamento <> ?";
    }

    $comando = mysqli_prepare($conexao, $sql);

    if ($id_agendamento !== null) {
        mysqli_stmt_bind_param($comando, "isi", $barbeiro_id, $data_agendamento, $id_agendamento);
    } else {
        mysqli_stmt_bind_param($comando, "is", $barbeiro_id, $data_agendamento);
    }

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $row = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    return ($row['total'] == 0);
}
function tipoUsuario($conexao, $idusuario)
{
    $sql = "SELECT tipo_usuario FROM usuario WHERE idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idusuario);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    return $usuario; 
}

function listarHorariosDisponiveis($conexao, $barbeiro_id, $data_dia)
{
    // define intervalo de horários (09h às 18h)
    $hora_inicio = new DateTime("$data_dia 09:00");
    $hora_fim = new DateTime("$data_dia 18:00");
    $intervalo = new DateInterval('PT30M'); // a cada 30 minutos

    $horarios_possiveis = [];
    for ($hora = clone $hora_inicio; $hora <= $hora_fim; $hora->add($intervalo)) {
        $horarios_possiveis[] = $hora->format('Y-m-d H:i:s');
    }

    // busca horários já ocupados no banco
    $sql = "SELECT data_agendamento FROM agendamento 
            WHERE barbeiro_id_barbeiro = ? 
              AND DATE(data_agendamento) = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "is", $barbeiro_id, $data_dia);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $ocupados = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $ocupados[] = date('Y-m-d H:i:s', strtotime($row['data_agendamento']));
    }
    mysqli_stmt_close($comando);

    // filtra os horários livres
    $disponiveis = array_diff($horarios_possiveis, $ocupados);
    return array_values($disponiveis);
}
function listarCompletoCliente($conexao, $id)
{
    $sql = "
        SELECT 
            c.id_cliente,
            c.nome AS nome_cliente,
            c.telefone AS telefone_cliente,
            c.endereco,
            c.data_nascimento,
            c.data_cadastro,

            a.id_agendamento,
            a.data_agendamento,
            a.status,

            b.id_barbeiro,
            b.nome AS nome_barbeiro,
            b.telefone AS telefone_barbeiro,

            s.id_servico,
            s.nome_servico,
            s.descricao AS descricao_servico,
            s.preco,
            s.tempo_estimado,

            av.idavaliacao,
            av.estrela AS avaliacao_estrela,
            av.comentario AS avaliacao_comentario,
            av.foto AS avaliacao_foto

        FROM cliente c
        LEFT JOIN agendamento a 
            ON a.cliente_id_cliente = c.id_cliente
        LEFT JOIN barbeiro b 
            ON b.id_barbeiro = a.barbeiro_id_barbeiro
        LEFT JOIN agenda_servico ags 
            ON ags.agendamento_id_agendamento = a.id_agendamento
        LEFT JOIN servico s 
            ON s.id_servico = ags.servico_id_servico
        LEFT JOIN avaliacao av 
            ON av.cliente_id_cliente = c.id_cliente

        WHERE c.id_cliente = ? OR c.usuario_idusuario = ?
        ORDER BY a.data_agendamento DESC
    ";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $id, $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    $resumo = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $resumo[] = $linha;
    }

    mysqli_stmt_close($stmt);
    return $resumo;
}
function excluirAgendamento($conexao, $id_cliente, $id_agendamento)
{
    $sql = "DELETE FROM agendamento 
            WHERE id_agendamento = ? 
              AND cliente_id_cliente = ?";

    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt) {
        return ['sucesso' => false, 'erro' => mysqli_error($conexao)];
    }

    mysqli_stmt_bind_param($stmt, 'ii', $id_agendamento, $id_cliente);
    $ok = mysqli_stmt_execute($stmt);

    $linhas = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($ok && $linhas > 0) {
        return ['sucesso' => true, 'mensagem' => 'Agendamento excluído com sucesso!'];
    } else {
        return ['sucesso' => false, 'mensagem' => 'Nenhum agendamento encontrado para este cliente.'];
    }
}
