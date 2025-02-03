<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include("../SiteVann-php/CRUD/conexao.php");
    
    // Recuperar o email do formulário
    $email = $_POST["email"];

    // Consulta SQL para verificar se o email existe no banco de dados
    $sql = "SELECT * FROM cadastro WHERE email_usuario='$email'";
    $result = $conexao->query($sql);

    // Se o email existir no banco de dados, redirecionar para a página de redefinição de senha
    if ($result->num_rows > 0) {
        // Redirecionamento para a página de redefinição de senha
        header("Location: redefinirsenha.php?email=$email");
        exit();
    } else {
        // Se o email não existir no banco de dados, exibir um modal informando
        // que o email não foi encontrado
        echo '<div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <img src="./assets/img/erro.png" width="25%" class="erro">
                    <p>Email não encontrado. Por favor, verifique o email inserido.</p>
                </div>
              </div>';
        echo '<script>
                // Exibe o modal
                var modal = document.getElementById("myModal");
                modal.style.display = "block";

                // Obtém o botão que fecha o modal
                var span = document.getElementsByClassName("close")[0];

                // Quando o usuário clica no botão (x), fecha o modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // Quando o usuário clica em qualquer lugar fora do modal, fecha o modal
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
              </script>';
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../SiteVann-php/assets/css/esqueci_minha_senha.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <a href="login.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg>
            </a>
            <form action="" method="post">
                <div class="social-icons">
                    <img src="./assets/img/opportunites/LOGO.png">
                </div>
                <span>Esqueceu sua senha? Insira seu email para redefinir sua senha</span>
                <input type="email" placeholder="email" name="email">
                <button type="submit">Redefinir Senha</button>
            </form>
        </div>
    </div>
</body>
</html>
