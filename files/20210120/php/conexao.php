<?php

    //Dados para login
    $host = "localhost";
    $usuario = "root";
    $senha = "usbw";
    $bd = "revisao_aula";

    $conexao = mysqli_connect($host, $usuario, $senha, $bd);

    if(!$conexao){
        echo mysqli_connect_errno();
        exit();
    }

    mysqli_set_charset($conexao, "utf8");
?>
