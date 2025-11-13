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
</head>
<body>
  <h1>Serviço</h1>
    <style>
    /* ====== ESTILO GERAL ====== */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom, #0b0f16, #0d1117);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      margin-top: 50px;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    a {
      color: #fff;
      text-decoration: none;
      margin: 25px 0;
      display: inline-block;
      transition: 0.3s;
      font-weight: 500;
    }

    a:hover {
      color: #d1d5db; /* text-gray-300 */
      transform: translateY(-2px);
    }

    /* ====== CONTAINER ====== */
    .container {
      width: 90%;
      max-width: 1000px;
      background-color: #141a22; /* mesmo tom dos cards */
      border-radius: 16px;
      box-shadow: 0 4px 25px rgba(255, 255, 255, 0.05);
      padding: 30px;
      margin-bottom: 50px;
      border: 1px solid #1f2937; /* cor da borda */
      overflow-x: auto;
      transition: 0.3s;
    }

    .container:hover {
      box-shadow: 0 6px 30px rgba(255, 255, 255, 0.08);
    }

    /* ====== TABELA ====== */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 12px;
      overflow: hidden;
    }

    th, td {
      padding: 14px;
      text-align: center;
    }

    th {
      background-color: #0d1b2a; /* mesma navbar do painel */
      color: #fff;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 2px solid #1f2937;
    }

    tr:nth-child(even) {
      background-color: #141a22; /* tom escuro principal */
    }

    tr:nth-child(odd) {
      background-color: #0d1117; /* leve variação */
    }

    tr:hover {
      background-color: #1e293b; /* destaque hover */
      transition: 0.3s;
    }

    td {
      color: #d1d5db; /* cinza claro */
      font-size: 15px;
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
<?php
  $servicos = listarServicosDisponiveis($conexao);
foreach ($servicos as $s) {
    echo "<p><strong>{$s['nome_servico']}</strong> - R$ {$s['preco']} ({$s['tempo_estimado']} min)<br>{$s['descricao']}</p>";
}
?>
  <a href="./index.php">Voltar ao Painel do Cliente</a>
</body>
</html>