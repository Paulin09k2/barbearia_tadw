<?

$senha = "admin123";

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

var_dump($senha_hash);