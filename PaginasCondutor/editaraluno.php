<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

$id_usuario = $_SESSION['dados']['id_usuario'];




?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="caminho/para/seu/estilo.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <script>
        function confirmarExclusao() {
            if (confirm("Tem certeza que deseja excluir este aluno?")) {
                window.location.href = "excluir_aluno.php?id=<?php echo $id_aluno; ?>";
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            width: 100%;
            background-color: #FFC84E;
            color: #000;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 100%;
            text-align: center;
        }

        .user-icon {
            cursor: pointer;
            position: relative;
            color: black;
            margin-right: 50px;
            font-size: 2em;
        }

        .user-dropdown {
            position: absolute;
            top: 70px;
            right: 43px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            display: none;
            z-index: 1001;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-dropdown a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 5px 0;
        }

        .user-dropdown a:hover {
            background-color: #f0f0f0;
        }

        .container {
            width: 50%;
            max-width: 1200px;
            background-color: #fff;
            box-shadow: 0px 0px 6px 1px #80808038;
            border-radius: 10px;
            margin-top: 170px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            color: #333;
            margin-top: 10px;
            width: 100%;
            max-width: 800px;
            text-align: left;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            max-width: 800px;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        select:focus {
            border-color: #ffcc00;
            outline: none;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #ffcc00;
            color: white; 
            border: none;
            padding: 15px 30px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
            max-width: 500px;
            font-size: 16px;
            font-weight: bold;
        }

        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="./homepage.php">
            <img src="../assets/img/VANN.png"  width="150px">
            </a>
        </div>
        
    </header>

    <h1>Editar Aluno</h1>

    <div class="container">
        <form action="atualizar_aluno.php" method="POST">
            <?php
            if (isset($_GET['id'])) {
                $id_aluno = $_GET['id'];
                include('../CRUD/conexao.php');

                if (!$conexao) {
                    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM alunocondutor WHERE id_aluno = $id_aluno";
                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    $aluno = mysqli_fetch_assoc($resultado);
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
                    <button type="button" onclick="confirmarExclusao()">Excluir Aluno</button>
                    <?php
                } else {
                    echo "Aluno não encontrado.";
                }

                mysqli_close($conexao);
            } else {
                echo "ID do aluno não especificado.";
            }
            ?>
        </form>
    </div>
    <script>
        function confirmarExclusao() {
            if (confirm("Tem certeza que deseja excluir este aluno?")) {
                // Redireciona para a página de exclusão passando o id_aluno
                window.location.href = "excluir_aluno.php?id=<?php echo $id_aluno; ?>";
            }
        }
    </script>
</body>
</html>
