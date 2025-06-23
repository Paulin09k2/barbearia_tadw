<?php
$servidor = 'localhost';
$usuario = 'root';
$password = '123';
$banco = 'barbearia';

$conexao = mysqli_connect($servidor, $usuario, $password, $banco);

if (!$conexao) {
    die("Erro de conexão: " . mysqli_connect_error());
} else {
    echo "Conexão realizada com sucesso!";
}