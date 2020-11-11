<?php
    include "conf.php";

    cabecalho();
?>

<h1 class = "text-center">Cadastro de Categorias</h1>
<form method = "post" action = "rest.php">
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

    <input type = "hidden" name = "operacao" value = "post"/>
    <input type = "hidden" name = "tabela" value = "categoria"/>

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Cadastrar</button>
    </div>
</form>

<?php
    rodape();
?>
