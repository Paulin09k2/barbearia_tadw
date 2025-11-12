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

    // Se a função não retornou nenhum usuário (login incorreto):
    if ($usuario === null) {
        // Mostra um alerta no navegador e redireciona de volta para a página de login.
        echo "<script>alert('E-mail ou senha incorretos!'); window.location='login.php';</script>";
        exit; // Encerra o script para evitar que continue executando.
    } else {
        // Se o login foi bem-sucedido, armazena os dados do usuário na sessão.
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['email'] = $usuario['email'];

        // Normaliza o tipo de usuário para um código numérico:
        // 1 = cliente, 2 = barbeiro, 3 = admin
        $tipo_raw = $usuario['tipo_usuario'];
        $tipo_normalizado = null;

        if (is_numeric($tipo_raw)) {
            $tipo_normalizado = (int)$tipo_raw;
        } else {
            $t = strtolower(trim($tipo_raw));
            if ($t === 'cliente' || $t === 'client' || $t === '1') $tipo_normalizado = 1;
            elseif ($t === 'barbeiro' || $t === 'barber' || $t === '2') $tipo_normalizado = 2;
            elseif ($t === 'admin' || $t === 'administrador' || $t === '3') $tipo_normalizado = 3;
            else {
                // fallback: se não reconhece, assume cliente
                $tipo_normalizado = 1;
            }
        }

        // Salva o tipo normalizado na sessão para uso posterior
        $_SESSION['tipo_usuario'] = $tipo_normalizado;

        // Redireciona baseado no tipo normalizado
        if ($tipo_normalizado === 1) {
            $_SESSION['id_cliente'] = $usuario['idusuario'] ?? null;
            header("Location: ./cliente/index.php");
        } elseif ($tipo_normalizado === 2) {
            $_SESSION['id_barbeiro'] = $usuario['idusuario'] ?? null;
            header("Location: ./barbeiro/index.php");
        } elseif ($tipo_normalizado === 3) {
            // admin -> também para painel admin
            $_SESSION['id_barbeiro'] = $usuario['idusuario'] ?? null;
            header("Location: ./admin/index.php");
        } else {
            // fallback
            header("Location: ./index.php");
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
