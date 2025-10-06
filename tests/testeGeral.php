<?php
require_once "conexao.php"; // Ajuste o caminho se necessário
require_once "funcoes.php";

// Função auxiliar para mostrar resultados
function mostrarResultado($acao, $ok) {
    echo "<p>$acao: " . ($ok ? "✅ Sucesso" : "❌ Falha") . "</p>";
}

// --- TESTE CLIENTE ---
echo "<h2>TESTE CLIENTE</h2>";
$ok = salvarCliente($conexao, "Teste Cliente", "teste@teste.com", "11999999999", "Rua Teste, 123", "1990-01-01", date('Y-m-d'), "123456");
mostrarResultado("Salvar Cliente", $ok);

$clientes = listarCliente($conexao);
echo "<pre>Lista de Clientes:\n"; print_r($clientes); echo "</pre>";

if (!empty($clientes)) {
    $id_cliente = $clientes[0]['id_cliente'];
    $ok = editarCliente($conexao, "Cliente Editado", "editado@teste.com", "11988888888", "Rua Editada, 456", "1991-02-02", "654321", $id_cliente);
    mostrarResultado("Editar Cliente", $ok);

    $ok = deletarCliente($conexao, $id_cliente);
    mostrarResultado("Deletar Cliente", $ok);
}

// --- TESTE BARBEIRO ---
echo "<h2>TESTE BARBEIRO</h2>";
$ok = salvarBarbeiro($conexao, "Barbeiro Teste", "11977777777", "12345678900", "1985-05-05", "2020-01-01", 1);
mostrarResultado("Salvar Barbeiro", $ok);

$barbeiros = listarBarbeiro($conexao);
echo "<pre>Lista de Barbeiros:\n"; print_r($barbeiros); echo "</pre>";

if (!empty($barbeiros)) {
    $id_barbeiro = $barbeiros[0]['id_barbeiro'];
    $ok = editarBarbeiro($conexao, "Barbeiro Editado", "11966666666", "98765432100", "1986-06-06", "2021-02-02", 1, $id_barbeiro);
    mostrarResultado("Editar Barbeiro", $ok);

    $ok = deletarBarbeiro($conexao, $id_barbeiro);
    mostrarResultado("Deletar Barbeiro", $ok);
}

// --- TESTE SERVIÇO ---
echo "<h2>TESTE SERVIÇO</h2>";
$ok = salvarServico($conexao, "Corte Simples", "Corte de cabelo padrão", 50.00, 30);
mostrarResultado("Salvar Serviço", $ok);

$servicos = listarServico($conexao);
echo "<pre>Lista de Serviços:\n"; print_r($servicos); echo "</pre>";

if (!empty($servicos)) {
    $id_servico = $servicos[0]['id_servico'];
    $ok = editarServico($conexao, "Corte Especial", "Corte com estilo", 80.00, 45, $id_servico);
    mostrarResultado("Editar Serviço", $ok);

    $ok = deletarServico($conexao, $id_servico);
    mostrarResultado("Deletar Serviço", $ok);
}

// --- TESTE AGENDAMENTO ---
echo "<h2>TESTE AGENDAMENTO</h2>";
if (!empty($barbeiros) && !empty($clientes)) {
    $ok = salvarAgendamento($conexao, date('Y-m-d H:i:s'), "Pendente", $barbeiros[0]['id_barbeiro'], $clientes[0]['id_cliente']);
    mostrarResultado("Salvar Agendamento", $ok);

    $agendamentos = listarAgendamento($conexao);
    echo "<pre>Lista de Agendamentos:\n"; print_r($agendamentos); echo "</pre>";

    if (!empty($agendamentos)) {
        $id_agendamento = $agendamentos[0]['id_agendamento'];
        $ok = editarAgendamento($conexao, date('Y-m-d H:i:s'), "Confirmado", $barbeiros[0]['id_barbeiro'], $clientes[0]['id_cliente'], $id_agendamento);
        mostrarResultado("Editar Agendamento", $ok);

        $ok = deletarAgendamento($conexao, $id_agendamento, $barbeiros[0]['id_barbeiro'], $clientes[0]['id_cliente']);
        mostrarResultado("Deletar Agendamento", $ok);
    }
}

// --- TESTE AVALIAÇÃO ---
echo "<h2>TESTE AVALIAÇÃO</h2>";
if (!empty($barbeiros) && !empty($servicos)) {
    $ok = salvarAvaliacao($conexao, 5, "Ótimo serviço!", $barbeiros[0]['id_barbeiro'], $servicos[0]['id_servico'], "foto.jpg");
    mostrarResultado("Salvar Avaliação", $ok);

    $avaliacoes = listarAvaliacao($conexao);
    echo "<pre>Lista de Avaliações:\n"; print_r($avaliacoes); echo "</pre>";

    if (!empty($avaliacoes)) {
        $id_avaliacao = $avaliacoes[0]['idavaliacao'];
        $ok = editarAvaliacao($conexao, 4, "Bom serviço!", $barbeiros[0]['id_barbeiro'], $servicos[0]['id_servico'], "foto2.jpg", $id_avaliacao);
        mostrarResultado("Editar Avaliação", $ok);

        $ok = deletarAvaliacao($conexao, $id_avaliacao);
        mostrarResultado("Deletar Avaliação", $ok);
    }
}

echo "<h2>TESTES FINALIZADOS</h2>";
?>
