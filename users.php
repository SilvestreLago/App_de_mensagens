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
        <h1 id="topo">Usuários:</h1>
        <form action="./php/sair.php" method="POST" style="margin-left: auto; display: flex; align-items: center; margin-right:10px;">
            <a href="./index.php" style="background-color: blue; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px; text-decoration: none; margin-right: 10px;">CHAT PÚBLICO</a>    
            <a href="./amigos.php" style="background-color: blue; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px; text-decoration: none; margin-right: 10px;">AMIGOS</a>      
            <input type="submit" value="SAIR" name="sair" id='sair' style="background-color: #ff4d4d; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-size: 12px;">
        </form>
    </nav>
    <table>
        <thead>
            <tr>
                <th>Conversas</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $user_E = $_SESSION['id'];
                $query = "SELECT * FROM Amizades WHERE estado = 1 and (id_E = $user_E or id_R = $user_E)";
                $result = $db->query($query);

                foreach($result as $row){
                    $query2 = "SELECT * FROM User Where id = $row[id_E] or id = $row[id_R]";
                    $result2 = $db->query($query2);
                    foreach($result2 as $row2){
                        if ($row2['id'] != $_SESSION['id']){
                            echo"<tr>
                            <td><a href='./chat_P.php?id=$row2[id]'>$row2[Nome]</a><br></td>
                            </tr>";
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>