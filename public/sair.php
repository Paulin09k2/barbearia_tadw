<?php
// logout.php

// Sempre inicia a sessão antes de destruí-la
session_start();

// Limpa todas as variáveis de sessão
$_SESSION = [];

// Destroi a sessão completamente
session_destroy();

// Garante que o cache da página não mantenha o login
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Redireciona para a tela de login
header("Location: login.php");
exit;
