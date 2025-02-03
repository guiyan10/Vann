<?php
// Verifica se o formulário foi enviado e se a mensagem não está vazia
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["message"])) {
    // Limpa a mensagem e remove espaços em branco extras
    $message = trim($_POST["message"]);
    
    // Abre ou cria o arquivo de chat para escrita
    $file = fopen("chat.txt", "a");
    
    // Escreve a mensagem no arquivo
    fwrite($file, $message . PHP_EOL);
    
    // Fecha o arquivo
    fclose($file);
    
    // Redireciona de volta para a página do chat
    header("Location: chat.php");
    exit();
} else {
    // Se a mensagem estiver vazia, redireciona de volta para a página do chat
    header("Location: chat.php");
    exit();
}
?>
