<?php 
// REALIZA O LOGIN

$nome = htmlspecialchars(strip_tags($_POST['nome'])) ?? '';

if($nome != ''){
    session_start();
    $_SESSION['nome'] = $nome;
    header('Location: ../index.php');
}else{
    header('Location: ../nome.php?erro=nome-invalido');
}

?>