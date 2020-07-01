<?php 
    $servidor = "localhost";
    $usuario = "root";
    $senha = "usbw";
    $db = "meajudabaixada";
    $connection = new mysqli($servidor, $usuario, $senha, $db);
    if(!$connection)    
        echo "Erro de conexão! {$connection->error}";      
    else
        echo "conectado";
?>