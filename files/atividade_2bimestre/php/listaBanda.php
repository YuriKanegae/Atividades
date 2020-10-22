<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Listar Banda</title>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>

        <div class = "container">
            <form action = "listaBanda.php" method = "POST">
                <select class = "form-control" name = "IDGenero">
                    <option value = "">::Selecione um genêro::</option>
                    <?php
                        include "conexao.php";

                        $query = "select genero.id_genero as ID, genero.nome as nomeGenero from genero";
                        $resultados = mysqli_query($conexao, $query) or die ($query);

                        while($linha = mysqli_fetch_assoc($resultados)){
                            echo "<option value = '". $linha["ID"] ."'>". $linha["nomeGenero"] ."</option>";
                        }
                    ?>
                </select>

                <input class = "form-control" type = "text" name = "nomeBanda" placeholder = "Nome da Banda"/>
                <button class = "btn btn-danger">Filtrar</button>
            </form><br/>

            <table class = "table">
                <thead>
                    <tr>
                        <th>Nome da banda</th>
                        <th>Gênero</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "conexao.php";

                        $query = "select banda.nome as nomeBanda, genero.nome as nomeGenero from banda inner join genero on banda.cod_genero = genero.id_genero";
                        if(!empty($_POST)){
                            $query .= " where (1=1)";

                            if($_POST["nomeBanda"] != ""){
                                $query .= " and banda.nome like '%" . $_POST["nomeBanda"] ."%'";
                            }

                            if($_POST["IDGenero"] != ""){
                                $query .= " and banda.cod_genero = ". $_POST["IDGenero"];
                            }
                        }
                        $query .= " order by banda.nome";

                        $resultados = mysqli_query($conexao, $query) or die ($query);

                        while($linha = mysqli_fetch_assoc($resultados)){
                            echo "
                                <tr>
                                    <td>". $linha["nomeBanda"] ."</td>
                                    <td>". $linha["nomeGenero"]."</td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!--Bibliotecas necessárias-->
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
