<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <title>Registrar-se</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<style>
    .logo img {
    max-width: 100px;
    margin-bottom: 20px;
}

.select-group {
    position: relative;
    margin-bottom: 20px;
}

.select-group select {
    padding-left: 45px;
}

.select-group i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #999;
}

</style>
<body>
    <div class="container">
        <div class="register-form">
            <form action="../sitevann-php/CRUD/cadastrarUsuario.php" method="post">
                <div class="logo">
                    <img src="./assets/img/opportunites/LOGO.png" alt="VANN Logo">
                </div>
                <h2>Criar Conta</h2>
                <div class="input-group">
                    <input type="text" placeholder="Nome" name="nome" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Senha" name="senha" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="input-group">
                    <select name="nivel" required>
                        <option value="" disabled selected>Nível de Acesso</option>
                        <option value="usuario">Usuário (Responsável)</option>
                        <option value="condutor">Condutor</option>
                        <option value="administrador">Administrador</option>
                    </select>
                    <i class="fas fa-users-cog"></i>
                </div>
                <button type="submit">Registrar-se</button>
            </form>
            <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>
</html>
