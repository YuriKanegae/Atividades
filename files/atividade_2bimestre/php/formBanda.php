<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Bandas</title>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>

        <div class = "container">
            <div class="row text-center">
                <div class="col">
                    <h3>Cadastro de Bandas</h3>
                    <br>
                </div>
            </div>
            <form action = "formBanda.php" method = "POST">
                <div class="row">
                    <div class="col-1">
                        Nome:
                    </div>
                    <div class="col">
                        <input class = "form-control" type = "text" name = "nomeBanda" placeholder = "Nome da Banda..."/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-1">
                        Gênero:
                    </div>
                    <div class="col">
                        <select class = "form-control" name = "IDGenero">
                            <option value="">Gênero da Banda</option>
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
                <div class="row">
                    <div class="col-2">
                        <button class = "btn btn-primary">Cadastrar Banda</button>
                    </div>
                    <div class="col">
                        <button class = "btn btn-secondary" type="reset">Limpar Campos</button>
                    </div>
                </div>
            </form>
            <?php
                if(!empty($_POST)){
                    $nomeBanda = $_POST["nomeBanda"];
                    $IDGenero = $_POST["IDGenero"];

                    if($nomeBanda != "" && $IDGenero != ""){
                        $query = "insert into banda(nome, cod_genero) values('$nomeBanda', $IDGenero)";
                        mysqli_query($conexao, $query) or die($query);

                        echo "<div class='alert alert-success' role='alert'>
                                Banda cadastrada com sucesso!
                            </div>
                        ";
                    }else{
                        echo "<div class='alert alert-warning' role='alert'>Preencha todos os campos!</div>";
                    }
                }
            ?>
        </div>

        <!--Bibliotecas necessárias-->
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
