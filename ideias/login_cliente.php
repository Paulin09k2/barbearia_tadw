<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $usuario = verificarLogin($conexao, $email, $senha);

    if ($usuario === null) {
        echo "<script>alert('E-mail ou senha incorretos!'); window.location='login.php';</script>";
        exit;
    } else {
        // Dados de sessão
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['email'] = $usuario['email'];

        // Redireciona conforme tipo
        if ($usuario['tipo_usuario'] == 1) { // cliente
            $_SESSION['id_cliente'] = $usuario['id_cliente'];
            header("Location: ../cliente/index.php");
        } elseif ($usuario['tipo_usuario'] == 2) { // barbeiro
            $_SESSION['id_barbeiro'] = $usuario['id_barbeiro'];
            header("Location: ../barbeiro/index.php");
        } else {
            header("Location: ../admin/index.php");
        }
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
