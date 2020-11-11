<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Listagem de Produtos</h1>

<form method = "post" action = "lista_produto.php">
    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeProduto" placeholder = "Digite o nome do produto"/>
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

    <select class = "form-control col-6 offset-3" name = "categoria">
        <option value = "">::Selecione a categoria::</option>
        <?php
            $query = 'select categoria.id_categoria as ID, categoria.nome as nome from categoria';
            $resultados = mysqli_query($conexao, $query);

            while($linha = mysqli_fetch_assoc($resultados)){
                echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
            }
        ?>
    </select>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Filtrar</button>
    </div>
</form>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</td>
                <th scope = "col" class = "text-center">Produtos</td>
            <th scope = "col" class = "text-center">Categoria</td>
            <th scope = "col" class = "text-center">Nicho</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select produto.id_produto as ID, produto.nome as nomeProduto, categoria.nome as nomeCategoria, nicho.nome as nomeNicho from produto inner join categoria on categoria.id_categoria = produto.id_categoria inner join nicho on nicho.id_nicho = categoria.id_nicho";

            if(!empty($_POST)){
                $query .= " where (1=1)";

                if($_POST["nomeProduto"] != ""){
                    $query .= " and produto.nome like '%". $_POST["nomeProduto"] ."%'";
                }
                if($_POST["categoria"] != ""){
                    $query .= " and produto.id_categoria = ". $_POST["categoria"];
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
                        <td scope = "col" class = "text-center">'. $linha['nomeProduto'] .'</td>
                        <td scope = "col" class = "text-center">'. $linha['nomeCategoria'] .'</td>
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
