<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Genêro</title>
    </head>
    <body>
        <?php
            include "../inc/cabecalho.inc";
        ?>

        <form action = "formGenero.php" method = "POST">
            <div class = "row">

                <select name = "familia" class = "form-control col-3 offset-1">
                    <option value = "">::Selecione um familia::</option>
                        <?php
                            include "conexao.php";

                            $select = "SELECT familia.id_familia, familia.nome_cientifico FROM familia";

                            $resultado = mysqli_query($conexao, $select);
                            while($linha=mysqli_fetch_assoc($resultado)){
                                echo "<option value = '". $linha["id_familia"] ."'>". $linha["nome_cientifico"] ."</option>";
                            }
                        ?>
                </select>

                <input class = "form-control offset-1 col-3" type = "text" name = "nome_cientifico" placeholder = "Nome Científico.."/>

                <button class = "btn btn-primary offset-1 col-2">cadastrar</button>
            </div>
        </form>

        <?php
            if(!empty($_POST)){
                $familia = $_POST["familia"];
                $nome_cientifico = $_POST["nome_cientifico"];

                include "../php/conexao.php";

                $query = "insert into genero(nome_cientifico, cod_familia) values('$nome_cientifico', '$familia')";

                mysqli_query($conexao, $query) or die ($query);

                echo "<h1 class = 'text-center'>Cadastrado com sucesso!</h1>";
            }
        ?>

        <!--Bibliotecas necessárias para o bootstrap-->
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
