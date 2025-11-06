<?php
require_once '../conexao.php';
require_once '../funcoes.php';
session_start();

// id do cliente (ajuste conforme sua sessão: idusuario ou id_cliente)
$id_cliente = $_SESSION['idusuario'] ?? $_SESSION['id_cliente'] ?? null;

// busca barbeiros e serviços para popular selects
$barbeiros = [];
$servicos = [];

$res = mysqli_query($conexao, "SELECT id_barbeiro, nome FROM barbeiro ORDER BY nome");
if ($res) while ($r = mysqli_fetch_assoc($res)) $barbeiros[] = $r;

$res = mysqli_query($conexao, "SELECT id_servico, nome_servico FROM servico ORDER BY nome_servico");
if ($res) while ($r = mysqli_fetch_assoc($res)) $servicos[] = $r;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deixe sua Avaliação</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #0f1724;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0
    }

    form {
      background: #09121a;
      padding: 24px;
      border-radius: 10px;
      width: 360px
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600
    }

    select,
    input[type="number"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #233045;
      margin-bottom: 12px;
      background: #e6eef7;
      color: #000
    }

    button {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      background: #f5c400;
      color: #000;
      font-weight: 700;
      cursor: pointer
    }

    .note {
      font-size: 13px;
      color: #cbd5e1;
      margin-bottom: 10px
    }
  </style>
</head>

<body>
  <form action="../salvar_avaliacao.php" method="post" enctype="multipart/form-data">
    <h2>Deixe sua Avaliação</h2>

    <label for="servico">Serviço</label>
    <select id="servico" name="servico_id_servico" required>
      <option value="">-- selecione --</option>
      <?php foreach ($servicos as $s): ?>
        <option value="<?php echo htmlspecialchars($s['id_servico']); ?>"><?php echo htmlspecialchars($s['nome_servico']); ?></option>
      <?php endforeach; ?>
    </select>

    <label for="barbeiro">Barbeiro</label>
    <select id="barbeiro" name="barbeiro_id_barbeiro" required>
      <option value="">-- selecione --</option>
      <?php foreach ($barbeiros as $b): ?>
        <option value="<?php echo htmlspecialchars($b['id_barbeiro']); ?>"><?php echo htmlspecialchars($b['nome']); ?></option>
      <?php endforeach; ?>
    </select>

    <label for="avaliacao">Nota (1 a 5)</label>
    <input type="number" id="avaliacao" name="estrela" min="1" max="5" required>

    <label for="comentario">Comentário</label>
    <textarea id="comentario" name="comentario" rows="4" maxlength="1000" placeholder="Escreva sua experiência (opcional)"></textarea>

    <label for="foto">Foto (opcional, jpg/png até 2MB)</label>
    <input type="file" id="foto" name="foto" accept="image/png, image/jpeg">

    <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($id_cliente); ?>">

    <p class="note">Sua avaliação será exibida imediatamente como "Recente" na sua página.</p>

    <button type="submit">Enviar Avaliação</button>
  </form>
</body>

</html>