<?php
require_once "./conexao.php";
require_once "./funcoes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $acao = $_POST['acao'];

  // CLIENTE
  if ($acao == "salvarCliente") {
    salvarCliente($conexao, $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['endereco'], $_POST['data_nascimento'], $_POST['data_cadastro'], $_POST['senha_cliente']);
  }
  if ($acao == "deletarCliente") {
    deletarCliente($conexao, $_POST['id_cliente']);
  }

  // BARBEIRO
  if ($acao == "salvarBarbeiro") {
    salvarBarbeiro($conexao, $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['cpf'], $_POST['data_nascimento'], $_POST['data_admissao'], $_POST['senha_barbeiro']);
  }
  if ($acao == "deletarBarbeiro") {
    deletarBarbeiro($conexao, $_POST['id_barbeiro']);
  }

  // SERVIÇO
  if ($acao == "salvarServico") {
    salvarServico($conexao, $_POST['nome_servico'], $_POST['descricao'], $_POST['preco'], $_POST['tempo_estimado']);
  }
  if ($acao == "deletarServico") {
    deletarServico($conexao, $_POST['id_servico']);
  }

  // AVALIAÇÃO
  if ($acao == "salvarAvaliacao") {
    salvarAvaliacao($conexao, $_POST['estrela'], $_POST['comentario'], $_POST['barbeiro_id_barbeiro'], $_POST['servico_id_servico']);
  }
  if ($acao == "deletarAvaliacao") {
    deletarAvaliacao($conexao, $_POST['idavaliacao']);
  }

  // AGENDAMENTO
  if ($acao == "salvarAgendamento") {
    salvarAgendamento($conexao, $_POST['data_agendamento'], $_POST['status'], $_POST['barbeiro_id_barbeiro'], $_POST['cliente_id_cliente']);
  }
  if ($acao == "deletarAgendamento") {
    deletarAgendamento($conexao, $_POST['id_agendamento'], $_POST['barbeiro_id_barbeiro'], $_POST['cliente_id_cliente']);
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Painel Geral - Barbearia</title>
  <style>
    body {
      font-family: Arial;
      margin: 20px;
    }

    h2 {
      margin-top: 50px;
      color: #333;
    }

    form {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
    }

    input,
    textarea {
      margin: 5px;
      padding: 5px;
    }

    button {
      margin: 5px;
      padding: 5px 10px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 10px;
    }

    th,
    td {
      border: 1px solid #aaa;
      padding: 5px;
    }
  </style>
</head>

<body>
  <h1>Painel Geral - Barbearia</h1>

  <!-- CLIENTE -->
  <h2>Clientes</h2>
  <form method="post">
    <input type="hidden" name="acao" value="salvarCliente">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Telefone: <input type="text" name="telefone" required>
    Endereço: <input type="text" name="endereco" required>
    Nascimento: <input type="date" name="data_nascimento" required>
    Cadastro: <input type="date" name="data_cadastro" required>
    Senha: <input type="password" name="senha_cliente" required>
    <button>Salvar Cliente</button>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>
    <?php foreach (listarCliente($conexao) as $c) { ?>
      <tr>
        <td><?= $c['id_cliente'] ?></td>
        <td><?= $c['nome'] ?></td>
        <td><?= $c['email'] ?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="acao" value="deletarCliente">
            <input type="hidden" name="id_cliente" value="<?= $c['id_cliente'] ?>">
            <button>Excluir</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- BARBEIRO -->
  <h2>Barbeiros</h2>
  <form method="post">
    <input type="hidden" name="acao" value="salvarBarbeiro">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Telefone: <input type="text" name="telefone" required>
    CPF: <input type="text" name="cpf" required>
    Nascimento: <input type="date" name="data_nascimento" required>
    Admissão: <input type="date" name="data_admissao" required>
    Senha: <input type="password" name="senha_barbeiro" required>
    <button>Salvar Barbeiro</button>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Ações</th>
    </tr>
    <?php foreach (listarBarbeiro($conexao) as $b) { ?>
      <tr>
        <td><?= $b['id_barbeiro'] ?></td>
        <td><?= $b['nome'] ?></td>
        <td><?= $b['email'] ?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="acao" value="deletarBarbeiro">
            <input type="hidden" name="id_barbeiro" value="<?= $b['id_barbeiro'] ?>">
            <button>Excluir</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- SERVIÇO -->
  <h2>Serviços</h2>
  <form method="post">
    <input type="hidden" name="acao" value="salvarServico">
    Nome: <input type="text" name="nome_servico" required>
    Descrição: <textarea name="descricao" required></textarea>
    Preço: <input type="text" name="preco" required>
    Tempo Estimado: <input type="text" name="tempo_estimado" required>
    <button>Salvar Serviço</button>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Preço</th>
      <th>Ações</th>
    </tr>
    <?php foreach (listaServico($conexao) as $s) { ?>
      <tr>
        <td><?= $s['id_servico'] ?></td>
        <td><?= $s['nome_servico'] ?></td>
        <td><?= $s['preco'] ?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="acao" value="deletarServico">
            <input type="hidden" name="id_servico" value="<?= $s['id_servico'] ?>">
            <button>Excluir</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- AVALIAÇÃO -->
  <h2>Avaliações</h2>
  <form method="post">
    <input type="hidden" name="acao" value="salvarAvaliacao">
    Estrelas: <input type="number" name="estrela" min="1" max="5" required>
    Comentário: <textarea name="comentario" required></textarea>
    Barbeiro ID: <input type="number" name="barbeiro_id_barbeiro" required>
    Serviço ID: <input type="number" name="servico_id_servico" required>
    <button>Salvar Avaliação</button>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Estrela</th>
      <th>Comentário</th>
      <th>Ações</th>
    </tr>
    <?php foreach (listarAvaliacao($conexao) as $a) { ?>
      <tr>
        <td><?= $a['idavaliacao'] ?></td>
        <td><?= $a['estrela'] ?></td>
        <td><?= $a['comentario'] ?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="acao" value="deletarAvaliacao">
            <input type="hidden" name="idavaliacao" value="<?= $a['idavaliacao'] ?>">
            <button>Excluir</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- AGENDAMENTO -->
  <h2>Agendamentos</h2>
  <form method="post">
    <input type="hidden" name="acao" value="salvarAgendamento">
    Data: <input type="datetime-local" name="data_agendamento" required>
    Status: <input type="text" name="status" required>
    Barbeiro ID: <input type="number" name="barbeiro_id_barbeiro" required>
    Cliente ID: <input type="number" name="cliente_id_cliente" required>
    <button>Salvar Agendamento</button>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Data</th>
      <th>Status</th>
      <th>Ações</th>
    </tr>
    <?php
    $agendamentos = mysqli_query($conexao, "SELECT * FROM agendamento");
    while ($ag = mysqli_fetch_assoc($agendamentos)) { ?>
      <tr>
        <td><?= $ag['id_agendamento'] ?></td>
        <td><?= $ag['data_agendamento'] ?></td>
        <td><?= $ag['status'] ?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="acao" value="deletarAgendamento">
            <input type="hidden" name="id_agendamento" value="<?= $ag['id_agendamento'] ?>">
            <input type="hidden" name="barbeiro_id_barbeiro" value="<?= $ag['barbeiro_id_barbeiro'] ?>">
            <input type="hidden" name="cliente_id_cliente" value="<?= $ag['cliente_id_cliente'] ?>">
            <button>Excluir</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

</body>

</html>