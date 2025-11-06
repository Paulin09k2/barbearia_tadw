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
    /* ======= ESTILO GERAL ======= */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #0a0a0a; /* igual ao index */
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    a {
      color: #fff;
      text-decoration: none;
      margin: 20px 0;
      display: inline-block;
      border: 1px solid #fff;
      padding: 8px 16px;
      border-radius: 8px;
      transition: 0.3s;
    }

    a:hover {
      background-color: #fff;
      color: #000;
    }

    h1 {
      margin-top: 40px;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-align: center;
    }

    p {
      margin: 10px 0 30px;
      font-size: 1.1em;
    }

    /* ======= CONTAINER ======= */
    .container {
      width: 90%;
      max-width: 1000px;
      background-color: #111;
      border-radius: 10px;
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.05);
      padding: 30px;
      margin-bottom: 40px;
      overflow-x: auto;
    }

    /* ======= TABELA ======= */
    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 15px rgba(255,255,255,0.05);
    }

    th, td {
      padding: 14px;
      text-align: center;
    }

    th {
      background-color: #222;
      color: #fff;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background-color: #1a1a1a;
    }

    tr:nth-child(odd) {
      background-color: #111;
    }

    tr:hover {
      background-color: #2a2a2a;
      transition: 0.3s;
    }

    td {
      color: #ddd;
    }

    /* ======= BOTÃO ======= */
    button {
      background-color: #fff;
      color: #000;
      font-weight: bold;
      border: none;
      padding: 8px 15px;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #ccc;
    }

    /* ======= RESPONSIVO ======= */
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

  <a href="./index.php">← Voltar ao Painel Admin</a>

  <h1>Gerenciar Avaliações</h1>
  <p>Nota média geral: ⭐ <?= $mediaGeral; ?></p>

  <div class="container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Barbeiro</th>
          <th>Serviço</th>
          <th>Nota</th>
          <th>Comentário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
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
      </tbody>
    </table>
  </div>

</body>
</html>
