<?php 
//ADICIONA MENSAGENS NO BANCO DE DADOS

if(isset($_POST['msg'])){
    include_once './php/conn.php';

    //INFORMAÇÕES NECESSÁRIAS
    $hora = date("Y-m-d H:i:s");
    $msg = htmlspecialchars(strip_tags($_POST['msg'])) ?? '';
    $msg =  base64_encode($msg);
    $nome = $_SESSION['nome'];

    if($msg != '' and $nome != ''){
        try{//TENTATIVA DE ADD
            $query = $db->prepare("INSERT INTO Mensagens(msg, hora, user) VALUES (:msg, :hora, :user)");
        
            $query->bindParam(':msg', $msg, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->bindParam(':user', $nome, PDO::PARAM_STR);
        
            $result = $query->execute();

            include_once('./php/mostrar.php');
        
        }catch (PDOException $e){ //ERRO AO SUBIR
            $erro = $e->getMessage();
            echo ('erro=nice-try');
        }
    }
}

?>