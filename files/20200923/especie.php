<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
        include "conexao.php";

        $select = "SELECT especie.nome AS nome, especie.nome_cientifico AS nome_cientifico_especie, genero.nome_cientifico AS 
            nome_cientifico_genero, familia.nome_científico AS nome_cientifico_familia FROM especie 
            INNER JOIN genero ON especie.cod_genero = genero.id_genero INNER JOIN familia ON genero.cod_familia = familia.id_familia 
            ORDER BY id_especie";
        $resultado = mysqli_query($conexao, $select);

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