<?php
// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    include('../CRUD/conexao.php');

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    // Obtém os dados do formulário
    $id_aluno = $_POST['id_aluno'];
    $nome_aluno = $_POST['nome_aluno'];
    $horarioentrada = $_POST['horarioentrada'];
    $horariosaida = $_POST['horariosaida'];
    $destinoinicial = $_POST['destinoinicial'];
    $destinofinal = $_POST['destinofinal'];

    // Query SQL para atualizar os dados do aluno
    $sql = "UPDATE alunocondutor SET 
                nome_aluno = '$nome_aluno',
                horarioentrada = '$horarioentrada',
                horariosaida = '$horariosaida',
                destinoinicial = '$destinoinicial',
                destinofinal = '$destinofinal'
            WHERE id_aluno = $id_aluno";

    // Executa a query de atualização
    if (mysqli_query($conexao, $sql)) {
        header('Location: homepage.php');
        echo "Dados do aluno atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar dados do aluno: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    // Se não foram enviados dados via POST, redireciona para a página anterior ou trata de outra forma
    echo "Formulário não enviado corretamente.";
}
?>
