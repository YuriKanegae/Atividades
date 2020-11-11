<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Cadastro de Produtos</h1>
<form method = "post" action = "rest.php">
    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeProduto" placeholder = "Digite o nome do produto"/>
    </div>

    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "number"  step = "0.01" name = "precoProduto" placeholder = "Digite o preço do produto"/>
    </div>

    <div class = "row">
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
    </div>

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "produto"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
