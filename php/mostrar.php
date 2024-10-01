<?php
//CONECTA COM O BD
include_once 'conn.php';

//COLETA O NOME DO USER
$nome = $_POST['nome'] ?? '';

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