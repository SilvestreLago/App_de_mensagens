<?php 
// CONECTA AO BD
include_once "./conn.php";

// REALIZA O LOGIN
$nome = htmlspecialchars(strip_tags($_POST['nome'])) ?? '';
$passwd = htmlspecialchars(strip_tags($_POST['senha'])) ?? '';

if($nome != '' and $passwd != ''){
    $query = "SELECT * FROM User";
    $result = $db->query($query);

    foreach($result as $row){
        if($row['Nome'] == $nome and password_verify($passwd, $row['Senha'])){
            session_start();
            $_SESSION['nome'] = $nome;
            $_SESSION['id'] = $row['id'];
            header('Location: ../index.php');
        }else{
            header('Location: ../nome.php?erro=Credenciais-invalidas');
        }
    }

}else{
    header('Location: ../nome.php?erro=Credenciais-invalidas');
}

?>