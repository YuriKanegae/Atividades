<!DOCTYPE html>
<?php

    //Indicando o itmezone local para evitar probelmas
    date_default_timezone_set('America/Sao_Paulo');

    //Função de procura dos arquivos
    function listaPastas($nomeDoCaminho, $nivel){

        //Escaneia a pasta atual
        $pasta = scandir($nomeDoCaminho);

        //Percorre todos os elementos dentro da pasta
        for($i = 0; $i < sizeof($pasta); $i++){
            if($pasta[$i] != '.' && $pasta[$i] != '..' && $pasta[$i] != '.git' && $pasta[$i] != 'css' && $pasta[$i] != 'js'){
                $caminho = $nomeDoCaminho . '/' . $pasta[$i];

                $tab = $nivel+1;
                $margin = 15 * $tab;
                $marginb = $margin+30;
                if(is_dir($caminho)){
                    echo '
                    <tr>
                        <td scope = "col">

                            <img src = "img/folder.png" width = "30px"/>
                            <a style = "padding-left: '.$margin.'px;" href = "' .$caminho. '">' .$pasta[$i]. '</a>

                        </td>
                        <td  class = "text-center">
                            ' .date ("F d Y", filemtime($caminho)). '
                        </td>
                    </tr>
                    ';
                }else{
                    echo '
                    <tr>
                        <td scope = "col">

                            <a style = "padding-left: '.$marginb.'px;" href = "' .$caminho. '">' .$pasta[$i]. '</a>

                        </td>
                        <td  class = "text-center">
                            ' .date ("F d Y", filemtime($caminho)). '
                        </td>
                    </tr>
                    ';
                }

                if(is_dir($caminho)){
                    listaPastas($caminho, $nivel+1);
                }

            }
        }
    }
?>

<html>

    <head>
        <meta charset = "UTF-8" />
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css\bootstrap.min.css"/>

        <title>Portfolio de Exercícios</title>

        <style>
            html, body{
                height: 100%;
            }

            #page-content {
              flex: 1 0 auto;
              margin-bottom: 50px;
            }

            #sticky-footer {
              flex-shrink: none;
            }

        </style>
    </head>
    <body  class="d-flex flex-column">
        <div id = "page-content" >
            <div class = "container text-center">
                <div class = "row justify-content-center">
                    <div class = "col-md-8">
                        <h1>Yuri Kanegae</h1>
                        <p>Portfolio de Exercícios</p>
                    </div>
                </div>
            </div>
        </div>

        <div clas = "row">
            <div class = "col-md-8 offset-md-2">
                <!--Tabela com as atividades-->
                <table class = "table table striped">

                    <thead class = "thead-dark">
                        <tr>
                            <th scope = "col" class = "text-center">Nome</th>
                            <th scope = "col" class = "text-center">Data de criação/atualização</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            listaPastas('files', 0);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Footer-->
        <footer id = "sticky-footer" class = "py-4">
            <div class="container text-center">

                <div>
                    <small>yurikanegae@gmail.com</small>
                </div><br/><br/>
                <div>
                    <a href = "https://www.arq.ifsp.edu.br"><img src = "img/IFSPCut.png" width = "30"/></a>
                    <a href = "https://www.linkedin.com/in/YuriKanegae/"><img src = "img/linkedinIcon.png" width = "50px"/></a>
                    <a href = "https://github.com/YuriKanegae"><img src = "img/githubIcon.png" width = "50px"/></a>
                </div>

            </div>
        </footer>

        <!--Bibliotecas necessárias-->
        <script src = "js\jquery-3.3.1.min.js"></script>
        <script src = "js\popper.min.js"></script>
        <script src = "js\bootstrap.min.js"></script>
    </body>
</html>
