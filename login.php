<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <title>VANN Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<style>
    .social-icons img {
        width: 100px;
        margin-bottom: 20px;
    }

    span {
        display: block;
        margin-bottom: 15px;
        font-size: 14px;
        color: #555;
    }

    /* Estilo da mensagem de erro */
    .error-message {
        color: #ff4d4d;
        background-color: #ffe6e6;
        border: 1px solid #ff4d4d;
        padding: 8px;
        border-radius: 5px;
        margin-top: 10px;
        font-size: 14px;
        display: none;
        /* Oculta a mensagem inicialmente */
    }

    /* Estilo dos inputs com erro */
    .input-group.error input {
        border-color: #ff4d4d;
    }
</style>

<body>
    <div class="container">
        <div class="login-form">
            <form action="./CRUD/validaLogin.php" method="post" onsubmit="return validateForm()">
                <div class="logo">
                    <a href="index.php">
                        <img src="./assets/img/opportunites/LOGO.png" alt="VANN Logo">
                    </a>
                </div>
                <h2>Entrar</h2>
                <div class="input-group" id="email-group">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="input-group" id="senha-group">
                    <input type="password" placeholder="Senha" name="senha" required>
                    <i class="fas fa-lock"></i>
                </div>
                <span id="error-message" class="error-message"></span> <!-- Mensagem de erro -->
                <a href="./esqueci_minha_senha.php">Esqueceu sua senha?</a><br>
                <button type="submit">Entrar</button>
            </form>
            <p>Não tem uma conta? <a href="register.php">Registrar-se</a></p>
        </div>
    </div>

    <script>
        // script.js
document.addEventListener("DOMContentLoaded", function() {
    // Verifica se há um parâmetro "error" na URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get("error");

    if (error) {
        const errorMessageElement = document.getElementById("error-message");
        
        if (error === "senha_incorreta") {
            errorMessageElement.innerText = "Senha incorreta. Tente novamente.";
        } else if (error === "email_nao_encontrado") {
            errorMessageElement.innerText = "Email não encontrado. Verifique o email e tente novamente.";
        }

        errorMessageElement.style.display = "block";

        // Estilo de erro para os inputs
        document.getElementById("email-group").classList.add("error");
        document.getElementById("senha-group").classList.add("error");
    }
});

    </script>
</body>

</html>