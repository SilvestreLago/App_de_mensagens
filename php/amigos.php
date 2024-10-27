<?php 
//ADICIONAR AMIZADE
include_once './conn.php';
session_start();

var_dump($_POST);

$user_R = $_POST['id_to'];
$user_E = $_SESSION['id'];
$estado = 0;

$query = "SELECT * FROM Amizades WHERE (id_E = $user_E and id_R = $user_R) or (id_E = $user_R and id_R = $user_E)";
$result = $db->query($query);
$results = $result->fetchAll();
if(count($results) >= 1){
    header('Location: ../amigos.php?erro=SolicitacaoEmAndamento');
    exit;
}

try{ //TENTA ADICIONAR AMIZADE
    $query = $db->prepare("INSERT INTO Amizades(id_E, id_R, estado) VALUES (:envia, :recebe, :estado)");        
    $query->bindParam(':envia', $user_E, PDO::PARAM_INT);
    $query->bindParam(':recebe', $user_R, PDO::PARAM_INT);
    $query->bindParam(':estado', $estado, PDO::PARAM_INT);
    $result = $query->execute();

    header('Location: ../amigos.php');
}
catch (PDOException $e){ //ERRO AO SUBIR
    $erro = $e->getMessage();
    echo ('erro=nice-try');
}
?>