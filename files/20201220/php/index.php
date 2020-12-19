<?php
    include "conf.php";

    cabecalho();

    if(!empty($_SESSION["loginID"])){
        echo '
            <div class = "text-center align-middle" style = "padding-top: 100px;">
                <h1><b><u>Bem vindo ao site sem nome!</u></b></h1>
                <h3>Cadastre os seus nichos, categorias e produtos.</h3>
            </div>
        ';
    }else{
        echo '
            <div class = "text-center align-middle" style = "padding-top: 100px;">
                <h1><b><u>Bem vindo ao site sem nome!</u></b></h1>
                <h3>Faça login ou cadastre-se</h3>
            </div>
        ';
    }


    rodape();

?>
