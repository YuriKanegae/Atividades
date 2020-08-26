<?php
    session_start();

    $fruta = $_GET["palavraInput"];

    if( !isset($_SESSION["frutas"]) ){
        $_SESSION["frutas"][] = $fruta;

        echo '<li>' . $fruta. '</li>';
    }else{
        if( in_array($fruta, $_SESSION["frutas"]) ){
            echo 'true';
        }else{
            $_SESSION["frutas"][] = $fruta;
            
            echo '<li>' . $fruta. '</li>';
        }
    }
?>
