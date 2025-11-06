<?php
session_start();
require_once '../conexao.php';
require_once '../funcoes.php';

$idusuario = $_SESSION['idusuario'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviços - Barbearia Elite</title>
  <style>
    /* ====== ESTILO GERAL ====== */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0a0a14, #1b1b2f);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      margin-top: 40px;
      color: #f5b100;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    a {
      color: #f5b100;
      text-decoration: none;
      margin: 20px 0;
      display: inline-block;
      transition: 0.3s;
    }

    a:hover {
      color: #fff;
      text-decoration: underline;
    }

    /* ====== CONTAINER ====== */
    .container {
      width: 90%;
      max-width: 1000px;
      background-color: #111827;
      border-radius: 10px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
      padding: 30px;
      margin-bottom: 40px;
      overflow-x: auto;
    }

    /* ====== TABELA ====== */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    }

    th, td {
      padding: 14px;
      text-align: center;
    }

    th {
      background-color: #f5b100;
      color: #111;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background-color: #1e293b;
    }

    tr:nth-child(odd) {
      background-color: #111827;
    }

    tr:hover {
      background-color: #334155;
      transition: 0.3s;
    }

    td {
      color: #ddd;
    }

    /* ====== RESPONSIVO ====== */
    @media (max-width: 768px) {
      table {
        font-size: 13px;
      }
      th, td {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <h1>Serviços</h1>

  <div class="container">
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
          echo "<td>" . htmlspecialchars($s['nome_servico']) . "</td>";
          echo "<td>R$ " . number_format($s['preco'], 2, ',', '.') . "</td>";
          echo "<td>{$s['tempo_estimado']} min</td>";
          echo "<td>" . htmlspecialchars($s['descricao']) . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <a href="./index.php">← Voltar ao Painel do Admin</a>

</body>
</html>
