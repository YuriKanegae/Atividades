<?php
    include "conf.php";

    cabecalho();
?>
<script>
    function removerNicho(ID){
        confirmar = confirm("Você tem certeza?");
        if(confirmar){
            $.ajax({url: 'rest.php', data: "operacao=delete&tabela=nicho&ID="+ ID, success: function(){
                    window.location.reload(true);
                }
            });
        }
    }

    function geraDados(IDNicho){

        $.ajax({url: 'rest.php', data: "operacao=get&tabela=nicho&nicho="+ IDNicho, success: function(m){
                $("input[name=nomeNicho]").val(m);
                $("input[name=id_nicho]").val(IDNicho);
            }
        });
    }

    function atualizaNicho(){
        var nomeNicho = $("input[name=nomeNicho]").val();
        var idNicho = $("input[name=id_nicho]").val();

        if(nomeNicho != ""){
            $.ajax({url: 'rest.php', data: "operacao=update&tabela=nicho&ID="+ idNicho +"&nomeNicho="+ nomeNicho, success: function(m){
                    console.log(m);
                    $('#modalNicho').modal('hide');
                }
            });
        }
    }
</script>
<h1 class = "text-center">Listagem dos Nichos</h1>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</th>
            <th scope = "col" class = "text-center">Nome do nicho</th>
            <th scope = "col" class = "text-center">Remover</th>
            <th scope = "col" class = "text-center">Atualizar</th>

        </tr>
    </thead>

    <tbody>
        <?php
            $query = "select nicho.id_nicho as ID, nicho.nome as nome from nicho";
            $resultados = mysqli_query($conexao, $query);

            while($linha = mysqli_fetch_assoc($resultados)){
                echo'
                    <tr>
                        <th scope = "col" class = "text-center">'. $linha['ID'] .'</th>
                        <td scope = "col" class = "text-center">'. $linha['nome'] .'</td>
                        <td scope = "col" class = "text-center">
                            <input name = "remover" class = "btn btn-danger" onclick = "removerNicho('. $linha['ID'] .')" value = "Remover"/>
                        </td>
                        <td scope = "col" class = "text-center">
                            <button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#modalNicho" onclick = "geraDados('. $linha['ID'] .')">
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
<div class = "modal fade" id = "modalNicho" tabindex = "-1" role = "dialog" aria-labelledby = "modalNicho" aria-hidden = "true">
    <div class = "modal-dialog" role = "document">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title" id = "tituloModal">Atualização de produto</h5>
                <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class = row>
                        <input class = "form-control col-6 offset-3" type = "text" name = "nomeNicho">
                    </div>
                    <input type = "hidden" name = "id_nicho" value = "0"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Fechar</button>
                <button type = "button" class = "btn btn-primary" onclick = "atualizaNicho()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<?php
    rodape();
?>
