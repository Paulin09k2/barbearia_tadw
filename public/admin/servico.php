<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';

$idusuario = $_SESSION['idusuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SERVIÇO</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h1>Serviço</h1>
  <table>
    <thead>
      <tr>
        <th>Serviço</th>
        <th>Preço</th>
        <th>Tempo Estimado</th>
        <th>Descrição</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servicos = listarServicosDisponiveis($conexao);
      foreach ($servicos as $s) {
        echo "<tr>";
        echo "<td>{$s['nome_servico']}</td>";
        echo "<td>R$ {$s['preco']}</td>";
        echo "<td>{$s['tempo_estimado']} min</td>";
        echo "<td>{$s['descricao']}</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <a href="./index.php">Voltar ao Painel do Admin</a>
</body>
</html>