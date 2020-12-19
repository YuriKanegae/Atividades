<?php

    $host = "db4free.net";
    $port = "3306";
    $db = "precos";
    $user = "yurikanegae";
    $senha = "yuri1890794";

    $conexao = @mysqli_connect($host,$user,$senha,$db, $port)
        or die("Erro ao abrir a conexão com o banco de dados.");
?>
