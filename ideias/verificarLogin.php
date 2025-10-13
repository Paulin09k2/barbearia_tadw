<?php
require_once "../tests/conexao.php";
require_once "../tests/funcoes.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verifica o login com a função aprimorada
    $usuario = verificarLogin($conexao, $email, $senha);

    if ($usuario === null) {
        echo "<script>alert('E-mail ou senha incorretos!'); window.location='login.php';</script>";
        exit;
    } else {
        // Armazena os dados do usuário na sessão
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['email'] = $usuario['email'];

        // Redireciona de acordo com o tipo de usuário
        if ($usuario['tipo_usuario'] === 'cliente') {
            $_SESSION['id_cliente'] = $usuario['id_cliente']; // vem da tabela cliente
            header("Location: index.php");
        } elseif ($usuario['tipo_usuario'] === 'barbeiro') {
            $_SESSION['id_barbeiro'] = $usuario['id_barbeiro']; // vem da tabela barbeiro
            header("Location: ../barbeiro/index.php");
        } else {
            // caso seja outro tipo (ex: admin)
            header("Location: ../admin/index.php");
        }
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>

