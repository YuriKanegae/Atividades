<?php
    session_start();

    if(isset($_SESSION["nome"])){
        header('Location: home.php');
    }
?>
<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = 'UTF-8'/>
        <meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'/>
        <meta name = 'viewport' content = 'width=device-width, initial-scale=1'/>

        <link rel = 'stylesheet' href = '../css/bootstrap.min.css'/>

        <script src = '../js/jquery-3.5.1.min.js'></script>
        <script src = '../js/popper.min.js'></script>
        <script src = '../js/bootstrap.min.js'></script>
        <script src = '../js/md5.js'></script>
        <script src = '../js/validadorCPF.js'></script>
        <script src = '../js/login.js'></script>

        <title>Faça o seu Login ou Cadastro- Portal NEWS</title>

        <style>
            html, body{
                height: 100%;
            }
            form{
                border: 1px solid;
                border-radius: 10px;
            }
        </style>
    </head>
    <body onload = 'geraForm("login")'>
        <?php include "cabecalho.php"?>
        <div class = 'container h-100'>
            <div class = 'row h-100 justify-content-center align-items-center'>
                <form class = 'col-4' method = 'POST' id = 'form' onsubmit = 'submitForm()'>
                </form>
            </div>
        </div>
    </body>
</html>
<!--
    Administrador 1:
        email: adm_1@mail.com
        senha: admin1
    Administrador 2:
        email: adm_2@mail.com
        senha: admin2
-->
