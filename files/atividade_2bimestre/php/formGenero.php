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
            <?php
                if(empty($_POST)){
                    echo '
                        <form action = "formGenero.php" method = "POST">
                            <input class = "form-control" type = "text" name = "nomeGenero" placeholder = "Nome do Gênero"/>
                            <button class = "btn btn-primary"/>Cadastrar Gênero</button>
                        </form>
                    ';
                }else{
                    include "conexao.php";

                    if($_POST["nomeGenero"] != ""){
                        $nomeDoGenero = $_POST["nomeGenero"];

                        $query = "insert into genero(nome) values('$nomeDoGenero')";

                        mysqli_query($conexao, $query)
                            or die($query);

                        echo "<h1>Cadastrado com sucesso!</h1>";
                    }else{
                        echo "<h1>Input vazio!</h1>";
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
