<?php
//CONECTA COM O BD
include_once 'conn.php';

//INFORMAÇÕES NECESSÁRIAS
$hora = date("Y-m-d H:i:s");
$msg = $_POST['msg'] ?? 'teste';
$nome = $_POST['nome'] ?? 'aaaaaa';

if($msg != '' and $nome != ''){
    try{//TENTATIVA DE ADD
        $query = $db->prepare("INSERT INTO Mensagens(msg, hora, user) VALUES (:msg, :hora, :user)");
    
        $query->bindParam(':msg', $msg, PDO::PARAM_STR);
        $query->bindParam(':hora', $hora, PDO::PARAM_STR);
        $query->bindParam(':user', $nome, PDO::PARAM_STR);
    
        $result = $query->execute();
    
    }catch (PDOException $e){ //ERRO AO SUBIR
        $erro = $e->getMessage();
        echo"<p>alert('Erro ao subir a mensagem. $erro')</p>";
    }
}else{ //ERRO SEM INFO
    echo"<p>alert('Erro ao subir a mensagem. Vazio')</p>";
}

?>
