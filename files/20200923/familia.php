<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
        include "conexao.php";

        $select = "SELECT * FROM familia ORDER BY id_familia";
        $resultado = mysqli_query($conexao, $select);

        echo '<table border="1">
        <tr>
            <th colspan="2">Família</th>
        </tr>
        <tr>
            <th>Nome</th>
            <th>Nome Científico</th>
        </tr>';
        while($linha=mysqli_fetch_assoc($resultado)){
            echo "
                <tr>
                    <td>". $linha["nome"] ."</td>
                    <td>". $linha["nome_científico"] ."</td>
                </tr>";
        }
        echo '</table>';
    ?>
</body>
</html>