<?php 
include_once('./php/verf_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App de mensagens</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body onload="receberMSG()">
    <nav class="navbar fixed-top">
        <img src="img/logo.png" alt="Image" width="50" height="50">
        <h1 id="topo">Usuário: <?php echo $_SESSION['nome']?></h1>
        <form action="./php/sair.php" method="POST" style="margin-left: auto; display: flex; align-items: center; margin-right:10px;">
            <input type="submit" value="SAIR" name="sair" id='sair' style="background-color: #ff4d4d; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px;">
        </form>
    </nav>

    <div class="chat-container" id="chat-container">
        <?php 
        include_once('./php/subir.php');
        ?>
        
    </div>

    <form action="" method="post">
        <div class="input-container">
            <input id="message-input" type="text" placeholder="Digite uma mensagem..." name="msg" required>
            <button type="submit">Enviar</button>
        </div>
    </form> 
</body>

</html>
