<?php
    include "conf.php";

    cabecalho();
?>
<script src = "../js/Chart.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>

    function geraDados(){
        var IDProduto = $('select[name=produto]').val();
        var dados;
        if(IDProduto != ""){
            $.ajax({url: 'rest.php', data: "operacao=get&tabela=precos&produto="+ IDProduto, success: function(m){
                    config = {
                        animationEnabled: true,
                        theme: "light2",
                        title:{
                            text: ""
                        },
                        data: [{
                            type: "line",
                            indexLabelFontSize: 16,
                        }]
                    };
                    config["data"][0]["dataPoints"] = m;
                    console.log(config);
                    chart = new CanvasJS.Chart("chartContainer", config);
                    chart.render();
                }
            });
        }
    }
</script>

<h1 class = "text-center">Variação de preços</h1>
<form>
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
        <input type = "button" class = "btn btn-primary col-6 offset-3" onclick = "geraDados()" value = "Analisar">
    </div>
</form>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<?php
    rodape();

?>
