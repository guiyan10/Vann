<?php
session_start();
$condutor_id = $_SESSION['dados']['id_usuario'];
$results_per_page = 5;

// Verifica se a página atual foi definida na URL, caso contrário, define como 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

// Conexão com o banco de dados
include('../CRUD/conexao.php');

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Query SQL para buscar os alunos do condutor logado com limite para paginação
$sql = "SELECT ac.id_aluno, ac.nome_aluno, ac.data_nasc, ac.horarioentrada, ac.horariosaida, 
               ac.destinoinicial, ac.destinofinal, ac.id_responsavel,
                CONCAT('<button class=\"btn btn-info edit\" onclick=\"editarAluno(', ac.id_aluno, ')\"><i class=\"fas fa-sharp fa-light fa-pencil\"></i> </button>') AS btn_editar,
               
               CONCAT('<button class=\"btn btn-info\" onclick=\"visualizarRota(', ac.id_aluno, ')\"><i class=\"fas fa-map-marker-alt\"></i> Visualizar Rota</button>') AS btn_visualizar_rota,
               CONCAT('<button class=\"zap\" onclick=\"entrarWhatsapp(', ac.telefone_responsavel, ')\"><i class=\"fab fa-whatsapp\"></i> Entrar no WhatsApp</button>') AS btn_whatsapp
        FROM alunocondutor ac
        JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario
        WHERE c.id_usuario = $condutor_id
        LIMIT $start_from, $results_per_page";

// Executa a consulta SQL
$resultado = mysqli_query($conexao, $sql);

// Verifica se houve algum erro na execução da consulta
if (!$resultado) {
    die("Erro ao consultar alunos: " . mysqli_error($conexao));
}

// Prepara os dados para retornar como JSON
$data = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $data[] = $row;
}

// Paginação
$sql = "SELECT COUNT(ac.id_aluno) AS total 
        FROM alunocondutor ac 
        JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario 
        WHERE c.id_usuario = $condutor_id";
$resultado = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($resultado);
$total_pages = ceil($row['total'] / $results_per_page);

// Fecha a conexão com o banco de dados
mysqli_close($conexao);

echo json_encode(['data' => $data, 'total_pages' => $total_pages]);
?>
