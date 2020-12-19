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

            if($nomeNicho != ""){
                $query = "insert into nicho (nome) values ('$nomeNicho');";
                mysqli_query($conexao, $query) or die ($query);
            }

            header("Location: form_nicho.php");
        }

        if($tabela == "categoria"){
            $nomeCategoria = $_POST["nomeCategoria"];
            $IDNicho = $_POST["nicho"];

            if($nomeCategoria != "" && $IDNicho != ""){
                $query = "insert into categoria (nome, id_nicho) values ('$nomeCategoria', $IDNicho);";
                mysqli_query($conexao, $query) or die ($query);
            }

            header("Location: form_categoria.php");
        }

        if($tabela == "produto"){
            $nomeProduto = $_POST["nomeProduto"];
            $IDCategoria = $_POST["categoria"];
            $IDEmpresa = $_POST["empresa"];

            if($nomeProduto != "" && $IDCategoria != "" && $IDCategoria != ""){
                $query = "insert into produto (nome, id_categoria, id_empresa) values ('$nomeProduto', $IDCategoria, $IDEmpresa);";
                mysqli_query($conexao, $query) or die ($query);

                $preco = $_POST["precoProduto"];

                $query = "select produto.id_produto from produto where produto.nome = '$nomeProduto';";
                $resultados = mysqli_query($conexao, $query);
                $resultados = mysqli_fetch_row($resultados);
                $IDProduto = $resultados[0];

                $query = "insert into precos (preco, id_produtos) values ('$preco', $IDProduto);";
                mysqli_query($conexao, $query) or die ($query);
            }
            header("Location: form_produto.php");
        }

        if($tabela == "precos"){
            $preco = $_POST["precoProduto"];
            $IDProduto = $_POST["produto"];

            if($preco != "" && $IDProduto != ""){
                $query = "insert into precos (preco, id_produtos) values ('$preco', $IDProduto);";
                mysqli_query($conexao, $query) or die ($query);
            }

            header("Location: form_preco.php");
        }
    }else if($operacao == "get"){
        $tabela = $_REQUEST["tabela"];
        if($tabela == "precos"){
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

        if($tabela == "nicho"){
            $IDNicho = $_REQUEST["nicho"];

            $query = "select nicho.nome as nomeNicho from nicho where nicho.id_nicho = ". $IDNicho;
            $resultados = mysqli_query($conexao, $query) or die ($query);
            $resultados = mysqli_fetch_row($resultados);

            echo $resultados[0];
        }

        if($tabela == "categoria"){
            $IDCategoria = $_REQUEST["categoria"];

            $query = "select categoria.nome as nomeCategoria, categoria.id_nicho as IDNicho from categoria where categoria.id_categoria = ". $IDCategoria;
            $resultados = mysqli_query($conexao, $query) or die ($query);
            while($linha = mysqli_fetch_assoc($resultados)){
                header('Content-Type: application/json');
                echo json_encode($linha);
            }
        }

        if($tabela == "produto"){
            $IDProduto = $_REQUEST["produto"];

            $query = "select produto.nome as nomeProduto, produto.id_categoria as IDCategoria from produto where produto.id_produto = ". $IDProduto;
            $resultados = mysqli_query($conexao, $query) or die ($query);
            while($linha = mysqli_fetch_assoc($resultados)){
                header('Content-Type: application/json');
                echo json_encode($linha);
            }

        }
    }else if($operacao == "delete"){
        $tabela = $_REQUEST["tabela"];
        $ID = $_REQUEST["ID"];

        if($tabela == "nicho"){
            $query = "delete from nicho where nicho.id_nicho = ". $ID;
            $resultados = mysqli_query($conexao, $query);

            header("Location: lista_nicho.php");
        }
        if($tabela == "categoria"){
            $query = "delete from categoria where categoria.id_categoria = ". $ID;
            echo mysqli_query($conexao, $query) or die ($query);

            header("Location: lista_categoria.php");
        }
        if($tabela == "produto"){
            $query = "delete from produto where produto.id_produto = ". $ID;
            mysqli_query($conexao, $query) or die($query);

            header("Location: lista_produto.php");
        }
    }else if($operacao == "update"){
        $tabela = $_REQUEST["tabela"];

        if($tabela == "nicho"){
            $IDNicho = $_REQUEST["ID"];
            $nomeNicho = $_REQUEST["nomeNicho"];

            $query = "update nicho set nicho.nome = '". $nomeNicho ."' where nicho.id_nicho = ". $IDNicho;
            echo mysqli_query($conexao, $query) or die($query);

        }else if($tabela == "categoria"){
            $IDCategoria = $_REQUEST["IDCategoria"];
            $IDNicho = $_REQUEST["IDNicho"];
            $nomeCategoria = $_REQUEST["nomeCategoria"];

            $query = "update categoria set categoria.id_nicho = ". $IDNicho .", categoria.nome = '". $nomeCategoria ."' where categoria.id_categoria = ". $IDCategoria;
            echo mysqli_query($conexao, $query) or die($query);
        }else if($tabela == "produto"){
            $IDProduto = $_REQUEST["IDProduto"];
            $IDCategoria = $_REQUEST["IDCategoria"];
            $nomeProduto = $_REQUEST["nomeProduto"];

            $query = "update produto set produto.id_categoria = ". $IDCategoria .", produto.nome = '". $nomeProduto ."' where produto.id_produto = ". $IDProduto;
            echo mysqli_query($conexao, $query);
        }
    }
?>
