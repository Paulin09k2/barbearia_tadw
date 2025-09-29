<?php
    require_once  "../tests/conexao.php";
    require_once "../tests/funcoes.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $idusuario = verificarLogin($conexao, $email, $senha);

        if ($idusuario === false) {
            header("Location: login.php");
            exit;
        } else {
            // Busca os dados do cliente
            $usuario = pegarDadosCliente($conexao, $idusuario);
    
            if ($usuario == 0) {
                header("Location: login.php");
                exit;
            } else {
                session_start();
                $_SESSION['u'] = $usuario;
                header("Location: index.php");
                exit;
            }
        }
    // Nova função para buscar dados do cliente
    function pegarDadosCliente($conexao, $id_cliente) {
        $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'i', $id_cliente);
        mysqli_stmt_execute($comando);
        $resultado = mysqli_stmt_get_result($comando);
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($comando);
        return $usuario ? $usuario : 0;
    }
?>