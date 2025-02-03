<?php
// Conexão com o banco de dados
include '../CRUD/conexao.php';

// Verifica a conexão


// Verifica se um arquivo foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define extensões de arquivo permitidas
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Define o caminho onde você deseja salvar o arquivo
            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . $fileName;

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Insere informações no banco de dados
                $userId = 1; // Altere isso para o ID do usuário atual (como você obtém isso depende da sua lógica de autenticação)
                $sql = "UPDATE cadastro SET imagem_perfil = ? WHERE id_usuario= ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("si", $dest_path, $userId);
                
                if ($stmt->execute()) {
                    header("Location:perfil.php");
                } else {
                    echo "Error: " . $stmt->error;
                }
                
                $stmt->close();
            } else {
                echo 'There was an error uploading the file.';
            }
        } else {
            echo 'Upload failed. Allowed file types: ' . implode(', ', $allowedfileExtensions);
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
    }
}

$conexao->close();
?>
