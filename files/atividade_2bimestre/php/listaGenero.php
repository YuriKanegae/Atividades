<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Listar Genêros</title>
    </head>
    <body>
        <?php
            include "../inc/cabecalho.inc";
        ?>

        <div class = "container">
            <form action = "listaGenero.php" method = "POST">
                <div class="row text-center">
                    <div class="col">
                        <h3>Lista de Gêneros</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-3">
                        Filtrar pelo nome do Gênero:
                    </div>
                    <br>
                    <div class="col">
                        <input class = "form-control" type = "text" name = "nomeGenero" placeholder = "Nome do Gênero"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <button class = "btn btn-primary" type="submit">Filtrar</button>
                    </div>
                    <div class="col">
                        <a class = "btn btn-secondary" href="listaGenero.php" role="button">Limpar Filtro</a>
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
                        <th>Gêneros</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "conexao.php";

                        $query = "select genero.nome as nomeGenero from genero";
                        if(!empty($_POST)){
                            $query .= " where (1=1)";

                            if($_POST["nomeGenero"] != ""){
                                $query .= " and genero.nome like '%" . $_POST["nomeGenero"] ."%'";
                            }
                        }
                        $query .= " order by genero.nome;";

                        $i=0;
                        $resultados = mysqli_query($conexao, $query) or die ($query);
                        while($linha = mysqli_fetch_assoc($resultados)){
                            $i++;
                            echo "
                                <tr>
                                <th></th>
                                    <td></td>
                                    <th>". $i ."</th>
                                    <td>". $linha["nomeGenero"] ."</td>
                                    <td></td>
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
