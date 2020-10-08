<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

    <title>Listar Gêneros</title>
</head>
<body>
    <?php
        include "../inc/cabecalho.inc";
    ?>
    <div class = "container">
        <form method = "POST" action = "genero.php">
            <div class = "row">
                <select name = "nome_cientifico_genero" class = "form-control col-3 offset-1">
                    <option value = "">::Selecione uma familia::</option>
                    <?php
                        include "conexao.php";

                        $select = "SELECT familia.nome_cientifico FROM familia";

                        $resultado = mysqli_query($conexao, $select);
                        while($linha=mysqli_fetch_assoc($resultado)){
                            echo "<option value = '". $linha["nome_cientifico"] ."'>". $linha["nome_cientifico"] ."</option>";
                        }
                    ?>
                </select>

                <input class = "form-control offset-1 col-3" type = "text" name =" nome" placeholder = "Nome científico..." />
                <button class = "btn btn-primary offset-1 col-2">Pesquisar</button>
            </div>
        </form>
        <br/><hr/>

        <?php
            include "conexao.php";

            $select = "SELECT genero.nome_cientifico AS degenero, familia.nome_cientifico AS defamilia
                FROM genero INNER JOIN familia
                    ON genero.cod_familia = familia.id_familia ";

                if(!empty($_POST)){
                    $select .= " where (1 = 1)";

                    if($_POST["nome"] != ""){
                        $nome = $_POST["nome"];
                        $select .= " AND genero.nome_cientifico = '$nome' ";
                    }

                    if($_POST["nome_cientifico_genero"] != ""){
                        $nome = $_POST["nome_cientifico_genero"];
                        $select .= " AND familia.nome_cientifico = '$nome' ";
                    }

                }

            $select .= " ORDER BY id_genero";
            $resultado = mysqli_query($conexao, $select);

            echo '
                <table class = "table">
                    <tr>
                        <th colspan = "2" class = "text-center">Gênero</th>
                    </tr>
                    <tr>
                        <th class = "text-center">Nome Científico</th>
                        <th class = "text-center">Família</th>
                    </tr>
            ';

            while($linha = mysqli_fetch_assoc($resultado)){
                echo "
                    <tr>
                        <td class = \"text-center\">". $linha["degenero"] ."</td>
                        <td class = \"text-center\">". $linha["defamilia"] ."</td>
                    </tr>
                ";
            }

            echo '</table>';
        ?>
    </div>

    <!--Bibliotecas necessárias para o bootstrap-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</body>
</html>
