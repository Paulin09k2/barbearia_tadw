<?php
// Inicia uma nova sessão ou retoma uma sessão existente.
// Necessário para armazenar informações do usuário após o login.
session_start();

// Importa o arquivo de conexão com o banco de dados (provavelmente define $conexao).
require_once "./conexao.php";

// Importa o arquivo com funções auxiliares (onde está a função verificarLogin()).
require_once "./funcoes.php";


// Verifica se o método da requisição é POST, ou seja, se o formulário de login foi enviado.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recebe o e-mail enviado pelo formulário.
    $email = $_POST['email'];

    // Recebe a senha enviada pelo formulário.
    $senha = $_POST['senha'];

    // Chama a função verificarLogin() passando conexão, e-mail e senha.
    // Essa função deve consultar o banco e retornar os dados do usuário se o login for válido.
    $usuario = verificarLogin($conexao, $email, $senha);

    // var_dump($usuario); // Linha comentada, usada para debug (mostrar o conteúdo retornado).

    // Se a função não retornou nenhum usuário (login incorreto):
    if ($usuario === null) {
        // Mostra um alerta no navegador e redireciona de volta para a página de login.
        echo "<script>alert('E-mail ou senha incorretos!'); window.location='login.php';</script>";
        exit; // Encerra o script para evitar que continue executando.
    } else {
        // Se o login foi bem-sucedido, armazena os dados do usuário na sessão.
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['email'] = $usuario['email'];

        // Armazena o tipo de usuário (cliente, barbeiro, etc.) em uma variável local.
        $tipo = $usuario['tipo_usuario'];

        // Se o tipo for 1, é um cliente.
        if ($tipo == 1) {
            // Salva o ID do cliente na sessão (por segurança, usa ?? null caso não exista).
            $_SESSION['id_cliente'] = $usuario['idusuario'] ?? null;

            // Redireciona para o painel do cliente.
            header("Location: ./cliente/index.php");
        }
        // Se o tipo for 2, é um barbeiro (ou administrador).
        elseif ($tipo == 2) {
            // Salva o ID do barbeiro na sessão.
            $_SESSION['id_barbeiro'] = $usuario['idusuario'] ?? null;

            // Redireciona para o painel do barbeiro/admin.
            header("Location: ./admin/index.php");
        }

        // Garante que o script pare após o redirecionamento.
        exit;
    }
} else {
    // Se a página for acessada diretamente (sem POST), redireciona para o login.
    header("Location: login.php");
    exit;
}


// Comentário final indicando que a função verificarLogin() está definida em outro arquivo.
