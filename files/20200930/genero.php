<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset = "UTF-8">
</head>
<body>
    <b>Pesquisar por:</b><br/>

    <form method = "POST" action = "genero.php">
        <select name = "nome_cientifico_genero">
            <option value = "">::Selecione um familia::</option>
            <?php
                include "conexao.php";

                $select = "SELECT familia.nome_cientifico FROM familia";

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
            <table border = "1">
                <tr>
                    <th colspan = "2">Gênero</th>
                </tr>
                <tr>
                    <th>Nome Científico</th>
                    <th>Família</th>
                </tr>
        ';

        while($linha = mysqli_fetch_assoc($resultado)){
            echo "
                <tr>
                    <td>". $linha["degenero"] ."</td>
                    <td>". $linha["defamilia"] ."</td>
                </tr>
            ";
        }

        echo '</table>';
    ?>
</body>
</html>
