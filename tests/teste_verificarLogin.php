<?php

$email = "ipo@gmail.com";
$senha = "senha123";

require_once "../public/conexao.php";
require_once "../public/funcoes.php";

$usuario = verificarLogin($conexao, "ipo@gmail.com", "senha123");
var_dump($usuario);