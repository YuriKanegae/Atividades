<?php
    include "conf.php";

    if(empty($_SESSION["loginID"])){
        header("Location: index.php");
    }
    cabecalho();
?>

<script>
    function checaInput(){
        var nomeNicho = $("input[name=nomeNicho]").val();

        if(nomeNicho == ""){
            alert("Nome do nicho vazio");
            event.preventDefault();
            return false;
        }

    }
</script>

<h1 class = "text-center">Cadastro de Nichos</h1>
<form method = "post" action = "rest.php" onsubmit = "checaInput();">
    <div class = row>
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeNicho" placeholder = "Digite o nome do Nicho">
    </div>
    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "nicho"/>

    <div class = row>
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
