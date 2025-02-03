<?php
include("../CRUD/conexao.php");
session_start();
if (isset($_SESSION['logado'])){

}else{
  echo'Você não esta logado.';

  header('Location: ./index.php');
  exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <!-- Adicionando folha de estilo e scripts externos -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/localizacaoalunopai.css">
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

    <div class="container" id="container">
      
        <div id="infoViagemContainer" class="informacoesviagem">
            <h2>Informações da Viagem</h2>
           
            <div class="input-with-icon inicio">
                <i class="fas fa-flag-checkered"></i>
                <input type="text" placeholder="Destino inicial" disabled>
            </div>
            <div class="input-with-icon final">
                <i class="fas fa-map-pin"></i>
                <input type="text" placeholder="Destino final" disabled>
            </div>
            <div class="input-with-icon caminho">
                <i class="fas fa-route"></i>
                <input type="text" placeholder="A caminho" disabled>
            </div>
            <!-- Botão de denúncia -->
            <p>Notou algo diferente? Denuncie</p>
            <button class="denuncia">
                Denunciar
            </button>
        </div>
        
        <div id="mapid" class="map-container"></div>
    </div>
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Formulário de Denúncia</h2>
        <form action="./CRUD/cadastrardenuncia.php" method="post" id="denunciaForm">
        <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" class="nomeInput" placeholder="Seu nome" required>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" class="emailInput" placeholder="Seu e-mail" required>
    <label for="descricao">Descrição da denúncia:</label>
    <input id="descricao" name="descricao" class="inputDescricao" placeholder="Descreva a denúncia" rows="4" required></>
    <div class="buttonDiv">
    <button class="buttonEnviar" type="submit">Enviar</button>
    </div>
        </form>
    </div>
</div>

<script src="../assets/js/localizacaoalunopai.js"></script>

</body>
</html>
