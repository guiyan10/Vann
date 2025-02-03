<?php
session_start(); // Inicia a sessão

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['nome'];
    $nome = $_POST['email'];
    $nivel = $_POST['nivel'];
    $senha_cripto = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO cadastro (nome_usuario, email_usuario, nivel, senha_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $nome, $nivel, $senha_cripto);

    if ($stmt->execute()) {
        header('Location: ../index.php');
        exit();
    } else {
        echo "Erro ao executar a consulta SQL: " . $stmt->error;
    }
}
?>
