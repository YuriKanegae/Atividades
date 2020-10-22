<?php
    include "conexao.php";
    $paginaOrigem = $_GET["paginaOrigem"];

    if($paginaOrigem = "formMusica"){
        $idGenero = $_GET["id"];

        $query = "select banda.id_banda as IDBanda, banda.nome as nomeBanda from Banda where banda.cod_genero = ". $idGenero;

        $resultados = mysqli_query($conexao, $query);
        $resultadosFormatados = array();

        $i = 0;
        while($linha = mysqli_fetch_assoc($resultados)){

            $dados = array();
            $dados["IDBanda"] = $linha["IDBanda"];
            $dados["nomeBanda"] = $linha["nomeBanda"];
            $resultadosFormatados[] = $dados;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($resultadosFormatados);
?>
