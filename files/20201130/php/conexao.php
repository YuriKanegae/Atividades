<?php

    $host = "localhost";
    $db = "precos";
    $user = "root";
    $senha = "usbw";

    $conexao = @mysqli_connect($host,$user,$senha,$db)
        or die("Erro ao abrir a conexão com o banco de dados.");
?>
