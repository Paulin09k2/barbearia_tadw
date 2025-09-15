<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
      <h2>Cadastrar Serviço</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarServico">
        Nome Serviço: <input type="text" name="nome_servico" required><br>
        Descrição: <input type="text" name="descricao" required><br>
        Preço: <input type="text" name="preco" required><br>
        Tempo Estimado: <input type="text" name="tempo_estimado" required><br>
        <button type="submit">Salvar Serviço</button>
    </form>
        <a href="index.php"><button>Sair</button></a>
    <h3>Serviços cadastrados</h3>
    <ul>
        <?php
        $servicos = listaServico($conexao);
        foreach($servicos as $s){
            echo "<li>ID: {$s['id_servico']} | Nome: {$s['nome_servico']} | Preço: {$s['preco']}</li>";
        }
        ?>
    </ul>

    <hr>
    <link rel="stylesheet" href="desing.css">
</body>
</html>