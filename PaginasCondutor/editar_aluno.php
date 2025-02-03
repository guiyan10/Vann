<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="caminho/para/seu/estilo.css">
    <style>
        /* Estilos adicionais inline (se necessário) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="time"], button {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function confirmarExclusao() {
            if (confirm("Tem certeza que deseja excluir este aluno?")) {
                // Redireciona para a página de exclusão passando o id_aluno
                window.location.href = "excluir_aluno.php?id=<?php echo $id_aluno; ?>";
            }
        }
    </script>
</head>
<body>
    <h1 style="text-align: center;">Editar Aluno</h1>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <div class="container">
        <form action="atualizar_aluno.php" method="POST">
            <?php
            // Verifica se foi passado o id_aluno via GET
            if (isset($_GET['id'])) {
                $id_aluno = $_GET['id'];

                // Aqui você pode realizar a consulta para obter os dados do aluno pelo ID
                // Exemplo básico de conexão e consulta
                include('../CRUD/conexao.php');

                // Verifica se a conexão foi bem-sucedida
                if (!$conexao) {
                    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
                }

                // Query SQL para selecionar os dados do aluno pelo ID
                $sql = "SELECT * FROM alunocondutor WHERE id_aluno = $id_aluno";
                $resultado = mysqli_query($conexao, $sql);

                // Verifica se a consulta retornou algum resultado
                if (mysqli_num_rows($resultado) > 0) {
                    $aluno = mysqli_fetch_assoc($resultado);

                    // Mostra o formulário preenchido com os dados do aluno
                    ?>
                    <input type="hidden" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">

                    <label for="nome_aluno">Nome do Aluno:</label>
                    <input type="text" id="nome_aluno" name="nome_aluno" value="<?php echo $aluno['nome_aluno']; ?>" required>

                    <label for="horarioentrada">Horário de Entrada:</label>
                    <input type="time" id="horarioentrada" name="horarioentrada" value="<?php echo $aluno['horarioentrada']; ?>" required>

                    <label for="horariosaida">Horário de Saída:</label>
                    <input type="time" id="horariosaida" name="horariosaida" value="<?php echo $aluno['horariosaida']; ?>" required>

                    <label for="destinoinicial">Destino Inicial:</label>
                    <input type="text" id="destinoinicial" name="destinoinicial" value="<?php echo $aluno['destinoinicial']; ?>" required>

                    <label for="destinofinal">Destino Final:</label>
                    <input type="text" id="destinofinal" name="destinofinal" value="<?php echo $aluno['destinofinal']; ?>" required>

                    <button type="submit">Salvar Alterações</button>
                    
                    <!-- Botão de Excluir Aluno -->
                    <a href="excluir_aluno.php?id=<?php echo $id_aluno; ?>">
                    <button type="button">Excluir Aluno</button>
                    </a>
                    <?php
                } else {
                    echo "Aluno não encontrado.";
                }

                // Fecha a conexão com o banco de dados
                mysqli_close($conexao);
            } else {
                echo "ID do aluno não especificado.";
            }
            ?>
        </form>
    </div>
</body>
</html>
