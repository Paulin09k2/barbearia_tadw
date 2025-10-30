<?php
  require_once '../conexao.php';
  require_once '../funcoes.php';

  session_start();
  $idusuario = $_SESSION['idusuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avaliação</title>
</head>
<body>
  <form action="salvar_avaliacao.php" method="post" enctype="multipart/form-data">
    <h1>Deixe sua Avaliação</h1>
    <label for="avaliacao">Avaliação (1-5):</label>
    <input type="number" id="avaliacao" name="avaliacao" min="1" max="5" required>
    <br><br>
    <label for="comentario">Comentário:</label>
    <br>
    <textarea id="comentario" name="comentario" rows="4" cols="50"></textarea>
    <br><br>
    <label for="foto">Upload de Foto (opcional):</label>
    <input type="file" name="foto" id="">
    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
    <input type="submit" value="Enviar Avaliação">
  </form>
</body>
</html>