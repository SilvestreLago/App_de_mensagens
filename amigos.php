<?php 
    include_once './php/verf_login.php';
    include_once './php/conn.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/table.css">
</head>
<body>
    <nav class="navbar fixed-top">
        <img src="img/logo.png" alt="Image" width="50" height="50">
        <h1 id="topo">Amigos:</h1>
        <form action="./php/sair.php" method="POST" style="margin-left: auto; display: flex; align-items: center; margin-right:10px;">
            <a href="./index.php" style="background-color: blue; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px; text-decoration: none; margin-right: 10px;">CHAT PÚBLICO</a>    
            <a href="./users.php" style="background-color: blue; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px; text-decoration: none; margin-right: 10px;">CHAT PRIVADO</a>
            <input type="submit" value="SAIR" name="sair" id='sair' style="background-color: #ff4d4d; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px; margin-right: 10px">
        </form>
    </nav>
    <table>
        <thead>
            <tr>
                <th>Buscar por usuários:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="text" name="amigo" id="" placeholder="Nome do usuário">
                        <input type="submit" value="Procurar">
                    </form>
                    
                    <form action="./php/amigos.php" method="post">
                        <?php 
                            //ENVIAR SOLICITAÇÃO DE AMIZADE
                            if(isset($_POST['amigo'])){
                                $amigo = $_POST['amigo'];
                                $query = "SELECT * FROM User WHERE Nome = '$amigo'";
                                $result = $db->query($query);
                
                                foreach($result as $row){
                                    if ($row['id'] != $_SESSION['id']){
                                        echo"
                                        <tr>
                                            <input type='hidden' name='id_to' value='$row[id]'>
                                            <td>$row[Nome] <button type='submit'>Adicionar</button><br></td>
                                        </tr>";
                                    }
                                }
                            }
                        ?>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Solicaitações em andamento:</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //SOLICITAÇÕES QUE VOCÊ ENVIOU
                $user_E = $_SESSION['id'];
                $query = "SELECT User.id, User.Nome FROM Amizades JOIN User ON User.id = Amizades.id_R WHERE Amizades.id_E = $user_E and Amizades.Estado = 0";
                $result = $db->query($query);

                foreach ($result as $row) {
                    echo "<tr>
                            <form method='post'>
                                <input type='hidden' name='id_to' value='{$row['id']}'>
                                <input type='hidden' name='nome' value='{$row['Nome']}'>
                                <td>{$row['Nome']} <button type='submit'>Remover Solicitação</button><br></td>
                            </form>
                        </tr>";
                }

                if (isset($_POST["id_to"])) {
                    try{
                        $query = "DELETE FROM Amizades Where id_E = $user_E and id_R = $_POST[id_to]";
                        $result = $db->query($query);
                        header("Location: " . $_SERVER['PHP_SELF']);
                    }catch(PDOException $e){
                        echo "Erro ao remover a amizade!" . $e->getMessage();
                    }
                }
            ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Quem quer ser meu amigo?</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                //SOLICITAÇÕES QUE VOCÊ RECEBEU
                $query = "SELECT User.id, User.Nome, Amizades.id_E as id_de FROM Amizades JOIN User ON User.id = Amizades.id_E WHERE Amizades.id_R = $user_E and Amizades.Estado = 0";
                $result = $db->query($query);

                foreach ($result as $row){
                    echo"<tr>
                            <form method='post'>
                            
                                <td>
                                    $row[Nome]
                                    <input type='hidden' name='id_para' value='$row[id]'>
                                    <label>
                                        <input type='radio' name='resposta' value='aceitar' required> Aceitar
                                    </label>
                                    <label>
                                        <input type='radio' name='resposta' value='recusar' required> Recusar
                                    </label>

                                    <button type='submit'>Enviar</button> 
                                    <br>
                                </td>
                            </form>
                        </tr>";
                }

                if(isset($_POST['id_para'])){
                    $id_para = $_POST['id_para'];
                    $resp = $_POST['resposta'];
                    $estado = 1;
                    if($resp == 'aceitar'){
                        try{
                            $query = "UPDATE Amizades SET estado = :estado WHERE id_R = $user_E and id_E = :id_para";
                            $query = $db->prepare($query);
                            $query->bindParam(':estado', $estado, PDO::PARAM_INT);
                            $query->bindParam(':id_para', $id_para, PDO::PARAM_INT);
                            $reuslt = $query->execute();
                            header("Location: " . $_SERVER['PHP_SELF']);
                        }catch(PDOException $e){
                            echo 'Erro ao aceitar amizade! ' . $e->getMessage();
                            header("Location: " . $_SERVER['PHP_SELF']);
                        }
                    }else{
                        try{
                            $query = "DELETE FROM Amizades Where id_E = $id_para and id_R = $user_E";
                            $result = $db->query($query);
                            header("Location: " . $_SERVER['PHP_SELF']);
                        }catch(PDOException $e){
                            echo "Erro ao negar a amizade!" . $e->getMessage();
                        }
                    }
                }
            ?>
        </tbody>
    </table>

    <table>
            <thead>
                <tr>
                    <th>Amigos</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    //MEUS AMIGOS
                    $query = "SELECT * FROM Amizades WHERE (id_R = $user_E or id_E = $user_E) and Estado = 1";
                    $result = $db->query($query);
    
                    foreach ($result as $row){
                        if($row['id_E'] == $user_E){
                            $id_nome = $row['id_R'];
                        }else{
                            $id_nome = $row['id_E'];
                        }
                        $query2 = "SELECT Nome FROM User WHERE id = $id_nome";
                        $result2 = $db->query($query2);
                        $nn = $result2->fetchAll();
                        $nn = reset($nn);
                        echo"<tr>
                                <form method='post'>
                                
                                    <td>
                                        $nn[0]
                                        <input type='hidden' name='id_amizade' value='$row[id]'>    
                                        <button type='submit'>Remover</button> 
                                        <br>
                                    </td>
                                </form>
                            </tr>";
                            if (isset($_POST["id_amizade"])){
                                try{
                                    $query = "DELETE FROM Amizades Where id = $_POST[id_amizade]";
                                    $result = $db->query($query);
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                }catch(PDOException $e){
                                    echo "Erro ao remover a amizade!" . $e->getMessage();
                                }
                            }
                    }
                ?>
            </tbody>
    </table>
</body>
</html>