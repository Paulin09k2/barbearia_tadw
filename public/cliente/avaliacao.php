<?php
  require_once '../conexao.php';
  require_once '../funcoes.php';

  session_start();
  $idusuario = $_SESSION['idusuario'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avaliação</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      width: 400px;
      text-align: center;
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
    }

    /* Estilo das estrelas */
    .rating {
      display: flex;
      justify-content: center;
      flex-direction: row-reverse;
      margin-bottom: 20px;
    }

    .rating input {
      display: none;
    }

    .rating label {
      font-size: 35px;
      color: #ccc;
      cursor: pointer;
      transition: color 0.2s;
    }

    .rating input:checked ~ label {
      color: #f5b301;
    }

    .rating label:hover,
    .rating label:hover ~ label {
      color: #ffca28;
    }

    textarea {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      resize: none;
    }

    input[type="file"] {
      margin-top: 10px;
    }

    input[type="submit"] {
      background-color: #f5b301;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 15px;
    }

    input[type="submit"]:hover {
      background-color: #e0a800;
    }
  </style>
</head>
<body>
  <form action="../salvar_avaliacao.php" method="post" enctype="multipart/form-data">
    <h1>Deixe sua Avaliação</h1>

    <div class="rating">
      <input type="radio" name="avaliacao" id="estrela5" value="5" required>
      <label for="estrela5">★</label>
      <input type="radio" name="avaliacao" id="estrela4" value="4">
      <label for="estrela4">★</label>
      <input type="radio" name="avaliacao" id="estrela3" value="3">
      <label for="estrela3">★</label>
      <input type="radio" name="avaliacao" id="estrela2" value="2">
      <label for="estrela2">★</label>
      <input type="radio" name="avaliacao" id="estrela1" value="1">
      <label for="estrela1">★</label>
    </div>

    <label for="comentario">Comentário:</label><br>
    <textarea id="comentario" name="comentario" rows="4" cols="50"></textarea>
    <br><br>

    <label for="foto">Upload de Foto (opcional):</label><br>
    <input type="file" name="foto" id="foto"><br>

    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

    <input type="submit" value="Enviar Avaliação">
  </form>
</body>
</html>
