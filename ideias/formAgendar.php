<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";

// Salvar agendamento quando o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_agendamento = $_POST['data'];
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];
    $observacoes = $_POST['observacoes'];

    // Exemplo de função (ajuste conforme seu banco e funcoes.php)
    salvarAgendamento(    $conexao,$data_agendamento,$status,$barbeiro_id_barbeiro,
$cliente_id_cliente);
}

// Buscar todos os agendamentos do banco
$sql = "SELECT id, nome, email, telefone, data, hora, servico, observacoes 
        FROM agendamentos ORDER BY data, hora";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamento</title>
</head>
<body>
  <form action="" method="POST">
    <h2>Agendar Compromisso</h2>

    <label for="nome">Nome Completo</label>
    <input type="text" id="nome" name="nome" required>

    <br><label for="email">E-mail</label>
    <input type="email" id="email" name="email" required>

    <br><label for="telefone">Telefone</label>
    <input type="tel" id="telefone" name="telefone" required>

    <br><label for="data">Data do Agendamento</label>
    <input type="date" id="data" name="data" required>

    <script>
        const hoje = new Date().toISOString().split("T")[0];
        document.getElementById("data").setAttribute("min", hoje);
    </script>

    <br><label for="hora">Hora</label>
    <input type="time" id="hora" name="hora" required>

    <br><label for="servico">Serviço</label>
    <select id="servico" name="servico" required>
      <option value="">Selecione um serviço</option>
      <option value="Corte de cabelo">Corte de cabelo</option>
      <option value="Barba">Barba</option>
      <option value="Corte e Barba">Corte e Barba</option>
      <option value="outro">Outro</option>
    </select>

    <br><label for="observacoes">Observações</label><br>
    <textarea id="observacoes" name="observacoes" rows="4"></textarea>

    <br><button type="submit">Confirmar Agendamento</button>
  </form>

  <a href="index.php"><button>Sair</button></a>
  <link rel="stylesheet" href="desing.css">

  <h2>Agendamentos já realizados</h2>
  <ul>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($c = mysqli_fetch_assoc($result)) {
            echo "<li>
              <strong>ID:</strong> {$c['id']} | 
              <strong>Nome:</strong> {$c['nome']} | 
              <strong>Email:</strong> {$c['email']} | 
              <strong>Telefone:</strong> {$c['telefone']} | 
              <strong>Data:</strong> {$c['data']} | 
              <strong>Hora:</strong> {$c['hora']} | 
              <strong>Serviço:</strong> {$c['servico']}
            </li>";
        }
    } else {
        echo "<li>Nenhum agendamento encontrado.</li>";
    }
    ?>
  </ul>

</body>
</html>

