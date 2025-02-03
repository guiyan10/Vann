<?php
// Verifica se o índice da mensagem foi fornecido via GET
if (isset($_GET['index'])) {
    // Obtém o índice da mensagem
    $index = $_GET['index'];

    // Carrega todas as mensagens do arquivo
    $messages = file("chat.txt");

    // Remove a mensagem com o índice fornecido
    unset($messages[$index]);

    // Reescreve o arquivo com as mensagens atualizadas
    file_put_contents("chat.txt", implode("", $messages));
}

// Redireciona de volta para a página do chat
header("Location: homepage.php");
exit();
?>
