<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

    <title>Listar Espécie</title>
</head>
<body>
    <?php
        include "../inc/cabecalho.inc";
    ?>
    <div class = "container">
        <form method = "POST" action = "especie.php">
            <div class = "row">
                <select name = "nome_cientifico_familia" class = "form-control offset-1 col-3">
                    <option value = "">::Selecione uma família::</option>
                    <?php
                        include "conexao.php";

                        $select = "SELECT familia.nome_cientifico FROM familia";

                        $resultado = mysqli_query($conexao, $select);
                        while($linha=mysqli_fetch_assoc($resultado)){
                            echo "<option value = '". $linha["nome_cientifico"] ."'>". $linha["nome_cientifico"] ."</option>";
                        }
                    ?>
                </select>

                <select name = "nome_cientifico_genero" class = "form-control offset-1 col-3">
                    <option value = "">::Selecione um genero::</option>
                    <?php
                        include "conexao.php";

                        $select = "SELECT genero.nome_cientifico FROM genero";

                        $resultado = mysqli_query($conexao, $select);
                        while($linha=mysqli_fetch_assoc($resultado)){
                            echo "<option value = '". $linha["nome_cientifico"] ."'>". $linha["nome_cientifico"] ."</option>";
                        }
                    ?>
                </select>

                <input type = "text" name =" nome" placeholder = "Nome científico..." class = "form-control offset-1 col-2"/>
            </div>

            <div class = "row">
                <button class = "btn btn-primary col-2 offset-5">Pesquisar</button>
            </div>
        </form>
        <br/><hr/>

        <?php
            include "conexao.php";

            $select = "SELECT especie.nome AS nome, especie.nome_cientifico AS nome_cientifico_especie, genero.nome_cientifico AS
                nome_cientifico_genero, familia.nome_cientifico AS nome_cientifico_familia FROM especie
                INNER JOIN genero ON especie.cod_genero = genero.id_genero INNER JOIN familia ON genero.cod_familia = familia.id_familia";



            if(!empty($_POST)){
                $select .= " where (1 = 1)";

                if($_POST["nome"] != ""){
                    $nome = $_POST["nome"];
                    $select .= " AND especie.nome_cientifico = '$nome' OR especie.nome = '$nome'";
                }

                if($_POST["nome_cientifico_genero"] != ""){
                    $nome = $_POST["nome_cientifico_genero"];
                    $select .= " AND genero.nome_cientifico = '$nome' ";
                }

                if($_POST["nome_cientifico_familia"] != ""){
                    $nome = $_POST["nome_cientifico_familia"];
                    $select .= " AND familia.nome_cientifico = '$nome' ";
                }

            }
            $select .= " ORDER BY id_especie";

            $resultado = mysqli_query($conexao, $select) or
            die($select);

            echo '<table class = "table">
            <tr>
                <th colspan = "4" class = "text-center">Especie</th>
            </tr>
            <tr>
                <th class = "text-center">Nome</th>
                <th class = "text-center">Nome Científico</th>
                <th class = "text-center">Genêro</th>
                <th class = "text-center">Família</th>
            </tr>';

            while($linha=mysqli_fetch_assoc($resultado)){

                echo "
                    <tr>
                        <td class = \"text-center\">". $linha["nome"] ."</td>
                        <td class = \"text-center\">". $linha["nome_cientifico_especie"] ."</td>
                        <td class = \"text-center\">". $linha["nome_cientifico_genero"] ."</td>
                        <td class = \"text-center\">". $linha["nome_cientifico_familia"] ."</td>
                    </tr>";
            }
            echo '</table>';
        ?>
    </div>
</body>
</html>
