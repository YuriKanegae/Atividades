<?php
    session_start();
    
    include 'cabecalho.php';

    if(isset($_SESSION["nome"])){
        header('location: home.php');
    }else{
        
        //header('Location: login.php');
    }

    include 'rodape.php';
?>
