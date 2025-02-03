<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado e se o ID do usuário está definido na sessão
if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: index.php");
    exit();
}

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $horarioEntrada = $_POST['horarioEntrada'];
    $horarioSaida = $_POST['horarioSaida'];
    $destinoInicial = $_POST['destinoInicial'];
    $destinoFinal = $_POST['destinoFinal'];
    $responsavel = $_POST['responsavel'];
    $telefone = $_POST['telefone_responsavel'];
    $mensalidade = $_POST['valor_mensalidade'];
    $data_registro = $_POST['data_registro'];
    $fk_id_condutor = $_SESSION['dados']['id_usuario']; // Captura o fk_id_condutor da sessão

    // Prepara a instrução SQL para inserir os dados
    $sql = "INSERT INTO alunocondutor (nome_aluno, data_nasc, horarioentrada, horariosaida, destinoinicial, destinofinal, id_responsavel, telefone_responsavel, valor_mensalidade, data_registro, fk_id_condutor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        echo "Erro na preparação da consulta: " . $conexao->error;
        exit();
    }

    // Faz o bind dos parâmetros
    $stmt->bind_param("ssssssisssi", $nome, $data_nasc, $horarioEntrada, $horarioSaida, $destinoInicial, $destinoFinal, $responsavel, $telefone, $mensalidade, $data_registro,  $fk_id_condutor);

    // Executa a instrução SQL
    if ($stmt->execute()) {
        // Redireciona para a página inicial do condutor
        header('Location: ../PaginasCondutor/homepage.php');
        exit();
    } else {
        echo "Erro ao executar a consulta SQL: " . $stmt->error;
    }
}
?>
