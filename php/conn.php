<?php 
//ESTABELECER CONEXÃO COM O BANCO DE DADOS
try{
    $caminho_DB = __DIR__ . '/' . '../db/mensagens.db';

    $db = new PDO('sqlite:' . $caminho_DB);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){ //ERRO
    echo'Erro na conexão com o banco de dados. '  . $e->getMessage();
}

?>