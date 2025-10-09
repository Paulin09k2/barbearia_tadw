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
    <h1>Serviços da Barbearia</h1>
    <div style="max-width:400px;margin:auto;">
        <div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;border-radius:10px;">
            <h2>Corte de Cabelo</h2>
            <p>Preço: R$ 30,00</p>
        </div>
        <div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;border-radius:10px;">
            <h2>Cabelo e Barba</h2>
            <p>Preço: R$ 50,00</p>
        </div>
        <div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;border-radius:10px;">
            <h2>Barba</h2>
            <p>Preço: R$ 25,00</p>
        </div>
        <a href="formAgendar.php">
            <button style="width:100%;padding:15px;font-size:18px;background:#1a237e;color:#fff;border:none;border-radius:8px;cursor:pointer;">
                Agende aqui
            </button>
        </a>
    </div>
</body>
</html>