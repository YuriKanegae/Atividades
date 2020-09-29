<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
        include "conexao.php";

        $select = "SELECT genero.nome_cientifico, familia.nome_científico FROM genero 
                    INNER JOIN familia ON genero.cod_familia = familia.id_familia ORDER BY id_genero";
        $resultado = mysqli_query($conexao, $select);

        echo '<table border="1">
        <tr>
            <th colspan="2">Gênero</th>
        </tr>
        <tr>
            <th>Nome Científico</th>
            <th>Família</th>
        </tr>';
        
        while($linha=mysqli_fetch_assoc($resultado)){
            
            echo "
                <tr>
                    <td>". $linha["nome_cientifico"] ."</td>
                    <td>". $linha["nome_científico"] ."</td>
                </tr>";
        }
        echo '</table>';
    ?>
</body>
</html>