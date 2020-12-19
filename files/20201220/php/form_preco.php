<?php
    include "conf.php";

    if(empty($_SESSION["loginID"])){
        header("Location: index.php");
    }
    cabecalho();
?>
<script>
    function checaInput(){
        var produto = $("select[name=produto]").val();

        if(produto == ""){
            alert("Nome do produto vazio");
            event.preventDefault();
            return false;
        }else{
            var preco = $("input[name=precoProduto]").val();

            if(preco == ""){
                alert("Preco do produto vazio");
                event.preventDefault();
                return false;
            }
        }

    }

    $(document).ready(function(){
        $("input[name=precoProduto]").prop( "disabled", true);

        $("select[name=produto]").change(function(){
            if($("select[name=produto]").val() != ""){
                $("input[name=precoProduto]").prop( "disabled", false);
            }else{
                $("input[name=precoProduto]").val("");
                $("input[name=precoProduto]").prop( "disabled", true);
            }
        });
    });
</script>
<h1 class = "text-center">Atualização de preços</h1>
<form method = "post" action = "rest.php" onsubmit = "checaInput()">
    <div class = "row">
        <select class = "form-control col-6 offset-3" name = "produto">
            <option value = "">::Selecione o produto::</option>
            <?php
                $query = 'select produto.id_empresa as IDEmpresa, produto.id_produto as ID, produto.nome as nome from produto';
                $resultados = mysqli_query($conexao, $query);

                while($linha = mysqli_fetch_assoc($resultados)){
                    if($linha["IDEmpresa"] == $_SESSION["loginID"]){
                        echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
                    }
                }
            ?>
        </select>
    </div>

    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "number"  step = "0.01" name = "precoProduto" placeholder = "Digite o preço do produto"/>
    </div>

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "precos"/>
    <input type = "hidden" name = "empresa" value = "<?php echo $_SESSION["loginID"]?>"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
