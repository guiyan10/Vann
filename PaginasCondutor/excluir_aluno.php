<?php
// Verifica se o parâmetro id_aluno foi passado via GET
if (isset($_GET['id'])) {
    $id_aluno = $_GET['id'];

    // Conexão com o banco de dados
    include('../CRUD/conexao.php');

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Query SQL para excluir o aluno
    $sql = "DELETE FROM alunocondutor WHERE id_aluno = $id_aluno";

    // Executa a query de exclusão
    if (mysqli_query($conexao, $sql)) {
        header('Location: homepage.php');
        echo "Aluno excluído com sucesso.";
    } else {
        echo "Erro ao excluir aluno: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "ID do aluno não especificado.";
}
?>
