<?php 
    session_start();
    if(isset($_SESSION['nome'])){
        header('Location: ./index.php');
    }
    if(isset($_GET['erro'])){
        $erro = 'Nome inválido';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insira o seu nome</title>
    <link rel="stylesheet" href="./css/nome.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top">
        <h1 id="topo">LOGIN:</h1>
    </nav>
    <div class="chat-container">
        <form action="./php/login.php" method="post">
            <h1>Insira seu nome:</h1>
            <input type="text" name="nome" id="message-input" required>
            <input type="submit" value="Enviar">
            <?php if(isset($erro)){echo "<h3 style='background-color: #da2b2b; color: white; margin: 10px; padding: 8px 30px;'>$erro</h3>";}?>
        </form>
    </div>
</body>
</html>
