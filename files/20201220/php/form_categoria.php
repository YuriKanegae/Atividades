<?php
    include "conf.php";

    if(empty($_SESSION["loginID"])){
        header("Location: index.php");
    }
    cabecalho();
?>
<script>
    function checaInput(){
        var nicho = $("select[name=nicho]").val();

        if(nicho == ""){
            alert("Nicho vazio");
            event.preventDefault();
            return false;
        }else{
            var nomeCategoria = $("input[name=nomeCategoria]").val();

            if(nomeCategoria == ""){
                alert("Categoria vazia");
                event.preventDefault();
                return false;
            }
        }

    }

    $(document).ready(function(){
        $("input[name=nomeCategoria]").prop( "disabled", true);

        $("select[name=nicho]").change(function(){
            if($("select[name=nicho]").val() != ""){
                $("input[name=nomeCategoria]").prop( "disabled", false);
            }else{
                $("input[name=nomeCategoria]").val("");
                $("input[name=nomeCategoria]").prop( "disabled", true);
            }
        });
    });
</script>

<h1 class = "text-center">Cadastro de Categorias</h1>
<form method = "post" action = "rest.php" onsubmit = "checaInput();">
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
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeCategoria" placeholder = "Digite o nome da Categoria"/>
    </div>

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "categoria"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
