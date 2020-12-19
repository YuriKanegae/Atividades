<?php
    include "conf.php";

    cabecalho();
?>
<script>
    function removerNicho(ID){
        confirmar = confirm("Você tem certeza?");
        if(confirmar){
            $.ajax({url: 'rest.php', data: "operacao=delete&tabela=categoria&ID="+ ID,
                success: function(data){
                    window.location.reload(true);
                }
            });
        }
    }

    function geraDados(IDCategoria){

        $.ajax({url: 'rest.php', data: "operacao=get&tabela=categoria&categoria="+ IDCategoria, success: function(m){
                $("input[name=nomeCategoriaF]").val(m["nomeCategoria"]);
                $("select[name=nichoF]").val(m["IDNicho"]);
                $("input[name=IDCategoriaF]").val(IDCategoria);
            }
        });
    }

    function atualizaCategoria(){

        var nomeCategoria = $("input[name=nomeCategoriaF]").val();
        var IDNicho = $("select[name=nichoF]").val();
        var IDCategoria = $("input[name=IDCategoriaF]").val();

        if(nomeCategoria != ""){
            console.log(nomeCategoria, IDNicho, IDCategoria);
            $.ajax({url: 'rest.php', data: "operacao=update&tabela=categoria&IDCategoria="+ IDCategoria +"&IDNicho="+ IDNicho +"&nomeCategoria="+ nomeCategoria, success: function(m){
                    console.log(m);
                }
            });
        }
    }
</script>
<h1 class = "text-center">Listagem de Categorias</h1>

<form method = "post" action = "lista_categoria.php">
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

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Filtrar</button>
    </div>
</form>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</th>
            <th scope = "col" class = "text-center">Categoria</th>
            <th scope = "col" class = "text-center">Nicho</th>
            <th scope = "col" class = "text-center">Remover</th>
            <th scope = "col" class = "text-center">Atualizar</th>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select categoria.id_categoria as ID, categoria.nome as nome, nicho.nome as nomeNicho from categoria inner join nicho on categoria.id_nicho = nicho.id_nicho";

            if(!empty($_POST)){
                $query .= " where (1=1)";

                if($_POST["nomeCategoria"] != ""){
                    $query .= " and categoria.nome like '%". $_POST["nomeCategoria"] ."%'";
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
                        <td scope = "col" class = "text-center">'. $linha['nome'] .'</td>
                        <td scope = "col" class = "text-center">'. $linha['nomeNicho'] .'</td>
                        <td scope = "col" class = "text-center">
                            <input name = "remover" class = "btn btn-danger" onclick = "removerNicho('. $linha['ID'] .')" value = "Remover"/>
                        </td>
                        <td scope = "col" class = "text-center">
                            <button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#modalCategoria" onclick = "geraDados('. $linha['ID'] .')">
                                Atualizar
                            </button>
                        </td>
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>


<!-- Modal de atualização-->
<div class = "modal fade" id = "modalCategoria" tabindex = "-1" role = "dialog" aria-labelledby = "modalCategoria" aria-hidden = "true">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title" id = "tituloModal">Atualização de Categorias</h5>
                <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class = "row">
                        <select class = "form-control col-6 offset-3" name = "nichoF">
                            <?php
                                $query = 'select nicho.id_nicho as ID, nicho.nome as nome from nicho';
                                $resultados = mysqli_query($conexao, $query);

                                while($linha = mysqli_fetch_assoc($resultados)){
                                    echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class = row>
                        <input class = "form-control col-6 offset-3" type = "text" name = "nomeCategoriaF">
                    </div>
                    <input type = "hidden" name = "IDCategoriaF" value = "0"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Fechar</button>
                <button type = "button" class = "btn btn-primary" onclick = "atualizaCategoria()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<?php
    rodape();
?>
