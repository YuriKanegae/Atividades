<!DOCTYPE html>
<html lang = "pt-br">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <link rel = "stylesheet" href="../css/bootstrap.min.css"/>

    <title>Listar famílias</title>
</head>
<body>
    <?php
        include "../inc/cabecalho.inc";
    ?>
    <div class = "container">
        <form method = "POST" action = "familia.php">
            <div class = "row">
                <input class = "form-control offset-2 col-5" type="text" name="nome" placeholder="procurar nome ou nome científico..." />
                <button class = "btn btn-primary offset-1 col-2">Pesquisar</button>
            </div>
        </form>

        <br/><hr/>
        <?php
            include "../php/conexao.php";

            $select = "SELECT nome, nome_cientifico FROM familia";

            if(!empty($_POST)){
                $select .= " WHERE ";

                if($_POST["nome"] != ""){
                    $nome = $_POST["nome"];
                    $select .= " nome = '$nome' OR nome_cientifico = '$nome' ";
                }else{
                    $select .= " 1 = 1";
                }
            }

            $select .=" ORDER BY id_familia";
            $resultado = mysqli_query($conexao, $select);

            echo '
                <table class = "table" border = "1">
                    <tr>
                        <th class = "text-center col" colspan = "2">Família</th>
                    </tr>
                    <tr>
                        <th class = "text-center">Nome</th>
                        <th class = "text-center">Nome Científico</th>
                    </tr>
                ';

            while($linha=mysqli_fetch_assoc($resultado)){
                echo "
                    <tr>
                        <td class = \"text-center\">". $linha["nome"] ."</td>
                        <td class = \"text-center\">". $linha["nome_cientifico"] ."</td>
                    </tr>
                    ";
            }
            echo '</table>';
        ?>
    </div>

    <!--Bibliotecas necessárias para o bootstrap-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</body>
</html>
