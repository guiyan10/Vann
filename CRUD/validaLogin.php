<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta preparada para evitar SQL Injection
    $consulta = $conexao->prepare("SELECT * FROM cadastro WHERE email_usuario = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        if (password_verify($senha, $row['senha_usuario'])) {
            $_SESSION["logado"] = true;
            $_SESSION["dados"] = $row;

            // Redirecionamento com base no nível de acesso
            if ($row['nivel'] == "Administrador") {
                header("Location: ../PaginasAdm/homepage.php");
                exit();
            } else if ($row['nivel'] == "Condutor") {
                header("Location: ../PaginasCondutor/homepage.php");
                exit();
            } else if ($row['nivel'] == "Usuário") {
                header("Location: ../PaginasUsuarios/homepage.php");
                exit();
            }
        } else {
            // Senha incorreta
            header("Location: ../login.php?error=senha_incorreta");
            exit();
        }
    } else {
        // E-mail não encontrado
        header("Location: ../login.php?error=email_nao_encontrado");
        exit();
    }
}
?>
