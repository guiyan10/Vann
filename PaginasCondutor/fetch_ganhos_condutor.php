<?php
// Inicie a sessão e recupere o ID do condutor
session_start();
$condutor_id = $_SESSION['dados']['id_usuario'];

// Conexão com o banco de dados (ajuste conforme suas credenciais)
include('../CRUD/conexao.php');

if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Consulta SQL para obter os ganhos mensais do condutor
$sql = "SELECT YEAR(data_registro) AS ano, MONTH(data_registro) AS mes, SUM(valor_mensalidade) AS total_ganho
        FROM alunocondutor
        WHERE fk_id_condutor = $condutor_id
        GROUP BY YEAR(data_registro), MONTH(data_registro)
        ORDER BY ano DESC, mes DESC";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao consultar ganhos mensais: " . mysqli_error($conexao));
}

// Array para armazenar os dados dos ganhos mensais
$dados_ganhos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $dados_ganhos[] = $row;
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);

// Retornar os dados como JSON (opcional, dependendo de como você quer implementar)
echo json_encode($dados_ganhos);
?>
