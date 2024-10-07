<?php 
//SAIR
session_start();
unset($_SESSION['nome']);
session_destroy();
header('Location: ../nome.php');
?>