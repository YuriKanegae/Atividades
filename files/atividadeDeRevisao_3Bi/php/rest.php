<?php
    include "../php/conexao.php";
    if(!empty($_POST)){
        $operacao = $_POST["operacao"];
    }else{
        $operacao = $_REQUEST["operacao"];
    }


    if($operacao == "post"){
        $tabela = $_POST["tabela"];

        if($tabela == "nicho"){
            $nomeNicho = $_POST["nomeNicho"];

            $query = "insert into nicho (nome) values ('$nomeNicho');";
            mysqli_query($conexao, $query) or die ($query);

            header("Location: form_nicho.php");
        }

        if($tabela == "categoria"){
            $nomeCategoria = $_POST["nomeCategoria"];
            $IDNicho = $_POST["nicho"];

            $query = "insert into categoria (nome, id_nicho) values ('$nomeCategoria', $IDNicho);";
            mysqli_query($conexao, $query) or die ($query);

            header("Location: form_categoria.php");
        }

        if($tabela == "produto"){
            $nomeProduto = $_POST["nomeProduto"];
            $IDCategoria = $_POST["categoria"];

            $query = "insert into produto (nome, id_categoria) values ('$nomeProduto', $IDCategoria);";
            mysqli_query($conexao, $query) or die ($query);

            $preco = $_POST["precoProduto"];

            $query = "select produto.id_produto from produto where produto.nome = '$nomeProduto';";
            $resultados = mysqli_query($conexao, $query);
            $resultados = mysqli_fetch_row($resultados);
            $IDProduto = $resultados[0];

            $query = "insert into precos (preco, id_produtos) values ('$preco', $IDProduto);";
            mysqli_query($conexao, $query) or die ($query);

            header("Location: form_produto.php");
        }

        if($tabela == "precos"){
            $preco = $_POST["precoProduto"];
            $IDProduto = $_POST["produto"];

            $query = "insert into precos (preco, id_produtos) values ('$preco', $IDProduto);";
            mysqli_query($conexao, $query) or die ($query);

            header("Location: form_preco.php");
        }
    }else if($operacao = "get"){
        $tabela = $_REQUEST["tabela"];
        if($tabela = "precos"){
            $IDProduto = $_REQUEST["produto"];

            $query = "select precos.preco as preco from precos where precos.id_produtos = ". $IDProduto;
            $resultados = mysqli_query($conexao, $query);

            $datasetsData = array();
            $cont = 0;
            while($linha = mysqli_fetch_assoc($resultados)){
                $datasetsData[$cont]["y"] = floatval($linha["preco"]);
                $datasetsData[$cont]["x"] = $cont;

                $cont++;
            }

            header('Content-Type: application/json');
            echo json_encode($datasetsData, JSON_NUMERIC_CHECK);
        }
    }
?>
