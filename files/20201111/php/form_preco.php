<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Atualização de preços</h1>
<form method = "post" action = "rest.php">
    <div class = "row">
        <select class = "form-control col-6 offset-3" name = "produto">
            <option value = "">::Selecione o produto::</option>
            <?php
                $query = 'select produto.id_produto as ID, produto.nome as nome from produto';
                $resultados = mysqli_query($conexao, $query);

                while($linha = mysqli_fetch_assoc($resultados)){
                    echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
                }
            ?>
        </select>
    </div>

    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "number"  step = "0.01" name = "precoProduto" placeholder = "Digite o preço do produto"/>
    </div>

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "precos"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
