<?php 
    session_start();
    if(isset($_SESSION['nome'])){
        header('Location: ./index.php');
    }
    if(isset($_GET['erro'])){
        $erro = 'Usuário já existente';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/nome.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top">
        <h1 id="topo">CADASTRO:</h1>
    </nav>
    <div class="chat-container">
        <form action="./php/cadastrar.php" method="POST">
            <h3>Nome:</h3>
            <input type="text" name="nome" placeholder="Nome" class="message-input" required>
            <h3>Senha:</h3>
            <input type="password" name="senha" placeholder="Senha" class="message-input" required>
            <input type="submit" value="Cadastrar"><br>
            <a href="./nome.php">Entrar</a>
            <?php if(isset($erro)){echo "<h3 style='background-color: #da2b2b; color: white; margin: 10px; padding: 8px 30px;'>$erro</h3>";}?>
        </form>
    </div>
</body>
</html>
