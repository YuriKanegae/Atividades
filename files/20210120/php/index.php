<?php
    session_start();

    if(!isset($_SESSION["cpf"])){
        header("location: login.php");
    }
?>

<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8"/>

        <title>Página de index</title>

        <script>
            function logout(){
                window.location.href = 'logout.php';
            }
        </script>
    </head>
    <body onload = "setTimeout('logout()', 60000);">
        <header>
            <h1>Olá</h1>
        </header>
        <main>
            <?php

                echo "Seu CPF é: ". $_SESSION["cpf"] ."<br/>";
                echo "Seu e-mail é: ". $_SESSION["email"] ."<br/>";
                echo "Seu nível é: ". $_SESSION["nivel"];
                switch ($_SESSION["nivel"]){
                    case 1:
                        echo " - perfil de aluno - permissão básica <br/>";
                        break;
                    case 2:
                        echo " - perfil de professor - permissão média <br/>";
                        break;
                    case 3:
                        echo " - perfil de administrador - permissão alta <br/>";
                        break;
                }

                echo "Faça o seu <a href = 'logout.php'>logout</a>"
            ?>
        </main>
    </body>
</html>
