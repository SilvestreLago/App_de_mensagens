<?php 
//VERIFICA SE O USUÁRIO INSERIU NOME
session_start();
if(!isset($_SESSION['nome'])){
    header('Location: ./nome.php');
}
?>