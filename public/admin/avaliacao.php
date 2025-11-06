<?php
require_once '../conexao.php';
require_once '../funcoes.php';

$avaliacoes = listarAvaliacoes($conexao);
$mediaGeral = calcularMediaAvaliacoes($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar Avaliações - Barbearia Elite</title>
  <style>
    /* ====== ESTILO GERAL ====== */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0a0a14, #1b1b2f);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #f5b100;
      margin-top: 40px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    a {
      color: #f5b100;
      text-decoration: none;
      margin-top: 20px;
      display: inline-block;
      transition: 0.3s;
    }

    a:hover {
      color: #fff;
      text-decoration: underline;
    }

    p {
      margin: 10px 0 30px;
      font-size: 1.1em;
    }

    /* ====== TABELA ====== */
    table {
      border-collapse: collapse;
      width: 90%;
      max-width: 1000px;
      background: #111827;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      margin-bottom: 40px;
    }

    th, td {
      padding: 15px;
      text-align: center;
    }

    th {
      background-color: #f5b100;
      color: #111;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background-color: #1e293b;
    }

    tr:hover {
      background-color: #334155;
      transition: 0.3s;
    }

    td {
      color: #ddd;
    }

    /* ====== BOTÃO EXCLUIR ====== */
    button {
      background-color: #f5b100;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      color: #111;
      transition: 0.3s;
    }

    button:hover {
      background-color: #fff;
      color: #111;
    }

    /* ====== RESPONSIVIDADE ====== */
    @media (max-width: 768px) {
      table {
        width: 100%;
        font-size: 14px;
      }
      th, td {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <a href="./index.php">← Voltar para a página Admin</a>
  <h1>Gerenciar Avaliações</h1>
  <p>Nota média geral: ⭐ <?= $mediaGeral; ?></p>

  <table>
      <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Barbeiro</th>
          <th>Serviço</th>
          <th>Nota</th>
          <th>Comentário</th>
          <th>Ações</th>
      </tr>

      <?php foreach ($avaliacoes as $a): ?>
          <tr>
              <td><?= $a['idavaliacao']; ?></td>
              <td><?= htmlspecialchars($a['nome_cliente']); ?></td>
              <td><?= htmlspecialchars($a['nome_barbeiro']); ?></td>
              <td><?= htmlspecialchars($a['nome_servico']); ?></td>
              <td>⭐ <?= $a['estrela']; ?></td>
              <td><?= htmlspecialchars($a['comentario']); ?></td>
              <td>
                  <form method="POST" action="../excluirAvaliacao.php" onsubmit="return confirm('Deseja realmente excluir esta avaliação?');">
                      <input type="hidden" name="idavaliacao" value="<?= $a['idavaliacao']; ?>">
                      <button type="submit">Excluir</button>
                  </form>
              </td>
          </tr>
      <?php endforeach; ?>
  </table>

</body>
</html>
