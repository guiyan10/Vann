<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        /* Estilo básico para o chat */
        body {
            font-family: Arial, sans-serif;
        }
        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .message {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            position: relative;
        }
        .message p {
            margin: 0;
        }
        .message.user1 {
            background-color: #dff0d8;
            text-align: right;
        }
        .message.user1 p {
            text-align: left;
        }
        .message.user2 {
            background-color: #d9edf7;
        }
        .message.user2 p {
            text-align: left;
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Chat</h2>
        <div class="messages">
            <?php
            // Carregar mensagens existentes do arquivo de texto
            $messages = file("chat.txt");
            if ($messages) {
                foreach ($messages as $key => $message) {
                    $user = $key % 2 == 0 ? 'user1' : 'user2';
                    echo "<div class='message $user' data-index='$key'><p>$message</p>";
                    echo "<span class='delete-btn' onclick='deleteMessage($key)'>&times;</span></div>";
                }
            } else {
                echo "<p>Nenhuma mensagem ainda.</p>";
            }
            ?>
        </div>
        <form method="post" action="enviar_mensagem.php">
            <input type="text" name="message" placeholder="Digite sua mensagem" required>
            <input type="submit" value="Enviar">
        </form>
    </div>

    <script>
        function deleteMessage(index) {
            if (confirm("Tem certeza que deseja excluir esta mensagem?")) {
                window.location.href = "excluir_mensagem.php?index=" + index;
            }
        }
    </script>
</body>
</html>
