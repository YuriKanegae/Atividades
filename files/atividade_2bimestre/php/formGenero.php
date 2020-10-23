<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Genêros</title>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>

        <div class = "container">
            <div class="row text-center">
                <div class="col">
                    <h3>Cadastro de Gêneros</h3>
                    <br>
                </div>
            </div>
            <?php
                if(empty($_POST)){
                    echo '
                        <form action = "formGenero.php" method = "POST">
                            <div class="row">
                                <div class="col-1">
                                    Nome:
                                </div>
                                <div class="col">
                                    <input class = "form-control" type = "text" name = "nomeGenero" placeholder = "Nome do Gênero"/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <button class = "btn btn-primary" type="submit">Cadastrar Gênero</button>
                                </div>
                                <div class="col">
                                    <button class = "btn btn-secondary" type="reset">Limpar Campos</button>
                                </div>
                            </div>
                        </form>
                    ';
                }else{
                    include "conexao.php";

                    if($_POST["nomeGenero"] != ""){
                        $nomeDoGenero = $_POST["nomeGenero"];

                        $query = "insert into genero(nome) values('$nomeDoGenero')";

                        mysqli_query($conexao, $query)
                            or die($query);

                        echo "<div class='alert alert-success' role='alert'>
                                Gênero cadastrado com sucesso!
                            </div>
                        ";
                    }else{
                        echo "<div class='alert alert-warning' role='alert'>Preencha todos os campos!</div>";
                    }
                }
            ?>
        </div>
        <!--Bibliotecas necessárias-->
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
