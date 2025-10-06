<?php
require_once "funcoes.php";

// === CONEXÃO COM O BANCO ===
$conexao = new mysqli("localhost", "root", "", "barbearia");
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

echo "<h2>🚀 Teste Geral de Funções</h2>";

// Função auxiliar para mostrar resultado
function resultado($acao, $ok)
{
    echo $ok ? "✅ $acao<br>" : "❌ $acao<br>";
}

// ====================== CLIENTE ======================
echo "<h3>Cliente</h3>";
$ok1 = salvarCliente($conexao, "Cliente Teste", "teste@teste.com", "62999999999", "Rua Teste 123", "2000-01-01", date("Y-m-d H:i:s"));
resultado("Salvar Cliente", $ok1);

$clientes = listarCliente($conexao);
$id_cliente = end($clientes)['id_cliente'] ?? 0;
resultado("Listar Cliente", !empty($clientes));

$ok2 = editarCliente($conexao, "Cliente Editado", "62999999999", "Rua Editada 456", "1999-12-31", $id_cliente);
resultado("Editar Cliente", $ok2);

$ok3 = deletarCliente($conexao, $id_cliente);
resultado("Deletar Cliente", $ok3);


// ====================== BARBEIRO ======================
echo "<h3>Barbeiro</h3>";
$ok4 = salvarBarbeiro($conexao, "Barbeiro Teste", "62988888888", "12345678900", "1990-05-10", date("Y-m-d"), 1);
resultado("Salvar Barbeiro", $ok4);

$barbeiros = listarBarbeiro($conexao);
$id_barbeiro = end($barbeiros)['id_barbeiro'] ?? 0;
resultado("Listar Barbeiro", !empty($barbeiros));

$ok5 = editarBarbeiro($conexao, "Barbeiro Editado", "62977777777", "12345678900", "1991-06-11", date("Y-m-d"), $id_barbeiro);
resultado("Editar Barbeiro", $ok5);

$ok6 = deletarBarbeiro($conexao, $id_barbeiro);
resultado("Deletar Barbeiro", $ok6);


// ====================== SERVIÇO ======================
echo "<h3>Serviço</h3>";
$ok7 = salvarServico($conexao, "Corte Teste", "Corte padrão masculino", 50.00, 30);
resultado("Salvar Serviço", $ok7);

$servicos = listarServico($conexao);
$id_servico = end($servicos)['id_servico'] ?? 0;
resultado("Listar Serviço", !empty($servicos));

$ok8 = editarServico($conexao, "Corte Atualizado", "Corte com navalha", 60.00, 40, $id_servico);
resultado("Editar Serviço", $ok8);

$ok9 = deletarServico($conexao, $id_servico);
resultado("Deletar Serviço", $ok9);


// ====================== AGENDAMENTO ======================
echo "<h3>Agendamento</h3>";
// Criar cliente e barbeiro temporários para o agendamento
salvarCliente($conexao, "Cliente Temp", "temp@teste.com", "62999999999", "Rua Temp", "2000-01-01", date("Y-m-d H:i:s"));
$clienteTemp = end(listarCliente($conexao))['id_cliente'];

salvarBarbeiro($conexao, "Barbeiro Temp", "62988888888", "12345678900", "1990-05-10", date("Y-m-d"), 1);
$barbeiroTemp = end(listarBarbeiro($conexao))['id_barbeiro'];

$ok10 = salvarAgendamento($conexao, date("Y-m-d H:i:s"), "pendente", $barbeiroTemp, $clienteTemp);
resultado("Salvar Agendamento", $ok10);

$agendamentos = listarAgendamento($conexao);
$id_agendamento = end($agendamentos)['id_agendamento'] ?? 0;
resultado("Listar Agendamento", !empty($agendamentos));

$ok11 = editarAgendamento($conexao, date("Y-m-d H:i:s", strtotime("+1 day")), "concluido", $barbeiroTemp, $clienteTemp, $id_agendamento);
resultado("Editar Agendamento", $ok11);

$ok12 = deletarAgendamento($conexao, $id_agendamento, $barbeiroTemp, $clienteTemp);
resultado("Deletar Agendamento", $ok12);

// Limpeza de registros temporários
deletarCliente($conexao, $clienteTemp);
deletarBarbeiro($conexao, $barbeiroTemp);


// ====================== AVALIAÇÃO ======================
echo "<h3>Avaliação</h3>";
// Criar registros necessários
salvarBarbeiro($conexao, "Barbeiro Aval", "62999999999", "12345678911", "1992-07-10", date("Y-m-d"), 1);
$id_barb = end(listarBarbeiro($conexao))['id_barbeiro'];

salvarServico($conexao, "Barba", "Feita na navalha", 40.00, 25);
$id_serv = end(listarServico($conexao))['id_servico'];

$ok13 = salvarAvaliacao($conexao, 5, "Excelente serviço!", $id_barb, $id_serv, "foto.jpg");
resultado("Salvar Avaliação", $ok13);

$avaliacoes = listarAvaliacao($conexao);
$id_avaliacao = end($avaliacoes)['idavaliacao'] ?? 0;
resultado("Listar Avaliação", !empty($avaliacoes));

$ok14 = editarAvaliacao($conexao, 4, "Bom, mas pode melhorar", $id_barb, $id_serv, "foto2.jpg", $id_avaliacao);
resultado("Editar Avaliação", $ok14);

$ok15 = deletarAvaliacao($conexao, $id_avaliacao);
resultado("Deletar Avaliação", $ok15);

// Limpeza final
deletarBarbeiro($conexao, $id_barb);
deletarServico($conexao, $id_serv);

echo "<br><b>✅ Testes concluídos.</b>";

$conexao->close();
?>
