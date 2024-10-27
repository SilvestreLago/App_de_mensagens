<?php 
//VERIFICA SE O USUÁRIO POSSUI AMIZADE COM OUTRO PARA O CHAT PRIVADO
include_once('./php/conn.php');

$id_Chat = $_GET['id'];
$user_E = $_SESSION['id'];

$query = "SELECT * FROM Amizades WHERE estado = 1 and (id_E = $user_E or id_R = $user_E) and (id_E = $id_Chat or id_R = $id_Chat)";
$result = $db->query($query);
$results = $result->fetchAll();
//CASO NÃO POSSUA AMIZADE REDIRECIONA
if(count($results) < 1){
    header('Location: ./users.php?erro=SemAmizade');
    exit;
}
?>