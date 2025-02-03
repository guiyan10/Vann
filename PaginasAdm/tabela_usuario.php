<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
  header("Location: ../index.php");
  exit();
}

include('../CRUD/conexao.php');

$adm_id = $_SESSION['dados']['id_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários Alunos</title>
    <style>
        /* Estilos Gerais */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding-top: 100px;
            margin: 0;
        }

        header {
            width: 100%;
            background-color: #FFC84E;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 140px;
        }

        .back-button {
            display: inline-block;
            margin: 15px 0;
            padding: 10px 20px;
            background-color: #FFC84E;
            color: #333;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        
        }

        .back-button:hover {
            background-color: #e0a530;
            color: #fff;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        h2 {
            width: 100%;
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 25px;
            font-weight: 600;
        }

        /* Card Style */
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            width: 100%;
            max-width: 320px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-top: 5px solid #FFC84E;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
            line-height: 1.5;
        }

        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #25D366;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .whatsapp-button:hover {
            background-color: #1ebe5d;
        }

        .whatsapp-button img {
            width: 18px;
            height: 18px;
        }

        /* Footer */
        footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }

        footer p {
            font-size: 14px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="./homepage.php">
            <img src="../assets/img/VANN.png" class="logo" alt="Logo">
        </a>
    </header>

    <!-- Botão de Voltar -->
    <a href="javascript:history.back()" class="back-button">← Voltar</a>

    <div class="container">
        <h2>Lista de Alunos Condutores</h2>
        
        <?php
        $sql = "SELECT nome_aluno, data_nasc, valor_mensalidade, telefone_responsavel FROM alunocondutor";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
            <div class="card">
                <h3><?php echo $row['nome_aluno']; ?></h3>
                <p><strong>Data de Nascimento:</strong> <?php echo $row['data_nasc']; ?></p>
                <p><strong>Mensalidade:</strong> R$ <?php echo $row['valor_mensalidade']; ?></p>
                <a href="https://wa.me/<?php echo $row['telefone_responsavel']; ?>" target="_blank" class="whatsapp-button">
                    <img src="../assets/img/whatsapp-icon.png" alt="WhatsApp"> Mandar mensagem
                </a>
            </div>
        <?php
            }
        } else {
            echo "<p>Nenhum aluno condutor encontrado.</p>";
        }
        ?>
    </div>

    <!-- Footer -->
   
</body>
</html>
