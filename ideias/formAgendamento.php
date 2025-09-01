<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
      <h2>Cadastrar Agendamento</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarAgendamento">
        Data: <input type="datetime-local" name="data_agendamento" required><br>
        Status: <input type="text" name="status" required><br>
        ID Barbeiro: <input type="number" name="barbeiro_id_barbeiro" required><br>
        ID Cliente: <input type="number" name="cliente_id_cliente" required><br>
        <button type="submit">Salvar Agendamento</button>
    </form>

    <hr>
</body>
</html>