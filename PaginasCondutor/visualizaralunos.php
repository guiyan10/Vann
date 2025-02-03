<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header("Location: ../index.php");
    exit();
}

// Inclui o arquivo de conexão
include('../CRUD/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        header h1, footer p {
            margin: 0;
        }
        main {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .whatsapp-icon {
            color: #25d366;
            font-size: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Lista de Alunos</h1>
</header>

<main>
    <table>
        <thead>
            <tr>
                <th>ID Aluno</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Horário de Entrada</th>
                <th>Horário de Saída</th>
                <th>Destino Inicial</th>
                <th>Destino Final</th>
                <th>ID Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Executa a consulta SQL para obter os dados da tabela alunocondutor
            $sql = "SELECT * FROM alunocondutor";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_aluno'] . "</td>";
                    echo "<td>" . $row['nome_aluno'] . "</td>";
                    echo "<td>" . $row['data_nasc'] . "</td>";
                    echo "<td>" . $row['horarioentrada'] . "</td>";
                    echo "<td>" . $row['horariosaida'] . "</td>";
                    echo "<td>" . $row['destinoinicial'] . "</td>";
                    echo "<td>" . $row['destinofinal'] . "</td>";
                    echo "<td>" . $row['id_responsavel'] . "</td>";
                    echo "<td class='actions'>";
                    echo "<a href='visualizarrota.php?id=" . $row['id_aluno'] . "'>Visualizar Rota</a>";
                    echo "<a href='https://wa.me/?text=Olá%20" . urlencode($row['nome_aluno']) . "' target='_blank'><i class='fab fa-whatsapp whatsapp-icon'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhum aluno encontrado.</td></tr>";
            }

            $conexao->close();
            ?>
        </tbody>
    </table>
</main>

<footer>
    <p>Footer - Informações da empresa</p>
</footer>

</body>
</html>
