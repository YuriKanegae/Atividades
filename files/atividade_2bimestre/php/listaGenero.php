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
                <input class = "form-control" type = "text" name = "nomeGenero" placeholder = "Nome do Gênero"/>
                <button class = "btn btn-primary"/>Procurar gênero</button>
            </form><br/>

            <table class = "table">
                <thead>
                    <tr>
                        <th>Nome do gênero</th>
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


                        $resultados = mysqli_query($conexao, $query) or die ($query);
                        while($linha = mysqli_fetch_assoc($resultados)){
                            echo "
                                <tr>
                                    <td>". $linha["nomeGenero"] ."</td>
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
