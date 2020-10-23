<?php
    $host = "db4free.net:3306";
    $usuario = "amandayuri";
    $senha = "musicplayer42";
    $bd = "musicplayer90119";

    if(!$conexao = mysqli_connect($host, $usuario, $senha, $bd)){
        echo "Conexão com Banco de dados falhou";
    }
?>
