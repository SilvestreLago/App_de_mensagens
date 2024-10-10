<?php 
//ADICIONA MENSAGENS NO BANCO DE DADOS

if(isset($_POST['msg'])){
    include_once './php/conn.php';

    //INFORMAÇÕES NECESSÁRIAS
    $hora = date("Y-m-d H:i:s");
    $msg = htmlspecialchars(strip_tags($_POST['msg'])) ?? '';
    $msg =  base64_encode($msg);
    $id_to = $_POST['id_to'];
    $id_send = $_SESSION['id'];

    if($msg != '' and $nome != '' and $id_to != ''){
        try{//TENTATIVA DE ADD
            $query = $db->prepare("INSERT INTO Mensagens(msg, hora, user_to, user_send) VALUES (:msg, :hora, :user_to, :user_send)");
        
            $query->bindParam(':msg', $msg, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->bindParam(':user_to', $id_to, PDO::PARAM_INT);
            $query->bindParam(':user_send', $id_send, PDO::PARAM_INT);
        
            $result = $query->execute();


            include_once("./php/mostrar_P.php");
        
        }catch (PDOException $e){ //ERRO AO SUBIR
            $erro = $e->getMessage();
            echo ($erro);
        }
    }
}

?>