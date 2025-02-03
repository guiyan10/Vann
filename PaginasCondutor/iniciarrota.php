<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

$condutor_id = $_SESSION['dados']['id_usuario'];

// Verifica se o condutor está em rota
$sql_check_route = "SELECT COUNT(*) as em_rota FROM alunocondutor WHERE fk_id_condutor = $condutor_id AND status_rota = 'Em andamento'";
$result_check_route = mysqli_query($conexao, $sql_check_route);
$row_check_route = mysqli_fetch_assoc($result_check_route);
$em_rota = $row_check_route['em_rota'] > 0;

// Se o botão para iniciar ou finalizar a rota foi clicado
if (isset($_POST['iniciar_rota'])) {
    if ($em_rota) {
        // Finaliza a rota
        $sql_update_status = "UPDATE alunocondutor SET status_rota = 'Entregue' WHERE fk_id_condutor = $condutor_id";
        $message = "Rota finalizada.";
    } else {
        // Inicia a rota
        $sql_update_status = "UPDATE alunocondutor SET status_rota = 'Em andamento' WHERE fk_id_condutor = $condutor_id";
        $message = "Rota iniciada.";
    }
    mysqli_query($conexao, $sql_update_status);

    // Redireciona para a mesma página para atualizar a lista de alunos
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Consulta para buscar informações dos alunos
$sql = "SELECT ac.id_aluno, ac.nome_aluno, ac.destinoinicial, ac.destinofinal, ac.status_rota
        FROM alunocondutor ac
        JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario
        WHERE c.id_usuario = $condutor_id";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao consultar alunos: " . mysqli_error($conexao));
}

$alunos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $alunos[] = $row;
}
// Verifica se foi selecionado um filtro de status e nome
$status_filtro = isset($_GET['status_filtro']) ? $_GET['status_filtro'] : '';
$nome_filtro = isset($_GET['nome_filtro']) ? $_GET['nome_filtro'] : '';

// Monta a consulta com base nos filtros de status e nome
$sql = "SELECT ac.id_aluno, ac.nome_aluno, ac.destinoinicial, ac.destinofinal, ac.status_rota
        FROM alunocondutor ac
        JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario
        WHERE c.id_usuario = $condutor_id";

// Se um status foi selecionado no filtro, adiciona a condição na consulta
if (!empty($status_filtro)) {
    $sql .= " AND ac.status_rota = '" . mysqli_real_escape_string($conexao, $status_filtro) . "'";
}

// Se um nome foi digitado no filtro, adiciona a condição na consulta
if (!empty($nome_filtro)) {
    $sql .= " AND ac.nome_aluno LIKE '%" . mysqli_real_escape_string($conexao, $nome_filtro) . "%'";
}

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao consultar alunos: " . mysqli_error($conexao));
}

$alunos = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $alunos[] = $row;
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Rota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/iniciarrota.css">
</head>

<body>
    <header>
        <a href="homepage.php">
            <img src="../assets/img/VANN.png" alt="Logo" class="logo"> 
        </a>
    </header>

    <div class="container">
        <h2>Rota dos Alunos</h2>

        <!-- Botão para iniciar ou finalizar a rota -->
        <div class="btn-container">
            <form action="" method="post">
                <button type="submit" name="iniciar_rota" class="btn-iniciar">
                    <i class="fas fa-<?php echo $em_rota ? 'stop' : 'play'; ?>"></i> <?php echo $em_rota ? 'Finalizar Rota' : 'Iniciar Rota'; ?>
                </button>
            </form><br>
        </div>
<!-- Formulário para Filtrar Alunos por Status e Nome -->
<form method="get" action="">
    <label for="status_filtro">Filtrar por Status:</label>
    <select name="status_filtro" id="status_filtro">
        <option value="">Todos</option>
        <option value="Em andamento" <?php if (isset($_GET['status_filtro']) && $_GET['status_filtro'] == 'Em andamento') echo 'selected'; ?>>Em andamento</option>
        <option value="Entregue" <?php if (isset($_GET['status_filtro']) && $_GET['status_filtro'] == 'Entregue') echo 'selected'; ?>>Entregue</option>
    </select>

    <label for="nome_filtro">Buscar por Nome:</label>
    <input type="text" name="nome_filtro" id="nome_filtro" value="<?php echo isset($_GET['nome_filtro']) ? htmlspecialchars($_GET['nome_filtro']) : ''; ?>" placeholder="Digite o nome do aluno">

    <button type="submit">Filtrar</button>
</form>
<br>


        <p><strong><?php echo $message ?? ''; ?></strong></p>

        <?php foreach ($alunos as $aluno): ?>
            <div class="aluno-card">
                <div class="aluno-info">
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno['nome_aluno']); ?></p>
                    <p><strong>Destino Inicial:</strong> <?php echo htmlspecialchars($aluno['destinoinicial']); ?></p>
                    <p><strong>Destino Final:</strong> <?php echo htmlspecialchars($aluno['destinofinal']); ?></p>
                    <p class="status"><strong>Status:</strong>
                        <div class="status <?php echo str_replace(' ', '-', htmlspecialchars($aluno['status_rota'])); ?>">
                            <?php echo htmlspecialchars($aluno['status_rota']); ?>
                        </div>
                    </p>
                    <div class="button-group">
                        <form action="./visualizarrota.php" method="get" class="form-status">
                            <input type="hidden" name="id_aluno" value="<?php echo htmlspecialchars($aluno['id_aluno']); ?>">
                            <button type="submit" class="btn-rota">
                                <i class="fas fa-map-marker-alt"></i> Visualizar Rota
                            </button>
                        </form>
                        <a class="btn-status" href="../CRUD/mudarStatusAluno.php?id_aluno=<?php echo htmlspecialchars($aluno['id_aluno']); ?>&status_atual=<?php echo urlencode($aluno['status_rota']); ?>">
                            <i class="fas fa-sync-alt"></i> Mudar Status
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>