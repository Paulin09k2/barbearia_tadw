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
      <h2>Cadastrar Cliente</h2>
    <form method="post" action="processa.php">
        <input type="hidden" name="acao" value="salvarCliente">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" required><br>
        Endereço: <input type="text" name="endereco" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        Data de Cadastro: <input type="date" name="data_cadastro" required><br>
        Senha: <input type="password" name="senha_cliente" required><br>
        <button type="submit">Salvar Cliente</button>
    </form>
        <a href="index.php"><button>Sair</button></a>
    <h3>Clientes cadastrados</h3>
    <ul>
        <?php
        $clientes = listarCliente($conexao);
        foreach($clientes as $c){
            echo "<li>ID: {$c['id_cliente']} | Nome: {$c['nome']} | Email: {$c['email']}</li>";
        }
        ?>
    </ul>

    <hr>
</body>
</html>