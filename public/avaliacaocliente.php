<?php
require_once './conexao.php';
require_once './funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações - Barbearia Elite</title>
    <style>
        /* ====== ESTILO GERAL ====== */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #0b0f16, #0d1117);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            margin-top: 50px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
        }

        a {
            color: #fff;
            text-decoration: none;
            margin: 25px 0;
            display: inline-block;
            transition: 0.3s;
            font-weight: 500;
        }

        a:hover {
            color: #d1d5db;
            /* text-gray-300 */
            transform: translateY(-2px);
        }

        /* ====== CONTAINER ====== */
        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #141a22;
            /* mesmo tom dos cards */
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(255, 255, 255, 0.05);
            padding: 30px;
            margin-bottom: 50px;
            border: 1px solid #1f2937;
            /* cor da borda */
            overflow-x: auto;
            transition: 0.3s;
        }

        .container:hover {
            box-shadow: 0 6px 30px rgba(255, 255, 255, 0.08);
        }

        /* ====== TABELA ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 12px;
            overflow: hidden;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
        }

        th {
            background-color: #0d1b2a;
            /* mesma navbar do painel */
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #1f2937;
        }

        tr:nth-child(even) {
            background-color: #141a22;
            /* tom escuro principal */
        }

        tr:nth-child(odd) {
            background-color: #0d1117;
            /* leve variação */
        }

        tr:hover {
            background-color: #1e293b;
            /* destaque hover */
            transition: 0.3s;
        }

        td {
            color: #d1d5db;
            /* cinza claro */
            font-size: 15px;
        }

        .foto-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #1f2937;
            cursor: pointer;
            transition: 0.3s;
        }

        .foto-img:hover {
            transform: scale(1.05);
            border-color: #fff;
        }

        .sem-foto {
            color: #999;
            font-size: 13px;
            font-style: italic;
        }

        .estrelas {
            color: #ffd54f;
            font-weight: bold;
            font-size: 15px;
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 16px;
        }

        .total-avaliacoes {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            color: #d1d5db;
            font-weight: 500;
        }

        /* ====== RESPONSIVO ====== */
        @media (max-width: 768px) {
            table {
                font-size: 13px;
            }

            th,
            td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <h1>📋 Avaliações</h1>

    <?php
    // Busca todas as avaliações do banco
    $avaliacoes = listarAvaliacoes($conexao);

    if (empty($avaliacoes)):
    ?>
        <div class="container empty-message">
            <p>Nenhuma avaliação registrada ainda.</p>
        </div>
    <?php
    else:
    ?>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Barbeiro</th>
                        <th>Serviço</th>
                        <th>Nota</th>
                        <th>Comentário</th>
                        <th>Foto</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($avaliacoes as $avaliacao): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($avaliacao['idavaliacao']); ?></strong></td>
                            <td><?php echo htmlspecialchars($avaliacao['nome_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($avaliacao['nome_barbeiro']); ?></td>
                            <td><?php echo htmlspecialchars($avaliacao['nome_servico']); ?></td>
                            <td class="estrelas">⭐ <?php echo htmlspecialchars($avaliacao['estrela']); ?>/5</td>
                            <td>
                                <?php
                                $comentario = htmlspecialchars($avaliacao['comentario']);
                                echo (strlen($comentario) > 50) ? substr($comentario, 0, 50) . '...' : $comentario;
                                ?>
                            </td>
                            <td>
                                <?php if (!empty($avaliacao['foto'])): ?>
                                    <img src="./img/avaliacoes/<?php echo htmlspecialchars($avaliacao['foto']); ?>"
                                        alt="Foto" class="foto-img"
                                        onclick="window.open(this.src, '_blank');">
                                <?php else: ?>
                                    <span class="sem-foto">—</span>
                                <?php endif; ?>
                            </td>
                            <td>R$ <?php echo number_format($avaliacao['preco'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="total-avaliacoes">
            Total de avaliações: <strong><?php echo count($avaliacoes); ?></strong>
        </div>
    <?php
    endif;
    ?>

    <a href="./">← Voltar</a>

</body>

</html>