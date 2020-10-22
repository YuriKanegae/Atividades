<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Listar Playlist</title>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>

        <div class = "container">
            <form action = "listaPlaylist.php" method = "POST">
                <select class = "form-control" name = "IDPlaylist">
                    <option value = "">::Selecione uma playlist::</option>
                    <?php
                        include "conexao.php";

                        $query = "select playlist.id_playlist as ID, playlist.nome as nomePlaylist from playlist";
                        $resultados = mysqli_query($conexao, $query) or die ($query);

                        while($linha = mysqli_fetch_assoc($resultados)){
                            echo "<option value = '". $linha["ID"] ."'>". $linha["nomePlaylist"] ."</option>";
                        }
                    ?>
                </select>
                <button class = "btn btn-primary">Procurar Gênero</button>
            </form>

            <?php
                include "conexao.php";

                $query = "select playlist.nome nomePlaylist, playlist.id_playlist IDPlaylist from playlist";
                if(!empty($_POST)){
                    $query .= " where (1=1)";

                    if($_POST["IDPlaylist"] != ""){
                        $query .= " and playlist.id_playlist = ". $_POST["IDPlaylist"];
                    }
                }
                $query .= " order by playlist.nome;";
                $resultados = mysqli_query($conexao, $query) or die ($query);

                while($linha = mysqli_fetch_assoc($resultados)){
                    $nomePlaylist = $linha["nomePlaylist"];

                    echo "<h1>". $nomePlaylist ."</h1><br/>";
                    $query2 = "select musica_playlist.cod_musica as codMusica from musica_playlist where musica_playlist.cod_playlist = ". $linha["IDPlaylist"];
                    $resultados2 = mysqli_query($conexao, $query2) or die ($query2);

                    while($linha2 = mysqli_fetch_assoc($resultados2)){
                        $codMusica = $linha2["codMusica"];

                        $query3 = "select musica.nome as nomeMusica, musica.youtube as codMusica, genero.nome as nomeGenero, banda.nome as nomebanda from musica inner join banda banda on musica.cod_banda = banda.id_banda inner join genero on genero.id_genero = banda.cod_genero where musica.id_musica = ". $codMusica;
                        $resultados3 = mysqli_query($conexao, $query3);
                        $resultados3 = mysqli_fetch_row($resultados3);

                        echo $resultados3["0"] . " - " . $resultados3["3"] . " - " . $resultados3["2"]. "<br/>";
                        echo '<iframe width="1158" height="651" src="https://www.youtube.com/embed/'. $resultados3[1] .'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br/>';
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
