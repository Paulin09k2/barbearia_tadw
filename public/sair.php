<?php
// logout.php

// Inicia a sessão — necessário para poder manipulá-la antes de destruí-la
session_start();

// Remove todas as variáveis armazenadas na sessão atual
$_SESSION = [];

// Destroi completamente a sessão do usuário (remove o identificador do servidor)
session_destroy();

// Verifica se o PHP está configurado para usar cookies de sessão
if (ini_get("session.use_cookies")) {
    // Obtém os parâmetros atuais do cookie de sessão (path, domínio, segurança etc.)
    $params = session_get_cookie_params();

    // Define o cookie de sessão com um tempo expirado no passado, invalidando-o
    setcookie(
        session_name(), // nome do cookie da sessão
        '',             // valor vazio
        time() - 42000, // tempo de expiração retroativo (faz o cookie "sumir")
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Após limpar tudo, redireciona o usuário de volta para a página de login
header("Location: login.php");
exit;
