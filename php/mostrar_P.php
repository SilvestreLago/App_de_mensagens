<?php
// MOSTRA AS MENSAGENS DO BANCO DE DADOS

//CONECTA COM O BD
include_once 'conn.php';
session_start();
//COLETA O NOME DO USER
$id_send = $_SESSION['id'];
if(isset($_GET['id'])){
    $id_to = $_GET['id'];
}

//QUERY DO SQL
$query = "SELECT * FROM (SELECT * FROM Mensagens WHERE (user_send = $id_send AND user_to = $id_to) OR (user_send = $id_to AND user_to = $id_send) ORDER BY hora DESC)";
$result = $db->query($query);

//MOSTRAR EM LISTA AS MENSAGENS
foreach($result as $row){
    if($row['user_send'] == $id_send){ //CASO SEJA O MESMO USER
        $msg_dec = base64_decode($row['msg']);
        echo"<div class='message sent'>
            $msg_dec
            <div class='message-time'>$row[hora]</div>
        </div>
    ";
    }else{ //CASO SEJA UM USER DIFERENTE
        $msg_dec2 = base64_decode($row['msg']);
        echo"<div class='message received'>
            $msg_dec2
            <div class='message-time'>$row[hora]</div>
        </div>
    ";
    }
    
}

?>