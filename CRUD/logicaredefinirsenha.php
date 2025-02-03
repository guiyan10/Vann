<?php
 include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nova_senha = $_POST["nova_senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // Verificar se a nova senha e a confirmação da nova senha são iguais
    if ($nova_senha !== $confirmar_senha) {
        echo "A nova senha e a confirmação da nova senha não são iguais.";
    } else {
        // Consultar o banco de dados para verificar se o email existe
        $sql = "SELECT * FROM cadastro WHERE email_usuario='$email'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            // Email encontrado, atualizar a senha no banco de dados
            $hashed_password = password_hash($nova_senha, PASSWORD_DEFAULT);
            $update_sql = "UPDATE cadastro SET senha_usuario='$hashed_password' WHERE email_usuario='$email'";
            if ($conexao->query($update_sql) === TRUE) {
                header("../index.php");
                echo "Senha redefinida com sucesso!";
                
            } else {
                echo "Erro ao redefinir a senha: " . $conexao->error;
                header("../index.php");
            }
        } else {
            // Email não encontrado no banco de dados
            echo "Email não encontrado. Por favor, verifique o email inserido.";
        }
    }
}
?>
