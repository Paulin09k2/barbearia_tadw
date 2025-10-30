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
<?php
  $servicos = listarServicosDisponiveis($conexao);
foreach ($servicos as $s) {
    echo "<p><strong>{$s['nome_servico']}</strong> - R$ {$s['preco']} ({$s['tempo_estimado']} min)<br>{$s['descricao']}</p>";
}
?>
  <a href="./index.php">Voltar ao Painel do Cliente</a>
</body>
</html>