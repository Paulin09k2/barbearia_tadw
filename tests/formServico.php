<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviços - Barbearia Elite</title>

</head>
<body>
  <h1>Serviços da Barbearia Elite</h1>

  <?php
  $servicos = [
    ["Corte Clássico", 35.00],
    ["Barba Completa", 25.00],
    ["Corte Degradê", 40.00],
    ["Sobrancelha", 15.00],
    ["Hidratação Capilar", 30.00],
    ["Pezinho", 10.00],
    ["Relaxamento", 45.00],
    ["Pintura Capilar", 60.00],
    ["Luzes Masculinas", 70.00],
    ["Corte + Barba", 50.00]
  ];
  ?>

  <div class="container">
    <?php foreach ($servicos as $s): ?>
      <div class="card">
        <h2><?php echo $s[0]; ?></h2>
        <p><strong>Preço:</strong> R$ <?php echo number_format($s[1], 2, ',', '.'); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
