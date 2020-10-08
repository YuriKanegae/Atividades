<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Espécie</title>
    </head>
    <body>
        <?php
            include "../inc/cabecalho.inc";
        ?>

        <form action = "formEspecie.php" method = "POST">
            <div class = "row">

                <select name = "nome_cientifico_familia" class = "form-control col-3 offset-2">
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

                <select name = "nome_cientifico_genero" class = "form-control col-3 offset-2">
                    <option value = "">::Selecione um Gênero::</option>
                        <?php
                            include "conexao.php";

                            $select = "SELECT genero.id_genero, genero.nome_cientifico FROM genero";

                            $resultado = mysqli_query($conexao, $select);
                            while($linha=mysqli_fetch_assoc($resultado)){
                                echo "<option value = '". $linha["id_genero"] ."'>". $linha["nome_cientifico"] ."</option>";
                            }
                        ?>
                </select>
            </div><br/>
            <div class = "row">

                <input class = "form-control offset-2 col-3" type = "text" name = "nome" placeholder = "Nome ..."/>
                <input class = "form-control offset-2 col-3" type = "text" name = "nome_cientifico" placeholder = "Nome Científico..."/>
            </div>
            <div class = "row">
                <button class = "btn btn-primary offset-5 col-2">cadastrar</button>
            </div>
        </form>
        <?php

            if(!empty($_POST)){
                $familia = $_POST["nome_cientifico_familia"];
                $genero = $_POST["nome_cientifico_genero"];
                $nome = $_POST["nome"];
                $nome_cientifico = $_POST["nome_cientifico"];

                include "conexao.php";

                $query = "insert into especie(nome, nome_cientifico, cod_genero) values('$nome', '$nome_cientifico', '$genero')";

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
