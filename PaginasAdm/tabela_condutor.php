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
    <title>Lista de Condutores</title>
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

        .user-icon {
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 30px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
        }

        .user-dropdown a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
            padding: 8px;
            display: block;
            transition: background-color 0.3s;
        }

        .user-dropdown a:hover {
            background-color: #f1f1f1;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            align-items: center;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #FFC84E;
            color: #fff;
            font-weight: bold;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        button {
            background-color: #25D366;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        button:hover {
            background-color: #1ebe5d;
        }

        .fa-whatsapp {
            margin-right: 8px;
        }

        /* Botão de Voltar */
        .btn-voltar {
            background-color: #FFC84E;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-voltar i {
            margin-right: 8px;
        }

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

            table {
                width: 100%;
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<header>
    <a href="./homepage.php">
        <img src="../assets/img/VANN.png" class="logo" alt="Logo">
    </a>
    <div class="user-icon" onclick="toggleDropdown()">
        <i class="fas fa-user"></i>
    </div>

    <div class="user-dropdown" id="userDropdown">
        <a href="#">Suporte</a>
        <a href="#">Gerenciar Conta</a>
        <a href="#">Configurações</a>
    </div>
</header>

<div class="container">
    <!-- Botão de Voltar -->
    <a href="javascript:history.back()" class="btn-voltar">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <h2>Lista de Condutores</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CNH</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT nome, cnh, data_condutor, telefone_condutor FROM condutor";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td data-label="Nome"><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td data-label="CNH"><?php echo htmlspecialchars($row['cnh']); ?></td>
                        <td data-label="Data de Nascimento"><?php echo htmlspecialchars($row['data_condutor']); ?></td>
                        <td data-label="Telefone">
                            <button onclick="entrarWhatsapp('<?php echo htmlspecialchars($row['telefone_condutor']); ?>')">
                                <i class="fa fa-whatsapp"></i> Mandar mensagem
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum condutor encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function entrarWhatsapp(telefone) {
        if (telefone) {
            const mensagem = encodeURIComponent(''); // Mensagem vazia ou predefinida
            const url = `https://api.whatsapp.com/send/?phone=${telefone}&text=${mensagem}`;
            window.open(url, '_blank');
        } else {
            alert('Número de telefone não encontrado.');
        }
    }

    function toggleDropdown() {
        const dropdown = document.getElementById("userDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // Fecha o dropdown se o usuário clicar fora
    window.onclick = function(event) {
        if (!event.target.matches('.user-icon')) {
            const dropdowns = document.getElementsByClassName("user-dropdown");
            for (let i = 0; i < dropdowns.length; i++) {
                dropdowns[i].style.display = "none";
            }
        }
    }
</script>
</body>
</html>
