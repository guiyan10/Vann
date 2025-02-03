<?php
include("../CRUD/conexao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/paineldecontrole.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header>
        <a href="./homepage.php">
        <img src="../assets/img/VANN.png"  class="logo" alt="">
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
        <h1>Cadastrar Aluno</h1>
    </div>
    <form action="../CRUD/cadastraraluno.php" method="post">
        <label for="">Digite o nome do Aluno:</label>
        <input type="text" name="nome">
        <label for="">Data de nascimento:</label>
        <input type="date" name="data_nasc">
        <label for="">Horário de Entrada:</label>
        <input type="time" name="horarioEntrada">
        <label for="">Horário de saída:</label>
        <input type="time" name="horarioSaida">
        <label for="">Destino inicial:</label>
        <input type="text" name="destinoInicial">
        <label for="">Destino final(escola):</label>
        <input type="text" name="destinoFinal">
        <label for="">Responsável</label>
        <select name="responsavel">

        <?php
        include("./CRUD/conexao.php");
  
            
        $sql = "SELECT id_usuario, nome_usuario FROM cadastro WHERE nivel = 'usuario'";
        $result = $conexao->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_usuario'] . "'>" . $row['nome_usuario'] . "</option>";
            }
        } else {
            echo "<option value=''>Nenhum usuário encontrado</option>";
        }
        
        ?>

    </select>
    <button type="submit">Cadastrar</button>
    </form>
</body>
<script src="../assets/js/paineldecontrole.js"></script>
</html>