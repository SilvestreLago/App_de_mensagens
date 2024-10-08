<?php 
    session_start();
    if(isset($_SESSION['nome'])){
        header('Location: ./index.php');
    }
    if(isset($_GET['erro'])){
        $erro = 'Credenciais Inválidas';
    }
    if(isset($_GET['cad'])){
        $success = 'Cadastro realizado';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/nome.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top">
        <h1 id="topo">LOGIN:</h1>
    </nav>
    <div class="chat-container">
        <form action="./php/login.php" method="post">
            <h3>Nome:</h3>
            <input type="text" name="nome" class="message-input" required placeholder="Fulano">
            <h3>Senha:</h3>
            <input type="password" name="senha" class="message-input" required placeholder="********">
            <input type="submit" value="Enviar"><br>
            <a href="./cad.php">Cadastre-se</a>
            <?php if(isset($success)){echo "<h3 style='background-color: #47da34; color: white; margin: 10px; padding: 8px 30px;'>$success</h3>";}?>
            <?php if(isset($erro)){echo "<h3 style='background-color: #da2b2b; color: white; margin: 10px; padding: 8px 30px;'>$erro</h3>";}?>
        </form>
    </div>
</body>
</html>
