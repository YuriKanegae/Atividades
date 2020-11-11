<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Listagem dos Nichos</h1>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</td>
            <th scope = "col" class = "text-center">Nome do nicho</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select nicho.id_nicho as ID, nicho.id_nicho as nome from nicho";
            $resultados = mysqli_query($conexao, $query);

            while($linha = mysqli_fetch_assoc($resultados)){
                echo'
                    <tr>
                        <th scope = "col" class = "text-center">'. $linha['ID'] .'</th>
                        <td scope = "col" class = "text-center">'. $linha['nome'] .'</td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
<?php
    rodape();
?>
