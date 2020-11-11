<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Listagem de Categorias</h1>

<form method = "post" action = "lista_categoria.php">
    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeCategoria" placeholder = "Digite o nome da Categoria"/>
    </div>

    <div class = "row">
        <select class = "form-control col-6 offset-3" name = "nicho">
            <option value = "">::Selecione o nicho::</option>
            <?php
                $query = 'select nicho.id_nicho as ID, nicho.nome as nome from nicho';
                $resultados = mysqli_query($conexao, $query);

                while($linha = mysqli_fetch_assoc($resultados)){
                    echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
                }
            ?>
        </select>
    </div>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Filtrar</button>
    </div>
</form>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</td>
            <th scope = "col" class = "text-center">Categoria</td>
            <th scope = "col" class = "text-center">Nicho</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select categoria.id_categoria as ID, categoria.nome as nome, nicho.nome as nomeNicho from categoria inner join nicho on categoria.id_nicho = nicho.id_nicho";

            if(!empty($_POST)){
                $query .= " where (1=1)";

                if($_POST["nomeCategoria"] != ""){
                    $query .= " and categoria.nome like '%". $_POST["nomeCategoria"] ."%'";
                }
                if($_POST["nicho"] != ""){
                    $query .= " and categoria.id_nicho = ". $_POST["nicho"];
                }
            }

            $resultados = mysqli_query($conexao, $query) or die ($query);

            while($linha = mysqli_fetch_assoc($resultados)){
                echo'
                    <tr>
                        <th scope = "col" class = "text-center">'. $linha['ID'] .'</th>
                        <td scope = "col" class = "text-center">'. $linha['nome'] .'</td>
                        <td scope = "col" class = "text-center">'. $linha['nomeNicho'] .'</td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
<?php
    rodape();
?>
