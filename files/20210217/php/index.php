<?php
    session_start();

    if(isset($_SESSION["nome"])){
        header('location: home.php');
    }else{
        header('Location: login.php');
    }
?>
