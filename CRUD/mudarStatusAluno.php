<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

// Obtém o ID do aluno e o status atual
$id_aluno = $_GET['id_aluno'];
$status_atual = $_GET['status_atual'];
$condutor_id = $_SESSION['dados']['id_usuario'];

// Verifica se o aluno está vinculado ao condutor logado
$sql = "SELECT COUNT(*) AS total FROM alunocondutor WHERE id_aluno = ? AND fk_id_condutor = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $id_aluno, $condutor_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    // Se o aluno não estiver vinculado ao condutor logado, exibe uma mensagem de erro
    echo "Erro: Acesso negado. Você não tem permissão para alterar o status deste aluno.";
    exit();
}

// Determina o novo status
$novo_status = ($status_atual == 'Entregue') ? 'Em andamento' : 'Entregue';

// Atualiza o status no banco de dados
$sql = "UPDATE alunocondutor SET status_rota = ? WHERE id_aluno = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("si", $novo_status, $id_aluno);
if ($stmt->execute()) {
    // Redireciona de volta para a página do condutor
    header("Location: ../PaginasCondutor/iniciarrota.php");
    exit();
} else {
    echo "Erro ao atualizar o status: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
