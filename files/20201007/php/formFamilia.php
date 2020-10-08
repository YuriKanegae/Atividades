<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Famílias</title>
    </head>
    <body>
        <?php
            include "../inc/cabecalho.inc";
        ?>

        <div class = "container">
            <form action = "formFamilia.php" method = "POST">
                <div class = "row">
                    <input class = "form-control offset-1 col-3" type = "text" name = "nome" placeholder = "Nome Família.."/>
                    <input class = "form-control offset-1 col-3" type = "text" name = "nome_cientifico" placeholder = "Nome Científico.."/>

                    <button class = "btn btn-primary offset-1 col-2">cadastrar</button>
                </div>
            </form>

            <?php
                if(!empty($_POST)){
                    $nome = $_POST["nome"];
                    $nome_cientifico = $_POST["nome_cientifico"];

                    include "../php/conexao.php";

                    $query = "insert into familia(nome, nome_cientifico) values('$nome', '$nome_cientifico')";

                    mysqli_query($conexao, $query) or die ($query);

                    echo "<h1 class = 'text-center'>Cadastrado com sucesso!</h1>";
                }
            ?>
        </div>
        <!--Bibliotecas necessárias para o bootstrap-->
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
