<!DOCTYPE html>
<?php
    session_start();
?>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8"/>

        <title>Exercício AJAX + Jquery</title>

        <script src = "js\jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#button").click(function(){
                    var palavraInput = $("input[name=nomes]").val();

                    if(palavraInput != ""){
                        $.get("php/observador.php", {"palavraInput": palavraInput}, function(resposta){
                            if(resposta == 'true'){
                                $("#span").css("color", "red");
                                $("#span").html("Fruta já cadastrada!");
                            }else{
                                $("#span").css("color", "green");
                                $("#span").html("Nova fruta cadastrada!");

                                var HTML = $("#lista").html();
                                HTML = HTML + resposta;
                                $("#lista").html(HTML);
                            }
                        });
                    }
                });
            });
        </script>
    </head>

    <body>
        <form>
            <input type = "text" name = "nomes" placeholder = "Digite uma fruta"/>

            <input type = "button" id = "button" value = "Cadastro Assíncrono"/>
        </form>
        <hr/>
            <span id = "span"></span>
        <hr/>

        <ul id = "lista">
            <?php
                if( isset($_SESSION["frutas"]) ){
                    foreach($_SESSION["frutas"] as $fruta){
                        echo '<li>' . $fruta . '</li>';
                    }
                }
            ?>
        </ul>
    </body>
</html>
