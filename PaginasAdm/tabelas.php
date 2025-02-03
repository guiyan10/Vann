<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Tabelas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 89vh;
            color: #333;
        }

        header {
            width: 100%;
            background-color: #FFC84E;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 150px;
        }

        .container {
            margin-top: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        a {
            text-decoration: none;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            width: 80%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid #FFC84E;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        .card i {
            font-size: 50px;
            color: #FFC84E;
            margin-bottom: 15px;
            transition: color 0.3s;
        }

        .card:hover i {
            color: #ffa726;
        }

        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #FFC84E;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #ffa726;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #000;
            color: #fff;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
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

    <div class="container">
        <a href="tabela_usuario.php">
            <div class="card">
                <i class="fas fa-users"></i>
                <h2>Usuários</h2>
                <p>Visualize a tabela dos usuários registrados no sistema.</p>
                <button class="button">Acessar</button>
            </div>
        </a>
        <a href="tabela_condutor.php">
            <div class="card">
                <i class="fas fa-user-tie"></i>
                <h2>Condutores</h2>
                <p>Visualize a tabela dos condutores registrados no sistema.</p>
                <button class="button">Acessar</button>
            </div>
        </a>
    </div>

    <footer>
        <p>&copy; 2024 VANN. Todos os direitos reservados.</p>
    </footer>
</body>

</html>
