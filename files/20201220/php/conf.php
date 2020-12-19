<?php
    session_start();
    include "conexao.php";
    $alt = "logo";
    $desenvolvedor = "Yuri Kanegae";

    if(empty($_SESSION["loginID"])){
        $menuCadastrar = 0;
        $menuPrecos = 0;
    }else{
        $query = "select usuario.email as Email, usuario.cnpj as CNPJ from usuario where usuario.id_usuario = ". $_SESSION["loginID"];
        $resultados = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_assoc($resultados)){
            if(is_null($linha["CNPJ"])){
                $menuCadastrar = 0;

                $menuPrecos = array(
                    "nicho" => "Nichos",
                    "categoria" => "Categorias",
                    "produto" => "Produtos"
                );

                $_SESSION["empresa"] = false;
            }else{
                $menuCadastrar = array(
                    "nicho" => "Nichos",
                    "categoria" => "Categorias",
                    "produto" => "Produtos",
                    "preco" => "Atualizar Preços"
                );

                $menuPrecos = array(
                    "nicho" => "Nichos",
                    "categoria" => "Categorias",
                    "produto" => "Produtos"
                );
                $_SESSION["empresa"] = true;
            }
        }
    }

    include "cabecalho.php";
    include "rodape.php";

?>
