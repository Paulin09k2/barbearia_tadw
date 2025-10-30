<?php
session_start();
require_once "./conexao.php";
require_once "./funcoes.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = verificarLogin($conexao, $email, $senha);
    // var_dump($usuario);

    if ($usuario === null) {
        echo "<script>alert('E-mail ou senha incorretos!'); window.location='login.php';</script>";
        exit;
    } else {
        // Armazena dados do usuário na sessão
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['email'] = $usuario['email'];
        // Redireciona conforme o tipo de usuário
        $tipo = $usuario['tipo_usuario'];

        if ($tipo == 1) {
            $_SESSION['id_cliente'] = $usuario['idusuario'] ?? null;
            header("Location: ./cliente/index.php");
        } elseif ($tipo == 2) {
            $_SESSION['id_barbeiro'] = $usuario['idusuario'] ?? null;
            header("Location: ./admin/index.php");
        }
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}


// Função aprimorada para verificar login (sem PDO)
