<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Música</title>

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
                    <h3>Cadastro de Músicas</h3>
                    <br>
                </div>
            </div>
            <?php
                if(empty($_POST)){
                    echo'
                        <form action = "formMusica.php" method = "POST">
                            <div class="row">
                                <div class="col-1">
                                    Nome:
                                </div>
                                <div class="col">
                                    <input class = "form-control" type = "text" name = "nomeMusica" placeholder = "Nome da Música"/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-1">
                                    Gênero:
                                </div>
                                <div class="col">
                                    <select class = "form-control" name = "IDGenero">
                                        <option value = "">Selecione um gênero</option>';
                                            include "conexao.php";

                                            $query = "select genero.id_genero as ID, genero.nome as nomeGenero from genero";
                                            $resultados = mysqli_query($conexao, $query) or die ($query);

                                            while($linha = mysqli_fetch_assoc($resultados)){
                                                echo "<option value = '". $linha["ID"] ."'>". $linha["nomeGenero"] ."</option>";
                                            }
                                        echo '
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-1">
                                    Banda:
                                </div>
                                <div class="col">
                                    <select class = "form-control" name = "IDBanda" disabled>
                                        <option value = "">Selecione uma Banda</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    Código de Incorporação:
                                </div>
                                <div class="col">
                                    <textarea class = "form-control" name = "codigoMusica" placeholder = "Digite o código de incorporação"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <button class = "btn btn-primary" type="submit">Cadastrar Banda</button>
                                </div>
                                <div="col">
                                    <button class = "btn btn-secondary" type="reset">Limpar Dados</button>
                                </div>
                            </div>
                        </form>
                    ';
                }else{
                    $nomeMusica = $_POST["nomeMusica"];
                    $IDBanda = $_POST["IDBanda"];
                    $codigoMusica = $_POST["codigoMusica"];

                    include "conexao.php";
                    if($nomeMusica != "" && $IDBanda != "" && $codigoMusica != ""){
                        $query = "insert into musica(nome, cod_banda, youtube) values('$nomeMusica', $IDBanda, '$codigoMusica')";
                        mysqli_query($conexao, $query) or die($query);

                        echo "<div class='alert alert-success' role='alert'>
                                Música cadastrada com sucesso!
                            </div>
                        ";
                    }else{
                        echo "<div class='alert alert-warning' role='alert'>Preencha todos os campos!</div>";
                    }
                }
            ?>
        </div>

        <!--Bibliotecas necessárias-->
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
