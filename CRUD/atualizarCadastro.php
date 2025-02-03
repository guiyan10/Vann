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
    $cnh = $_POST['cnh'];
    $documento_veiculo = $_POST['documento_veiculo'];
    $comprovante_taxas = $_POST['comprovante_taxas'];
    $data_condutor = $_POST['data_condutor'];
    $cpf_condutor = $_POST['cpf_condutor'];
    $rg_condutor = $_POST['rg_condutor'];
    $vistoria_condutor = $_POST['vistoria_condutor'];
    $bairro_condutor = $_POST['bairro_condutor'];
    $escola_condutor = $_POST['escola_condutor'];
    $telefone_condutor = $_POST['telefone_condutor'];
    $fk_id_condutor = $_SESSION['dados']['id_usuario']; // Captura o fk_id_condutor da sessão

    // Prepara a instrução SQL para inserir os dados
    $sql = "INSERT INTO condutor (nome, cnh, documento_veiculo, comprovante_taxas, data_condutor, cpf_condutor, rg_condutor, vistoria_condutor, bairro_condutor, escola_condutor, telefone_condutor, fk_id_condutor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        echo "Erro na preparação da consulta: " . $conexao->error;
        exit();
    }

    // Faz o bind dos parâmetros
    $stmt->bind_param("sssssssssssi", $nome, $cnh, $documento_veiculo, $comprovante_taxas, $data_condutor, $cpf_condutor, $rg_condutor,$vistoria_condutor , $bairro_condutor, $escola_condutor, $telefone_condutor,  $fk_id_condutor);

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
