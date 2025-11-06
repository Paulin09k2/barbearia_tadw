<?php
require_once "./public/conexao.php";
require_once "./public/funcoes.php";

// ============ CONFIG =============
mysqli_begin_transaction($conexao); // evita sujar o banco

function resultado($nome, $ok, $msg = "") {
    $icone = $ok ? "✅" : "❌";
    echo "<strong>$icone $nome:</strong> " . ($msg ?: ($ok ? "Sucesso" : "Falhou")) . "<br>";
}

try {

    echo "<h2>🧪 Testes Iniciados...</h2>";

    // --- Usuário ---
    $idusuario = salvarUsuario($conexao, "teste@teste.com", "123", "cliente");
    resultado("Salvar Usuário", $idusuario > 0);

    $usuario = pesquisarUsuarioId($conexao, $idusuario);
    resultado("Pesquisar Usuário", $usuario !== null);

    $ok = editarUsuario($conexao, "editado@teste.com", "1234", "cliente", $idusuario);
    resultado("Editar Usuário", $ok);

    $usuarios = listarUsuario($conexao);
    resultado("Listar Usuários", count($usuarios) > 0);

    // --- Cliente ---
    $ok = salvarCliente($conexao, "Cliente Teste", "999999999", "Rua Teste", "2000-01-01", date("Y-m-d"), $idusuario);
    resultado("Salvar Cliente", $ok);
    $clientes = listarCliente($conexao);
    resultado("Listar Clientes", count($clientes) > 0);
    $cliente_id = end($clientes)['id_cliente'];

    // --- Barbeiro ---
    $ok = salvarBarbeiro($conexao, "Barbeiro Teste", "888888888", "12345678900", "1990-05-05", date("Y-m-d"), $idusuario);
    resultado("Salvar Barbeiro", $ok);
    $barbeiros = listarBarbeiro($conexao);
    resultado("Listar Barbeiros", count($barbeiros) > 0);
    $barbeiro_id = end($barbeiros)['id_barbeiro'];

    // --- Serviço ---
    $ok = salvarServico($conexao, "Corte de Cabelo", "Corte completo", 35.50, 45);
    resultado("Salvar Serviço", $ok);
    $servicos = listarServico($conexao);
    resultado("Listar Serviços", count($servicos) > 0);
    $servico_id = end($servicos)['id_servico'];

    // --- Agendamento ---
    $id_agendamento = salvarAgendamento($conexao, date("Y-m-d H:i:s", strtotime("+1 day")), "pendente", $barbeiro_id, $cliente_id);
    resultado("Salvar Agendamento", $id_agendamento > 0);

    $ok = salvarAgendaServico($conexao, $id_agendamento, $servico_id);
    resultado("Vincular Serviço ao Agendamento", $ok);

    $agendamentos = listarAgendamento($conexao);
    resultado("Listar Agendamentos", count($agendamentos) > 0);

    $ok = editarAgendamento($conexao, date("Y-m-d H:i:s", strtotime("+2 day")), "confirmado", $barbeiro_id, $cliente_id, $id_agendamento);
    resultado("Editar Agendamento", $ok);

    $ok = deletarAgendaServico($conexao, $id_agendamento);
    resultado("Deletar Agenda_Serviço", $ok);

    $ok = deletarAgendamento($conexao, $id_agendamento, $barbeiro_id, $cliente_id);
    resultado("Deletar Agendamento", $ok);

    // --- Avaliação ---
    $ok = salvarAvaliacao($conexao, 5, "Excelente atendimento!", $barbeiro_id, $servico_id, "foto.jpg");
    resultado("Salvar Avaliação", $ok);
    $avaliacoes = listarAvaliacao($conexao);
    resultado("Listar Avaliações", count($avaliacoes) > 0);

    // --- Limpeza de teste ---
    $ok = deletarServico($conexao, $servico_id);
    resultado("Deletar Serviço", $ok);
    $ok = deletarBarbeiro($conexao, $barbeiro_id);
    resultado("Deletar Barbeiro", $ok);
    $ok = deletarCliente($conexao, $cliente_id);
    resultado("Deletar Cliente", $ok);
    $ok = deletarUsuario($conexao, $idusuario);
    resultado("Deletar Usuário", $ok);

    echo "<hr><h3>🟢 Testes Finalizados</h3>";

    mysqli_rollback($conexao); // não grava no banco
    echo "<small>(Rollback executado — banco intacto)</small>";

} catch (Throwable $e) {
    echo "<h3>🔴 Erro Fatal:</h3><pre>" . $e->getMessage() . "</pre>";
    mysqli_rollback($conexao);
}

?>
