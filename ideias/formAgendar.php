<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";

// Buscar clientes existentes
$listaClientes = listarCliente($conexao);

// Buscar barbeiros
$listaBarbeiros = listarBarbeiro($conexao);

// Buscar serviços
$listaServicos = listaServico($conexao);

$erro = "";     // Para mensagens de erro
$sucesso = "";  // Para mensagens de sucesso

// Processar envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validação do cliente
    if (isset($_POST['cliente_id']) && !empty($_POST['cliente_id'])) {
        $cliente_id = $_POST['cliente_id'];
    } else {
        $erro = "❌ Selecione um cliente existente antes de agendar.";
    }

    // Validação do barbeiro
    if (isset($_POST['barbeiro']) && !empty($_POST['barbeiro']) && empty($erro)) {
        $barbeiro_id = $_POST['barbeiro'];
    } else if (empty($erro)) {
        $erro = "❌ Selecione um barbeiro para o agendamento.";
    }

    // Validação da data e hora
    if (isset($_POST['data']) && isset($_POST['hora']) && empty($erro)) {
        $data_agendamento = $_POST['data'] . " " . $_POST['hora'];
    } else if (empty($erro)) {
        $erro = "❌ Informe a data e hora do agendamento.";
    }

    if (empty($erro)) {
        $status = "Pendente";
        $servicos = $_POST['servicos'] ?? [];

        // Salvar agendamento
        salvarAgendamento($conexao, $data_agendamento, $status, $barbeiro_id, $cliente_id);
        $agendamento_id = mysqli_insert_id($conexao);

        // Salvar serviços do agendamento
        foreach ($servicos as $servico_id) {
            $sql = "INSERT INTO agenda_servico (agendamento_id_agendamento, servico_id_servico) VALUES (?, ?)";
            $comando = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($comando, 'ii', $agendamento_id, $servico_id);
            mysqli_stmt_execute($comando);
            mysqli_stmt_close($comando);
        }

        $sucesso = "✅ Agendamento realizado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo Agendamento</title>
  <link rel="stylesheet" href="desing.css">
</head>
<body>

  <h2>Agendar Compromisso</h2>

  <!-- Mensagens de erro e sucesso -->
  <?php if (!empty($erro)): ?>
    <p style="color:red"><?= $erro ?></p>
  <?php endif; ?>

  <?php if (!empty($sucesso)): ?>
    <p style="color:green"><?= $sucesso ?></p>
  <?php endif; ?>

  <form action="" method="POST">

    <!-- Selecionar Cliente -->
    <fieldset>
      <legend>Cliente</legend>
      <label for="cliente_id">Selecionar Cliente Existente</label>
      <select id="cliente_id" name="cliente_id" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($listaClientes as $cliente): ?>
          <option value="<?= $cliente['id_cliente'] ?>"
            <?= (isset($_POST['cliente_id']) && $_POST['cliente_id']==$cliente['id_cliente'])?'selected':'' ?>>
            <?= $cliente['nome'] ?> - <?= $cliente['telefone'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </fieldset>

    <!-- Dados do Agendamento -->
    <fieldset>
      <legend>Agendamento</legend>

      <label for="data">Data</label>
      <input type="date" id="data" name="data" required min="<?= date('Y-m-d') ?>"
        value="<?= $_POST['data'] ?? '' ?>">

      <br><label for="hora">Hora</label>
      <input type="time" id="hora" name="hora" required
        value="<?= $_POST['hora'] ?? '' ?>">

      <br><label for="barbeiro">Barbeiro</label>
      <select id="barbeiro" name="barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php foreach ($listaBarbeiros as $barbeiro): ?>
          <option value="<?= $barbeiro['id_barbeiro'] ?>"
            <?= (isset($_POST['barbeiro']) && $_POST['barbeiro']==$barbeiro['id_barbeiro'])?'selected':'' ?>>
            <?= $barbeiro['nome'] ?>
          </option>
        <?php endforeach; ?>
      </select>

      <br><label for="servicos">Serviços</label><br>
      <?php foreach ($listaServicos as $servico): ?>
        <input type="checkbox" name="servicos[]" value="<?= $servico['id_servico'] ?>"
          <?= (isset($_POST['servicos']) && in_array($servico['id_servico'], $_POST['servicos']))?'checked':'' ?>>
        <?= $servico['nome_servico'] ?> (R$ <?= number_format($servico['preco'], 2, ',', '.') ?>)<br>
      <?php endforeach; ?>
    </fieldset>

    <br><button type="submit">Confirmar Agendamento</button>
  </form>

  <a href="index.php"><button type="button">Sair</button></a>

</body>
</html>
