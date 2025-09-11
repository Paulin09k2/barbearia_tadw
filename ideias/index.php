<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbearia Elite</title>
</head>
<body>
  <h1>Barbearia do Elite</h1>

  <!-- Menu horizontal à direita -->
    <h3 style="display: inline; margin-right: 10px;">Menu</h3>
    <a href="formCliente.php">Cliente</a> |
    <a href="formAgendamento.php">Agendamento</a> |
    <a href="formServicos.php">Serviços</a> |
    <a href="formAvaliaçao.php">Avaliações</a> |
    <a href="formAgendar.php">Agendar</a>
  </div>

  <!-- Carrossel -->
  <div>
    <h2>Galeria</h2>
    <img id="slide" src="foto1.jpg" alt="Imagem da Barbearia" width="400" height="250"><br><br>
    <button onclick="anterior()">&#8592; Anterior</button>
    <button onclick="proximo()">Próxima &#8594;</button>
  </div>

  <script>
    var imagens = ["andre.jpeg", "foto2.jpg", "foto3.jpg", "foto4.jpg"];
    var indice = 0;

    function mostrarImagem() {
      document.getElementById("slide").src = imagens[indice];
    }

    function proximo() {
      indice++;
      if (indice >= imagens.length) {
        indice = 0;
      }
      mostrarImagem();
    }

    function anterior() {
      indice--;
      if (indice < 0) {
        indice = imagens.length - 1;
      }
      mostrarImagem();
    }
  </script>
</body>
</html>
