<?php 

include_once './conn.php';

$nome = htmlspecialchars(strip_tags($_POST['nome'])) ?? '';
$passwd = htmlspecialchars(strip_tags($_POST['senha'])) ?? '';

if($nome != '' and $passwd != ''){
    $query = "SELECT Nome FROM User";
    $result = $db->query($query);
    foreach($result as $row){
        if($row['Nome'] == $nome){
            header('Location: ../cad.php?erro=credencial-invalida');
            exit;
        }
    }
    try{//TENTATIVA DE ADD
        $query = $db->prepare("INSERT INTO User(Nome, Senha) VALUES (:nome, :passwd)");
        
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);

        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':passwd', $passwd, PDO::PARAM_STR);
    
        $result = $query->execute();

        header('Location: ../nome.php?cad=success');

    }catch (PDOException $e){ //ERRO AO SUBIR
        $erro = $e->getMessage();
        header('Location: ../index.php?erro=bd');
    }
}
?>