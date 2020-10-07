<!DOCTYPE html>
<html lang = "pt-br">
<head>
    <meta charset = "UTF-8">
</head>
<body>
    <b>Pesquisar por:</b><br />
    <form method = "POST" action = "familia.php">
        <input type="text" name="nome" placeholder="procurar nome ou nome científico..." />
        <button>Pesquisar</button>
    </form>

    <br/><hr/>
    <?php
        include "conexao.php";

        $select = "SELECT nome, nome_cientifico FROM familia";
        if(!empty($_POST)){
            $select .= " WHERE ";

            if($_POST["nome"] != ""){
                $nome = $_POST["nome"];
                $select .= " nome = '$nome' OR nome_cientifico = '$nome' ";
            }else{
                $select .= " 1 = 1";
            }
        }

        $select .=" ORDER BY id_familia";
        $resultado = mysqli_query($conexao, $select);

        echo '
            <table border="1">
                <tr>
                    <th colspan="2">Família</th>
                </tr>
                <tr>
                    <th>Nome</th>
                    <th>Nome Científico</th>
                </tr>
            ';

        while($linha=mysqli_fetch_assoc($resultado)){
            echo "
                <tr>
                    <td>". $linha["nome"] ."</td>
                    <td>". $linha["nome_cientifico"] ."</td>
                </tr>
                ";
        }
        echo '</table>';
    ?>
</body>
</html>
