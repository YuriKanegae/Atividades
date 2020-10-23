<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>

        <title>Cadastrar Playlist</title>
    </head>
    <body>
        <?php include "../inc/cabecalho.inc";?>
        <div class = "container">
            <div class="row text-center">
                <div class="col">
                    <h3>Cadastro de Playlists</h3>
                </div>
            </div>
            <br>
            <?php
                include "conexao.php";

                if(empty($_POST)){
                    echo '
                        <form action = "formPlaylist.php" method = "POST">
                        <div class="row">
                            <div class="col-1">
                                Nome:
                            </div>
                            <div class="col">
                                <input class = "form-control" type = "text" name = "nomePlaylist" placeholder = "Nome do Playlist"/><br/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-3">
                                Selecione pelo menos uma música:
                            </div>
                        </div>
                        <br>
                    ';

                    $query = "select musica.id_musica as codigo, musica.nome as nomeMusica, banda.nome as nomeBanda, genero.nome as nomeGenero from musica inner join banda on musica.cod_banda = banda.id_banda inner join genero on banda.cod_genero = genero.id_genero";

                    $resultados = mysqli_query($conexao, $query) or die ($query);
                    while($linha = mysqli_fetch_assoc($resultados)){
                        echo '<input type = "checkbox" name = "' .$linha["codigo"]. '"> '. $linha["nomeMusica"] .' - '. $linha["nomeBanda"] .'('. $linha["nomeGenero"].')<br/>';
                    }

                    echo '<br>
                        <div class="row">
                            <div class="col">
                                <button class = "btn btn-primary" type="submit">Cadastrar Playlist</button>
                                <button class = "btn btn-secondary" type="reset">Limpar Dados</button>
                            </div>
                        </div>
                        </form>
                    ';
                }else{
                    $nomePlaylist = $_POST["nomePlaylist"];
                    
                    if($nomePlaylist != ""){
                        $query = "insert into playlist(nome) values('$nomePlaylist')";
                        mysqli_query($conexao, $query)
                            or die($query);
    
                        $query = "select playlist.id_playlist as IDPlaylist from playlist where playlist.nome = '". $nomePlaylist ."'";
                        $idPlaylist = mysqli_query($conexao, $query) or die($query);
                        $idPlaylist = mysqli_fetch_row($idPlaylist) or die($query);
    
                        $query = "select musica.id_musica IDMusica from musica";
                        $resultados = mysqli_query($conexao, $query) or die ($query);
    
                        $query2 = "insert into musica_playlist(cod_musica, cod_playlist) values";
                        $vetorId = array();
                        while($linha = mysqli_fetch_assoc($resultados)){
                            $idMusica = $linha["IDMusica"];
    
                            if(isset($_POST[$idMusica])){
                                $vetorId[] = $idMusica;
                            }
                        }
                    
                        for($i = 0; $i < sizeof($vetorId)-1; $i++){
                            $query2 .= " ($vetorId[$i], ". $idPlaylist[0]."),";
                        }
                        $query2 .= " ($vetorId[$i], ". $idPlaylist[0].")";
                        mysqli_query($conexao, $query2) or die($query2);

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
        <script src = "../js/jquery-3.3.1.min.js"></script>
        <script src = "../js/popper.min.js"></script>
        <script src = "../js/bootstrap.min.js"></script>
    </body>
</html>
