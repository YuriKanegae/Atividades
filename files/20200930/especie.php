<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form method = "POST" action = "especie.php">
        <select name = "nome_cientifico_familia">
            <option value = "">::Selecione uma família::</option>
            <?php
                include "conexao.php";

                $select = "SELECT familia.nome_cientifico FROM familia";

                $resultado = mysqli_query($conexao, $select);
                while($linha=mysqli_fetch_assoc($resultado)){
                    echo "<option value = '". $linha["nome_cientifico"] ."'>". $linha["nome_cientifico"] ."</option>";
                }
            ?>
        </select><br/>

        <select name = "nome_cientifico_genero">
            <option value = "">::Selecione um genero::</option>
            <?php
                include "conexao.php";

                $select = "SELECT genero.nome_cientifico FROM genero";

                $resultado = mysqli_query($conexao, $select);
                while($linha=mysqli_fetch_assoc($resultado)){
                    echo "<option value = '". $linha["nome_cientifico"] ."'>". $linha["nome_cientifico"] ."</option>";
                }
            ?>
        </select><br/>

        <input type = "text" name =" nome" placeholder = "Nome científico..." />
        <button>Pesquisar</button>
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

        echo '<table border="1">
        <tr>
            <th colspan="4">Especie</th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>Nome Científico</th>
            <th>Genêro</th>
            <th>Família</th>
        </tr>';

        while($linha=mysqli_fetch_assoc($resultado)){

            echo "
                <tr>
                    <td>". $linha["nome"] ."</td>
                    <td>". $linha["nome_cientifico_especie"] ."</td>
                    <td>". $linha["nome_cientifico_genero"] ."</td>
                    <td>". $linha["nome_cientifico_familia"] ."</td>
                </tr>";
        }
        echo '</table>';
    ?>
</body>
</html>
