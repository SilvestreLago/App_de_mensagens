<?php
// MOSTRA AS MENSAGENS DO BANCO DE DADOS

//CONECTA COM O BD
include_once 'conn.php';
session_start();
//COLETA O NOME DO USER
$nome = $_SESSION['nome'];

//QUERY DO SQL
$query = "SELECT * FROM Mensagens ORDER BY hora DESC";
$result = $db->query($query);

//MOSTRAR EM LISTA AS MENSAGENS
foreach($result as $row){
    if($row['user'] == $nome){ //CASO SEJA O MESMO USER
        echo"<div class='message sent'>
            <div class='message-time'>$row[user]</div>
            $row[msg]
            <div class='message-time'>$row[hora]</div>
        </div>
    ";
    }else{ //CASO SEJA UM USER DIFERENTE
        echo"<div class='message received'>
            <div class='message-time'>$row[user]</div>
            $row[msg]
            <div class='message-time'>$row[hora]</div>
        </div>
    ";
    }
    
}

?>