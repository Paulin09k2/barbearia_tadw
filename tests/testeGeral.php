<?php
require_once "conexao.php";
require_once "funcoes.php";

echo "<h2>=== TESTE GERAL DAS FUNÇÕES ===</h2>";

// ===== CLIENTE =====
echo "<h3>Cliente</h3>";
$clienteOk = salvarCliente($conexao, "Teste Cliente", "teste@teste.com", "62999999999", "Rua Teste 123", "2000-01-01", date('Y-m-d'), password_hash("123456", PASSWORD_DEFAULT));
if ($clienteOk) echo "✅ Cliente salvo<br>";

$clientes = listarCliente($conexao);
echo "📋 Total de clientes: " . count($clientes) . "<br>";
$ultimoCliente = end($clientes);
$id_cliente = $ultimoCliente['id_cliente'] ?? null;

if ($id_cliente) {
    editarCliente($conexao, "Cliente Editado", "editado@teste.com", "62000000000", "Rua Editada", "1990-10-10", password_hash("nova", PASSWORD_DEFAULT), $id_cliente);
    echo "✏️ Cliente editado<br>";
}

$clienteDados = pesquisarClienteId($conexao, $id_cliente);
echo "🔎 Cliente encontrado: " . ($clienteDados['nome'] ?? 'erro') . "<br>";

verificarLogin($conexao, "editado@teste.com", "nova") ? print("🔐 Login ok<br>") : print("❌ Falha login<br>");

deletarCliente($conexao, $id_cliente);
echo "🗑️ Cliente deletado<br>";

// ===== BARBEIRO =====
echo "<h3>Barbeiro</h3>";
$barbeiroOk = salvarBarbeiro($conexao, "Barbeiro Teste", "barbeiro@teste.com", "62911111111", "12345678900", "1995-05-05", date('Y-m-d'), password_hash("abc123", PASSWORD_DEFAULT));
if ($barbeiroOk) echo "✅ Barbeiro salvo<br>";

$barbeiros = listarBarbeiro($conexao);
$id_barbeiro = end($barbeiros)['id_barbeiro'] ?? null;

if ($id_barbeiro) {
    editarBarbeiro($conexao, "Barbeiro Editado", "editado@teste.com", "62988888888", "09876543211", "1990-02-02", $id_barbeiro);
    echo "✏️ Barbeiro editado<br>";
    deletarBarbeiro($conexao, $id_barbeiro);
    echo "🗑️ Barbeiro deletado<br>";
}

// ===== SERVIÇO =====
echo "<h3>Serviço</h3>";
salvarServico($conexao, "Corte Degrade", "Corte moderno", "40.00", "00:30");
echo "✅ Serviço salvo<br>";

$servicos = listaServico($conexao);
$id_servico = end($servicos)['id_servico'] ?? null;

if ($id_servico) {
    editarServico($conexao, "Corte Social", "Atualizado", "35.00", "00:25", $id_servico);
    echo "✏️ Serviço editado<br>";
    deletarServico($conexao, $id_servico);
    echo "🗑️ Serviço deletado<br>";
}

// ===== AVALIAÇÃO =====
echo "<h3>Avaliação</h3>";
// Criar barbeiro e serviço para relacionamento
$barbeiroOk = salvarBarbeiro($conexao, "Barbeiro Aval", "aval@teste.com", "62999999999", "12345678900", "1990-01-01", date('Y-m-d'), "senha");
$servicoOk = salvarServico($conexao, "Corte Aval", "Avaliação de serviço", "50.00", "00:30");

$barbeiro = end(listarBarbeiro($conexao));
$servico = end(listaServico($conexao));

$id_barbeiro = $barbeiro['id_barbeiro'] ?? null;
$id_servico = $servico['id_servico'] ?? null;

if ($id_barbeiro && $id_servico) {
    salvarAvaliacao($conexao, 5, "Excelente!", $id_barbeiro, $id_servico);
    echo "✅ Avaliação salva<br>";

    $avaliacoes = listarAvaliacao($conexao);
    $id_avaliacao = end($avaliacoes)['idavaliacao'] ?? null;

    if ($id_avaliacao) {
        editarAvaliacao($conexao, 4, "Muito bom", $id_barbeiro, $id_servico, $id_avaliacao);
        echo "✏️ Avaliação editada<br>";
        deletarAvaliacao($conexao, $id_avaliacao);
        echo "🗑️ Avaliação deletada<br>";
    }
}

// ===== AGENDAMENTO =====
echo "<h3>Agendamento</h3>";
$cliente = salvarCliente($conexao, "Agendamento Cliente", "agendamento@teste.com", "62922222222", "Rua Agendamento", "2000-10-10", date('Y-m-d'), password_hash("123", PASSWORD_DEFAULT));
$barbeiro = salvarBarbeiro($conexao, "Agendamento Barbeiro", "agendamento@teste.com", "62933333333", "98765432100", "1995-05-05", date('Y-m-d'), password_hash("123", PASSWORD_DEFAULT));

$cliente_id = end(listarCliente($conexao))['id_cliente'] ?? null;
$barbeiro_id = end(listarBarbeiro($conexao))['id_barbeiro'] ?? null;

if ($cliente_id && $barbeiro_id) {
    salvarAgendamento($conexao, date('Y-m-d H:i:s'), "pendente", $barbeiro_id, $cliente_id);
    echo "✅ Agendamento salvo<br>";

    $result = mysqli_query($conexao, "SELECT * FROM agendamento ORDER BY id_agendamento DESC LIMIT 1");
    $agendamento = mysqli_fetch_assoc($result);
    $id_agendamento = $agendamento['id_agendamento'] ?? null;

    if ($id_agendamento) {
        editarAgendamento($conexao, date('Y-m-d H:i:s', strtotime('+1 day')), "concluido", $barbeiro_id, $cliente_id, $id_agendamento);
        echo "✏️ Agendamento editado<br>";

        deletarAgendamento($conexao, $id_agendamento, $barbeiro_id, $cliente_id);
        echo "🗑️ Agendamento deletado<br>";
    }
}

echo "<hr><strong>✅ Todos os testes foram executados.</strong>";
?>
