<?php
require_once "../conexao.php";
require_once "../funcoes.php";

$clientes = listarCliente($conexao);

echo "<pre>";
print_r($clientes);
echo "</pre>";
?>