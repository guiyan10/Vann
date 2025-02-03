<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Reset de estilos e configuração global */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            width: 100%;
            background-color: #FFC84E; /* Amarelo */
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
            justify-content: center;
        }

        .logo {
            width: 150px;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 100px auto 50px;
            animation: fadeIn 1s ease-in-out;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            color: #777;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #555;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus {
            border-color: #FFC84E;
            background-color: #fff;
        }

        button {
            background-color: #dbac4a;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:#a37a25;
        }

        .user-icon {
            cursor: pointer;
            color: white;
            font-size: 1.5em;
        }

        .user-dropdown {
            position: absolute;
            top: 60px;
            right: 20px;
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

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            header {
                padding: 15px;
            }

            .logo {
                width: 120px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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
        <div class="header">
            <h1 class="animate__animated animate__fadeInDown">Formulário de Cadastro de Condutor</h1>
            <p>Preencha o formulário abaixo com os dados necessários:</p>
        </div>

        <form action="../CRUD/atualizarCadastro.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome"><i class="fas fa-user"></i> Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="cnh_ad"><i class="fas fa-id-card"></i> CNH:</label>
                <input type="text" id="cnh_ad" name="cnh" required>
            </div>

            <div class="form-group">
                <label for="documento_veiculo"><i class="fas fa-car"></i> Documento do Veículo:</label>
                <input type="text" id="documento_veiculo" name="documento_veiculo" required>
            </div>

            <div class="form-group">
                <label for="comprovante_taxas"><i class="fas fa-file-alt"></i> Comprovante de Taxas:</label>
                <input type="text" id="comprovante_taxas" name="comprovante_taxas" required>
            </div>

            <div class="form-group">
                <label for="data_condutor"><i class="fas fa-calendar-alt"></i> Data de Nascimento do Condutor:</label>
                <input type="date" id="data_condutor" name="data_condutor" required>
            </div>

            <div class="form-group">
                <label for="cpf_condutor"><i class="fas fa-address-card"></i> CPF do Condutor:</label>
                <input type="text" id="cpf_condutor" name="cpf_condutor" required>
            </div>

            <div class="form-group">
                <label for="rg_condutor"><i class="fas fa-id-badge"></i> RG do Condutor:</label>
                <input type="text" id="rg_condutor" name="rg_condutor" required>
            </div>

            <div class="form-group">
                <label for="vistoria_semob"><i class="fas fa-clipboard-check"></i> Vistoria na SEMOB:</label>
                <input type="text" id="vistoria_semob" name="vistoria_condutor">
            </div>

            <div class="form-group">
                <label for="bairro_condutor"><i class="fas fa-map-marker-alt"></i> Bairro do Condutor:</label>
                <input type="text" id="bairro_condutor" name="bairro_condutor" required>
            </div>

            <div class="form-group">
                <label for="escola_condutor"><i class="fas fa-school"></i> Escola do Condutor:</label>
                <input type="text" id="escola_condutor" name="escola_condutor" required>
            </div>

            <div class="form-group">
                <label for="cidade_condutor"><i class="fas fa-city"></i> Cidade do Condutor:</label>
                <input type="text" id="cidade_condutor" name="cidade_condutor" required>
            </div>

            <div class="form-group">
                <label for="telefone_condutor"><i class="fas fa-phone-alt"></i> Telefone:</label>
                <input type="text" id="telefone_condutor" name="telefone_condutor" required>
            </div>

            <button type="submit">Enviar <i class="fas fa-paper-plane"></i></button>
        </form>
    </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("userDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    </script>

</body>

</html>
