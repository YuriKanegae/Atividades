<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Listar Música</title>

        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("select[name=IDGenero]").change(function(){
                    var valGenero = $("select[name=IDGenero]").val();
                    console.log(valGenero);
                    if(valGenero == ""){
                        $("select[name=IDBanda]").val("");
                        $("select[name=IDBanda]").prop("disabled", true);
                    }else{
                        $("select[name=IDBanda]").prop("disabled", false);

                        //página de origem - IdBanda
                        $.get('queryScript.php', {paginaOrigem: 'formMusica', id: valGenero},
                            function(json){
                                console.log(json);

                                var HTML = "";
                                for(x in json){
                                    HTML += "<option value = '"+ json[x].IDBanda +"'>"+ json[x].nomeBanda +"</option>";
                                }
                                console.log(HTML);
                                $("select[name=IDBanda]").html(HTML);
                            }
                        );


                    }
                });
            });
        </script>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>
        <div class = "container">
            <div class="row text-center">
                <div class="col">
                    <h3>Lista de Músicas</h3>
                </div>
            </div>
            <br>
            <form action = "listaMusica.php" method = "POST">
                <div class="row text-center">
                    <div class="col-3">
                        Filtrar pelo gênero:
                    </div>
                    <div class="col">
                        <select class = "form-control" name = "IDGenero">
                            <option value = "">Selecione um gênero</option>
                            <?php
                                include "conexao.php";

                                $query = "select genero.id_genero as ID, genero.nome as nomeGenero from genero";
                                $resultados = mysqli_query($conexao, $query) or die ($query);

                                while($linha = mysqli_fetch_assoc($resultados)){
                                    echo "<option value = '". $linha["ID"] ."'>". $linha["nomeGenero"] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class="col-3">
                        Filtrar pela banda:
                    </div>
                    <div class="col">
                        <select  class = "form-control" name = "IDBanda" disabled>
                            <option val = "">Selecione primeiro um gênero</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class="col-3">
                        Filtrar pelo nome da música:
                    </div>
                    <div class="col">                        
                        <input  class = "form-control" type = "text" name = "nomeMusica" placeholder = "Nome da Música"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-1">
                        <button class = "btn btn-primary" type="submit">Filtrar</button>
                    </div>
                    <div class="col">
                        <a class = "btn btn-secondary" href="listaMusica.php" role="button">Limpar Filtro</a>
                    </div>
                </div>
            </form>
            <br/>
            <br/>
            <?php
                include "conexao.php";

                $query = "select musica.youtube as codigo, musica.nome as nomeMusica, banda.nome as nomeBanda, genero.nome as nomeGenero from musica inner join banda on musica.cod_banda = banda.id_banda inner join genero on banda.cod_genero = genero.id_genero";
                if(!empty($_POST)){
                    $query .= " where (1=1)";

                    if($_POST["nomeMusica"] != ""){
                        $query .= " and musica.nome like '%". $_POST["nomeMusica"] ."%'";
                    }
                    if($_POST["IDBanda"] != ""){
                        $query .= " and musica.cod_banda = " . $_POST["IDBanda"];
                    }
                }
                $query .= " order by musica.nome;";
                $resultados = mysqli_query($conexao, $query) or die ($query);

                echo "<div class='row text-center'>";
                while($linha = mysqli_fetch_assoc($resultados)){
                    echo "
                            <div class='col'>
                                <b>Música: </b>".$linha["nomeMusica"] . " - " . $linha["nomeBanda"] . "(" . $linha["nomeGenero"]. ")<br/>";
                    echo '<iframe width="533" height="300" src="https://www.youtube.com/embed/'. $linha["codigo"] .'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>';
                    echo '
                            </div>
                    ';
                }
                echo "</div>";
            ?>
        </div>

        <!--Bibliotecas necessárias-->
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
