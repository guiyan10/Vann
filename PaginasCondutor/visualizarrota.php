<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

$id_usuario = $_SESSION['dados']['id_usuario'];

if (isset($_GET['id_aluno'])) {
    $id_aluno = intval($_GET['id_aluno']); // Protege contra SQL Injection

    if (!$conexao) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    $sql = "SELECT nome_aluno, destinoinicial, destinofinal, status_rota FROM alunocondutor WHERE id_aluno = $id_aluno";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $aluno = mysqli_fetch_assoc($resultado);
    } else {
        echo "<p>Aluno não encontrado.</p>";
        exit();
    }

    mysqli_close($conexao);
} else {
    echo "<p>ID do aluno não especificado.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Aluno</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 80px;
            margin: 0;
            color: #333;
        }

        header {
            text-align:center;
            position: fixed;
            width: 100%;
            top: 0;
            background-color: #FFC84E;
            padding: 20px 30px;
            display: flex;
            justify-content: center;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin: 0;
         
        }

        .container {
            width: 90%;
            max-width: 900px;
            background-color: #fff;
            padding: 30px;
            margin-top: 120px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .container h2 {
            font-size: 22px;
            font-weight: bold;
            color: #444;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }

        .container strong {
            font-weight: bold;
            color: #333;
        }

        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

    </style>
</head>
<body>
    <header>
        <a href="homepage.php">
       <img src="../assets/img/VANN.png" width="60%" alt="Logo Vann">
        </a>
    </header>

    <div class="container">
        <h2>Informações do Aluno</h2>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno['nome_aluno']); ?></p>
        <p><strong>Destino Inicial:</strong> <?php echo htmlspecialchars($aluno['destinoinicial']); ?></p>
        <p><strong>Destino Final:</strong> <?php echo htmlspecialchars($aluno['destinofinal']); ?></p>
        <div id="map"></div>
    </div>

    <footer>
        <p>&copy; 2024 VANN. Todos os direitos reservados.</p>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const destinoinicial = "<?php echo htmlspecialchars($aluno['destinoinicial']); ?>";
        const destinofinal = "<?php echo htmlspecialchars($aluno['destinofinal']); ?>";

        // Inicializa o mapa em São Paulo como ponto central
        const map = L.map('map').setView([-23.5505, -46.6333], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // Função para buscar endereço pelo CEP
        async function buscarEnderecoViaCEP(cep) {
            const url = `https://viacep.com.br/ws/${cep.replace('-', '')}/json/`;
            try {
                const response = await axios.get(url);
                if (!response.data || response.data.erro) {
                    console.error("Erro ao buscar o CEP:", cep);
                    return null;
                }
                return `${response.data.logradouro}, ${response.data.localidade}, ${response.data.uf}`;
            } catch (error) {
                console.error("Erro ao buscar endereço no ViaCEP:", error);
                return null;
            }
        }

        // Função para buscar coordenadas via OpenStreetMap (Nominatim)
        async function buscarCoordenadas(endereco) {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(endereco)}`;
            try {
                const response = await axios.get(url);
                if (response.data && response.data.length > 0) {
                    return [parseFloat(response.data[0].lat), parseFloat(response.data[0].lon)];
                }
            } catch (error) {
                console.error("Erro ao buscar coordenadas:", error);
            }
            return null;
        }

        async function initMap() {
            // Busca os endereços a partir dos CEPs
            const origemEndereco = await buscarEnderecoViaCEP(destinoinicial);
            const destinoEndereco = await buscarEnderecoViaCEP(destinofinal);

            if (!origemEndereco || !destinoEndereco) {
                console.error("Não foi possível determinar os endereços.");
                return;
            }

            // Converte os endereços para coordenadas
            const origemCoord = await buscarCoordenadas(origemEndereco);
            const destinoCoord = await buscarCoordenadas(destinoEndereco);

            if (origemCoord) {
                L.marker(origemCoord).addTo(map).bindPopup("Destino Inicial").openPopup();
            }

            if (destinoCoord) {
                L.marker(destinoCoord).addTo(map).bindPopup("Destino Final").openPopup();
            }

            if (origemCoord && destinoCoord) {
                // Adiciona a linha tracejada entre os pontos
                const linha = L.polyline([origemCoord, destinoCoord], {
                    color: 'blue',
                    dashArray: '10, 10', // Linha tracejada
                    weight: 3
                }).addTo(map);

                // Ajusta o mapa para incluir a rota
                map.fitBounds(linha.getBounds());
            }
        }

        initMap();
    </script>
</body>
</html>
