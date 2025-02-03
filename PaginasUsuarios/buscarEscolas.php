<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'banco_vann';
$username = 'root';
$password = '';

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Consulta SQL para buscar todas as escolas distintas dos condutores
$sql = "SELECT DISTINCT escola_condutor FROM condutor";

$stmt = $pdo->prepare($sql);

if ($stmt->execute()) {
    $escolas = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($escolas) {
        // Retornar as escolas como JSON para ser utilizado no JavaScript
        echo json_encode($escolas);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
