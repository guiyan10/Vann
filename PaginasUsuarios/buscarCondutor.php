<?php
if (isset($_POST['school']) && isset($_POST['neighborhood'])) {
    $school = $_POST['school'];
    $neighborhood = $_POST['neighborhood'];

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

    // Consulta SQL para buscar os condutores que atendem à escola e bairro especificados
    $sql = "SELECT nome, telefone_condutor FROM condutor 
            WHERE escola_condutor = :school 
            AND bairro_condutor = :neighborhood";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':school', $school, PDO::PARAM_STR);
    $stmt->bindParam(':neighborhood', $neighborhood, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $condutores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($condutores) {
            foreach ($condutores as $condutor) {
                echo '<div class="condutores">';
                echo '<div class="card">';
                echo '<p>' . $condutor['nome'] . '</p>';
                echo '<button class="whatsapp-button" onclick="entrarWhatsapp(\'' . $condutor['telefone_condutor'] . '\')" style="padding: 8px 16px; font-size: 14px; background-color: #25D366; color: #fff; border: none; border-radius: 4px; cursor: pointer;"><i class="fab fa-whatsapp"></i> Mandar mensagem</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum condutor encontrado para essa rota.</p>';
        }
    } else {
        echo '<p>Erro ao executar a consulta.</p>';
    }
} else {
    echo '<p>Parâmetros incorretos.</p>';
}
?>
