<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Cadastro de Nichos</h1>
<form method = "post" action = "rest.php">
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
