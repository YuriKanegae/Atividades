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
</script>
<h1 class = "text-center">Listagem dos Nichos</h1>
<table class = "table">
    <thead>
        <tr>
            <th scope = "col" class = "text-center">#</th>
            <th scope = "col" class = "text-center">Nome do nicho</th>
            <th scope = "col" class = "text-center">Remover</th>

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
                    </tr>
                ';
            }
        ?>
    </tbody>
</table>
<?php
    rodape();
?>
