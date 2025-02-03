<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/redefinirsenha.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg>
            </a>
            <form action="./CRUD/logicaredefinirsenha.php" method="post">
                <div class="social-icons">
                    <img src="./assets/img/opportunites/LOGO.png">
                </div>
                <span>Insira sua senha</span>
                <input type="text" placeholder="Email" name="email">
                <div class="password-field">
                    <input type="password" placeholder="Nova senha" name="nova_senha" id="novaSenha">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('novaSenha')">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                <div class="password-field">
                    <input type="password" placeholder="Confirmar nova senha" name="confirmar_senha" id="confirmarSenha">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('confirmarSenha')">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                <button type="submit">Redefinir Senha</button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            var input = document.getElementById(inputId);
            var icon = input.nextElementSibling.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
