<?php
    include "conf.php";

    if(empty($_SESSION["loginID"])){
        header("Location: index.php");
    }
    cabecalho();
?>
<script>
    function checaInput(){
        var nomeCategoria = $("select[name=categoria]").val();

        if(nomeCategoria == ""){
            alert("Categoria vazia");
            event.preventDefault();
            return false;
        }else{
            var nomeProduto = $("input[name=nomeProduto]").val();

            if(nomeProduto == ""){
                alert("Produto vazio");
                event.preventDefault();
                return false;
            }else{
                var precoProduto = $("input[name=precoProduto]").val();

                if(precoProduto == ""){
                    alert("Produto sem preço");
                    event.preventDefault();
                    return false;
                }
            }
        }

    }

    $(document).ready(function(){
        $("input[name=nomeProduto]").prop( "disabled", true);
        $("input[name=precoProduto]").prop( "disabled", true);

        $("select[name=categoria]").change(function(){
            if($("select[name=categoria]").val() != ""){
                $("input[name=nomeProduto]").prop( "disabled", false);
            }else{
                $("input[name=nomeProduto]").val("");
                $("input[name=nomeProduto]").prop( "disabled", true);
            }
        })

        $("input[name=nomeProduto]").change(function(){
            if($("input[name=nomeProduto]").val() != ""){
                $("input[name=precoProduto]").prop( "disabled", false);
            }else{
                $("input[name=precoProduto]").val("");
                $("input[name=precoProduto]").prop( "disabled", true);
            }
        })
    });
</script>
<h1 class = "text-center">Cadastro de Produtos</h1>
<form method = "post" action = "rest.php" onsubmit = "checaInput()">
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

    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeProduto" placeholder = "Digite o nome do produto"/>
    </div>

    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "number"  step = "0.01" name = "precoProduto" placeholder = "Digite o preço do produto"/>
    </div>

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "produto"/>
    <input type = "hidden" name = "empresa" value = "<?php echo $_SESSION["loginID"]?>"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
