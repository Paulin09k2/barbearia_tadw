<?php
// Dados de conexão com o banco de dados
$host = 'localhost';         // ou o IP do servidor do banco
$usuario = 'root';           // seu usuário do banco
$senha = '123';                 // sua senha do banco (vazio por padrão no XAMPP)
$banco = 'banco';    // substitua pelo nome do seu banco de dados

// Criação da conexão
$conexao = new mysqli($host, $usuario, $senha, $banco);


