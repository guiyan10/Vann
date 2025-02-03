<?php
session_start();
include '../CRUD/conexao.php';  // Inclua a sua conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['dados']['id_usuario'];
    
    // Pegando os dados do formulário
    $nome_usuario = isset($_POST['nome_usuario']) ? $_POST['nome_usuario'] : '';
    $email_usuario = isset($_POST['email_usuario']) ? $_POST['email_usuario'] : '';
    $endereco_condutor = isset($_POST['endereco_condutor']) ? $_POST['endereco_condutor'] : '';
    $cidade_condutor = isset($_POST['cidade_condutor']) ? $_POST['cidade_condutor'] : '';
    $pais_condutor = isset($_POST['pais_condutor']) ? $_POST['pais_condutor'] : '';
    $sobre_condutor = isset($_POST['sobre_condutor']) ? $_POST['sobre_condutor'] : '';

    // Validação (opcional)
    if (!empty($nome_usuario) && !empty($email_usuario)) {

        // Atualiza a tabela `Cadastro`
        $query_cadastro = "UPDATE Cadastro SET nome_usuario = ?, email_usuario = ? WHERE id_usuario = ?";
        $stmt = $conexao->prepare($query_cadastro);
        $stmt->bind_param('ssi', $nome_usuario, $email_usuario, $usuario_id);
        $stmt->execute();

        // Verifica se já existe um registro na tabela `info_usuario`
        $query_verificar = "SELECT * FROM info_usuario WHERE fk_id_usuario = ?";
        $stmt_verificar = $conexao->prepare($query_verificar);
        $stmt_verificar->bind_param('i', $usuario_id);
        $stmt_verificar->execute();
        $result_verificar = $stmt_verificar->get_result();

        if ($result_verificar->num_rows > 0) {
            // Atualiza a tabela `info_usuario`
            $query_info = "UPDATE info_usuario SET endereco_condutor = ?, cidade_condutor = ?, pais_condutor = ?, sobre_condutor = ? WHERE fk_id_usuario = ?";
            $stmt_info = $conexao->prepare($query_info);
            $stmt_info->bind_param('ssssi', $endereco_condutor, $cidade_condutor, $pais_condutor, $sobre_condutor, $usuario_id);
        } else {
            // Insere novos dados na tabela `info_usuario`
            $query_info = "INSERT INTO info_usuario (endereco_condutor, cidade_condutor, pais_condutor, sobre_condutor, fk_id_usuario) VALUES (?, ?, ?, ?, ?)";
            $stmt_info = $conexao->prepare($query_info);
            $stmt_info->bind_param('ssssi', $endereco_condutor, $cidade_condutor, $pais_condutor, $sobre_condutor, $usuario_id);
        }

        $stmt_info->execute();

        // Redireciona para a página de perfil após a atualização
        header('Location: perfil.php');
        exit();
    } else {
        echo "Nome e email são obrigatórios!";
    }
}
?>
