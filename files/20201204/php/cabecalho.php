<?php
    session_start();

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
                    <script src = "../js/md5.js"></script>

                    <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity = "sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin = "anonymous"/>
                    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity = "sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin = "anonymous"></script>
                    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity = "sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin = "anonymous"></script>

                    <link href = "../css/main.css" rel = "stylesheet"/>

                </head>

                <script>
                    function checaInput(modal){
                        event.preventDefault();

                        if(modal == "cadastro"){
                            var senha = $("input[name=senhaCadastro]").val();
                            var senhaConfirmar = $("input[name=senhaCadastroConfirmar]").val();

                            if(senha == senhaConfirmar){
                                $("input[name=senhaCadastro]").val($.md5(senha));
                                $("input[name=senhaCadastroConfirmar]").val($.md5(senha));

                                $("form[name=cadastro]").submit();
                            }else{
                                $("#erroSenhas").html("<p>Senhas diferentes!</p>");
                            }
                        }else if(modal == "login"){
                            var senha = $("input[name=senha]").val();
                            $("input[name=senha]").val($.md5(senha));

                            $("form[name=login]").submit();
                        }
                    }

                    function mudaModal(){
                        $("#modalLogin").modal("hide");
                        $("#modalCadastro").modal("show");
                    }
                </script>

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
                        <div class = "navbar-collapse collapse w-100 order-3 dual-collapse2">
                            <ul class = "navbar-nav ml-auto">
                                <li class = "nav-item">';
                                    if(empty($_SESSION["loginID"])){
                                        echo'
                                            <li class = "nav-item">
                                                <a class = "nav-link" data-toggle = "modal" data-target = "#modalLogin">Login ou Cadastre-se</a>
                                            </li>

                                            <!-- Modal de login-->
                                            <div class = "modal fade" id = "modalLogin" tabindex = "-1" role = "dialog" aria-labelledby = "modalCategoria" aria-hidden = "true">
                                                <div class = "modal-dialog" role = "document">
                                                    <div class = "modal-content">
                                                        <div class = "modal-header">
                                                            <h5 class = "modal-title" id = "tituloModal">Faça o seu login ou cadastro!</h5>
                                                            <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action = "login.php" method = "POST" name = "login">
                                                            <div class="modal-body">
                                                                <div class = row>
                                                                    <input class = "form-control col-6 offset-3" type = "email" name = "email" placeholder = "E-mail">
                                                                </div>

                                                                <div class = row>
                                                                    <input class = "form-control col-6 offset-3" type = "password" name = "senha" placeholder = "Senha">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type = "button" class = "btn btn-secondary" onclick = "mudaModal()">Cadastrar-se</button>
                                                                <button class = "btn btn-primary" onclick = "checaInput(\'login\')"/>Login</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal de Cadastro-->
                                            <div class = "modal fade" id = "modalCadastro" tabindex = "-1" role = "dialog" aria-labelledby = "modalCategoria" aria-hidden = "true">
                                                <div class = "modal-dialog" role = "document">
                                                    <div class = "modal-content">
                                                        <div class = "modal-header">
                                                            <h5 class = "modal-title" id = "tituloModal">Faça o seu cadastro!</h5>
                                                            <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form action = "cadastro.php" method = "POST" name = "cadastro">
                                                            <div class="modal-body">

                                                                    <div class = row>
                                                                        <input class = "form-control col-6 offset-3" type = "text" name = "usuarioCadastro" placeholder = "Usuário">
                                                                    </div>

                                                                    <div class = row>
                                                                        <input class = "form-control col-6 offset-3" type = "email" name = "emailCadastro" placeholder = "E-mail">
                                                                    </div>

                                                                    <div class = row>
                                                                        <input class = "form-control col-6 offset-3" type = "password" name = "senhaCadastro" placeholder = "Senha">
                                                                    </div>

                                                                    <div class = row>
                                                                        <input class = "form-control col-6 offset-3" type = "password" name = "senhaCadastroConfirmar" placeholder = "Confirmação de senha"/>
                                                                        <span id = "erroSenhas" class = "col-6 offset-3"></span>
                                                                    </div>

                                                            </div>

                                                            <div class = "modal-footer">
                                                                <input type = "reset" class = "btn btn-danger" value = "Limpar campos"/>
                                                                <button class = "btn btn-primary" onclick = "checaInput(\'cadastro\')"/>Cadastrar-se</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    }else{
                                        echo'
                                            <li class = "nav-item">
                                                <p>Olá, '. $_SESSION["nomeUsuario"] .'</p>
                                            </li>

                                            <li class = "nav-item">
                                                <a  href = "logout.php">Sair</a>
                                            </li>
                                        ';
                                    }
        echo'
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <main role = "main" class = "container">
        ';
    }
?>
