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
            <div class="row text-center">
                <div class="col">
                    <h3>Lista de Bandas</h3>
                </div>
            </div>
            <br>
            <form action = "listaBanda.php" method = "POST">
                <div class="row text-center">
                    <div class="col-3">
                        Filtrar pelo gênero:
                    </div>
                    <div class="col">
                        <select class = "form-control" name = "IDGenero">
                            <option value = "">Selecione um genêro</option>
                            <?php
                                include "conexao.php";

                                $query = "select genero.id_genero as ID, genero.nome as nomeGenero from genero";
                                $resultados = mysqli_query($conexao, $query) or die ($query);

                                while($linha = mysqli_fetch_assoc($resultados)){
                                    echo "<option value = '". $linha["ID"] ."'>". $linha["nomeGenero"] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class="col-3">
                        Filtrar pela banda:
                    </div>
                    <div class="col">
                        <input class = "form-control" type = "text" name = "nomeBanda" placeholder = "Nome da Banda"/>
                    </div>
                    <br/>
                </div>
                <br>
                <div class="row">
                    <div class="col-1">
                        <button class = "btn btn-primary" type="submit">Filtrar</button>
                    </div>
                    <div class="col">
                        <a class = "btn btn-secondary" href="listaBanda.php" role="button">Limpar Filtro</a>
                    </div>
                </div>
            </form>
            <br>
            <table class = "table text-center table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>#</th>
                        <th>Nome da banda</th>
                        <th>Gênero</th>
                        <th></th>
                        <th></th>
                        <th></th>
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
                        $i=0;
                        while($linha = mysqli_fetch_assoc($resultados)){
                            $i++;
                            echo "
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>".$i."</th>
                                    <td>". $linha["nomeBanda"] ."</td>
                                    <td>". $linha["nomeGenero"]."</td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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
