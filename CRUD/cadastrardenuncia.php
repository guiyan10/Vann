<?php
session_start(); // Inicia a sessão

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO denuncia (nome_usuario, email_usuario, descricao_usuario) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $descricao);

    if ($stmt->execute()) {
        header('Location: ../localizacaoalunopai.php');
        exit();
    } else {
        echo "Erro ao executar a consulta SQL: " . $stmt->error;
    }
}
?>
