<?php
    session_start();

    if(isset($_SESSION["cpf"])){
        header('location: home.php');
    }else{
        header('Location: login.php');
    }
?>
