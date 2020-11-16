<?php
    function cabecalho(){
        $alt = $GLOBALS["alt"];
        $menuCadastrar = $GLOBALS["menuCadastrar"];
        $menuListar = $GLOBALS["menuPrecos"];

        echo '
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset = "utf-8"/>
                    <script src = "../js/jquery-3.5.1.min.js"></script>

                    <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity = "sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin = "anonymous"/>
                    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity = "sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin = "anonymous"></script>
                    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity = "sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin = "anonymous"></script>

                    <link href = "../css/main.css" rel = "stylesheet"/>

                </head>

                <body>
                    <nav class = "navbar navbar-custom navbar-expand-md navbar-dark">
                        <div class = "container">
                            <a href = "index.php" class = "navbar-brand logotipo">
                                <img src = "../img/logotipo.png" class = "rounded" width = "50px" alt = "'. $alt .'"/>
                            </a>

                            <!-- botão que aparece quando a tela for pequena -->
                            <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#menu">
                                <span class = "navbar-toggler-icon"></span>
                            </button>

                            <div class = "collapse navbar-collapse" id = "menu">
                                <ul class = "navbar-nav">
                                    <li role = "presentation" class = "dropdown">
                                        <a class = "dropdown-toggle" data-toggle = "dropdown" href = "#" role = "button" aria-haspopup = "true" aria-expanded = "false">
                                            Cadastrar <span class = "caret"></span>
                                        </a>
                                        <ul class = "dropdown-menu">
        ';

        foreach($menuCadastrar as $i=>$l){
            echo '
                                            <li class = "nav-item">
                                                <a class = "menu" href = "form_'. $i .'.php">'. $l .'</a>
                                            </li>
            ';
        }

        echo '
                                        </ul>
                                    </li>
                                    <li role = "presentation" class = "dropdown">
                                        <a class = "dropdown-toggle" data-toggle = "dropdown" href = "#" role = "button" aria-haspopup = "true" aria-expanded = "false">Listar <span class = "caret"></span></a>
                                        <ul class = "dropdown-menu">
        ';

        foreach($menuListar as $i=>$l){
            echo '
                                            <li class = "nav-item">
                                                <a class = "menu" href = "lista_'. $i .'.php">'. $l .'</a>
                                            </li>
            ';
        }

        echo '
                                        </ul>
                                    </li>
                                    <li class = "nav-item">
                                        <a href = "../php/checaPrecos.php">Checar preços</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <main role = "main" class = "container">
        ';
    }
?>
