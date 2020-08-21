<!DOCTYPE html>
<html lang = "pt-br">

    <head>
        <meta charset = "UTF-8"/>

        <title>Exercício 2020 08 19</title>

        <script src = "js\jquery-3.3.1.min.js"></script>
        <script>

            $(document).ready(function(){

                //Para ocultar
                $("#ocultar").change(function(){
                    $("#span").html("");

                    var idInt = $("#ocultar").val();
                    id = "#" + idInt;
                    display = $(id).css("display");

                    if(display == "inline"){
                        $(id).fadeOut();
                    }else{
                        $("#span").html("A imagem " + idInt + " já está oculta");
                    }

                    $("#ocultar").val(0);
                });

                //Para mostrar
                $("#mostrar").change(function(){

                    $("#span").html("");

                    var idInt = $("#mostrar").val();
                    id = "#" + idInt;
                    display = $(id).css("display");

                    if(display == "none"){
                        $(id).fadeIn();
                    }else{
                        $("#span").html("A imagem " + idInt + " já está na tela");
                    }

                    $("#mostrar").val(0);
                });
            });
        </script>
    </head>

    <body>
        <!--Formulário seletor de ação-->
        <form>
            <select id = "ocultar">
                <option value = "0">::selecione qual ocultar::</option>
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
            </select>

            <select id = "mostrar">
                <option value = "0">::selecione qual ocultar::</option>
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
            </select>
        </form>

        <hr/>

        <span id = "span" style = "color: red;"></span>

        <hr/>

        <!--Imagens-->
        <img id = "1" src = "img/img1.png" width = "100px" height = "100px"/>
        <img id = "2" src = "img/img2.png" width = "100px" height = "100px"/>
        <img id = "3" src = "img/img3.png" width = "100px" height = "100px"/>
        <img id = "4" src = "img/img4.png" width = "100px" height = "100px"/>
        <img id = "5" src = "img/img5.png" width = "100px" height = "100px"/>
        <img id = "6" src = "img/img6.png" width = "100px" height = "100px"/>
        <img id = "7" src = "img/img7.png" width = "100px" height = "100px"/>
        <img id = "8" src = "img/img8.png" width = "100px" height = "100px"/>
    </body>
</html>
