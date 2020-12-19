<?php
    include "conf.php";

    if(empty($_SESSION["loginID"])){
        header("Location: index.php");
    }
    cabecalho();
?>
<script>
    function removerNicho(indice){
        confirmar = confirm("Você tem certeza?");
        if(confirmar){
            $.ajax({url: 'rest.php', data: "operacao=delete&tabela=produto&ID="+ indice, success: function(data){
                    window.location.reload(true);
                }
            });
        }
    }

    function geraDados(IDProduto){
        $.ajax({url: 'rest.php', data: "operacao=get&tabela=produto&produto="+ IDProduto, success: function(m){
                console.log(m);
                $("input[name=nomeProdutoF]").val(m["nomeProduto"]);
                $("select[name=IDCategoriaF]").val(m["IDCategoria"]);
                $("input[name=IDProdutoF]").val(IDProduto);
            }
        });
    }

    function atualizaCategoria(){

        var nomeProduto = $("input[name=nomeProdutoF]").val();
        var IDCategoria = $("select[name=IDCategoriaF]").val();
        var IDProduto = $("input[name=IDProdutoF]").val();

        if(nomeProduto != ""){
            $.ajax({url: 'rest.php', data: "operacao=update&tabela=produto&IDProduto="+ IDProduto +"&IDCategoria="+ IDCategoria +"&nomeProduto="+ nomeProduto, success: function(m){
                    console.log(m);
                }
            });
        }
    }
</script>
<h1 class = "text-center">Listagem de Produtos</h1>

<form method = "post" action = "lista_produto.php">
    <div class = "row">
        <input class = "form-control col-6 offset-3" type = "text" name = "nomeProduto" placeholder = "Digite o nome do produto"/>
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

    <div class = "row">
        <button class = "btn btn-primary col-6 offset-3">Filtrar</button>
    </div>
</form>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</th>
            <th scope = "col" class = "text-center">Produtos</th>
            <th scope = "col" class = "text-center">Categoria</th>
            <th scope = "col" class = "text-center">Nicho</th>
            <?php
                if($_SESSION["empresa"]){
                    echo'
                        <th scope = "col" class = "text-center">Remover</th>
                        <th scope = "col" class = "text-center">Atualizar</th>
                    ';
                }
             ?>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select produto.id_empresa as IDEmpresa, produto.id_produto as ID, produto.nome as nomeProduto, categoria.nome as nomeCategoria, nicho.nome as nomeNicho from produto inner join categoria on categoria.id_categoria = produto.id_categoria inner join nicho on nicho.id_nicho = categoria.id_nicho";

            if(!empty($_POST)){
                $query .= " where (1=1)";

                if($_POST["nomeProduto"] != ""){
                    $query .= " and produto.nome like '%". $_POST["nomeProduto"] ."%'";
                }
                if($_POST["categoria"] != ""){
                    $query .= " and produto.id_categoria = ". $_POST["categoria"];
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
                        <td scope = "col" class = "text-center">'. $linha['nomeProduto'] .'</td>
                        <td scope = "col" class = "text-center">'. $linha['nomeCategoria'] .'</td>
                        <td scope = "col" class = "text-center">'. $linha['nomeNicho'] .'</td>';

                if($_SESSION["empresa"] && $linha["IDEmpresa"] == $_SESSION["loginID"]){
                    echo'
                        <td scope = "col" class = "text-center">
                            <input name = "remover" class = "btn btn-danger" onclick = "removerNicho('. $linha['ID'] .')" value = "Remover"/>
                        </td>
                        <td scope = "col" class = "text-center">
                            <button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#modalProduto" onclick = "geraDados('. $linha['ID'] .')">
                                Atualizar
                            </button>
                        </td>
                    ';
                }else{
                    echo '
                        <td scope = "col" class = "text-center"></td>
                        <td scope = "col" class = "text-center"></td>
                    ';
                }
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<!-- Modal de atualização-->
<div class = "modal fade" id = "modalProduto" tabindex = "-1" role = "dialog" aria-labelledby = "modalCategoria" aria-hidden = "true">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title" id = "tituloModal">Atualização de Protudo</h5>
                <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class = "row">
                        <select class = "form-control col-6 offset-3" name = "IDCategoriaF">
                            <?php
                                $query = 'select categoria.id_categoria as ID, categoria.nome as nome from categoria';
                                $resultados = mysqli_query($conexao, $query);

                                while($linha = mysqli_fetch_assoc($resultados)){
                                    echo '<option value = "' .$linha["ID"] . '">'. $linha["nome"] .'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class = row>
                        <input class = "form-control col-6 offset-3" type = "text" name = "nomeProdutoF">
                    </div>
                    <input type = "hidden" name = "IDProdutoF" value = "0"/>
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
