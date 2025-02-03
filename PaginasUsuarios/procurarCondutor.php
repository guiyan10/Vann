<?php
include("../CRUD/conexao.php");

session_start();
if (isset($_SESSION['logado'])){

}else{
  echo'Você não esta logado.';

  header('Location: ../index.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">>

    <link rel="stylesheet" href="../assets/css/procurarCondutor.css">
    <style>
        /* Estilos para o container de busca */
.search-container {
    text-align: center;
    margin-top: 50px;
}

.search-input {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.search-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.search-button:hover {
    background-color: #0056b3;
}

/* Estilos para os resultados de busca */
.search-results {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 16px;
    margin: 8px 0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 500px;
    text-align: left;
}

.card p {
    font-size: 18px;
    margin: 0 0 8px;
    font-weight: bold;
    color: #333;
}

.card button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    text-transform: uppercase;
    width: 100%;
}

.card button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

<header>
    <a href="homepage.php">
        <img src="../assets/img/vannn.png" alt="Logo Vann" width="7%">
    </a>
</header>

<div class="search-container">
    <h1>Procure a melhor rota aqui!</h1>
    <form id="searchForm">
        <input type="text" name="city" class="search-input" placeholder="Cidade...">
        <input type="text" name="school" class="search-input" placeholder="Escola...">
        <input type="text" name="neighborhood" class="search-input" placeholder="Bairro...">
        <button type="button" class="search-button" onclick="search()">Pesquisar</button>
    </form>
</div>

<div class="search-results" id="searchResults">
    <!-- Área onde os resultados serão mostrados -->
</div>

<script>
function search() {
    var formData = new FormData(document.getElementById('searchForm'));

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('searchResults').innerHTML = xhr.responseText;
            } else {
                console.error('Erro ao processar a requisição. Status: ' + xhr.status);
            }
        }
    };

    xhr.open('POST', 'buscarCondutor.php', true);
    xhr.send(formData);
}
</script>

</body>
</html>

