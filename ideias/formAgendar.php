<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";


// Processar envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = $_POST['nome'];
    $email      = $_POST['email'];
    $telefone   = $_POST['telefone'];
    $endereco   = $_POST['endereco'];
    $data_nasc  = $_POST['data_nascimento'];
    $data_cad   = date("Y-m-d H:i:s");
    $senha      = password_hash("1234", PASSWORD_DEFAULT);

    $data_agendamento = $_POST['data'] . " " . $_POST['hora'];
    $status     = "Pendente";
    $barbeiro_id = $_POST['barbeiro'];
    $servicos   = $_POST['servicos'] ?? [];

    // Salvar cliente
    salvarCliente($conexao, $nome, $email, $telefone, $endereco, $data_nasc, $data_cad, $senha);
    $cliente_id = mysqli_insert_id($conexao);

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

    echo "<p style='color:green'>✅ Agendamento realizado com sucesso!</p>";
}

// Buscar barbeiros
$listaBarbeiros = listarBarbeiro($conexao);

// Buscar serviços
$listaServicos = listaServico($conexao);
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
  <form action="" method="POST">
    <h2>Agendar Compromisso</h2>

    <!-- Dados do Cliente -->
    <fieldset>
      <legend>Dados do Cliente</legend>
      <label for="nome">Nome Completo</label>
      <input type="text" id="nome" name="nome" required>

      <br><label for="email">E-mail</label>
      <input type="email" id="email" name="email" required>

      <br><label for="telefone">Telefone</label>
      <input type="tel" id="telefone" name="telefone" required>

      <br><label for="endereco">Endereço</label>
      <input type="text" id="endereco" name="endereco">

      <br><label for="data_nascimento">Data de Nascimento</label>
      <input type="date" id="data_nascimento" name="data_nascimento">
    </fieldset>

    <!-- Dados do Agendamento -->
    <fieldset>
      <legend>Agendamento</legend>
      <label for="data">Data</label>
      <input type="date" id="data" name="data" required min="<?= date('Y-m-d') ?>">

      <br><label for="hora">Hora</label>
      <input type="time" id="hora" name="hora" required>

      <br><label for="barbeiro">Barbeiro</label>
      <select id="barbeiro" name="barbeiro" required>
        <option value="">Selecione um barbeiro</option>
        <?php foreach ($listaBarbeiros as $barbeiro): ?>
          <option value="<?= $barbeiro['id_barbeiro'] ?>">
            <?= $barbeiro['nome'] ?>
          </option>
        <?php endforeach; ?>
      </select>

      <br><label for="servicos">Serviços</label><br>
      <?php foreach ($listaServicos as $servico): ?>
        <input type="checkbox" name="servicos[]" value="<?= $servico['id_servico'] ?>">
        <?= $servico['nome_servico'] ?> (R$ <?= number_format($servico['preco'], 2, ',', '.') ?>)<br>
      <?php endforeach; ?>
    </fieldset>

    <br><button type="submit">Confirmar Agendamento</button>
  </form>

  <a href="index.php"><button type="button">Sair</button></a>
</body>
</html>
