<?php
    session_start();
    include "conexao.php";

    $identificacao = $_POST["identificacao"];
    $senha = $_POST["senha"];

    if($identificacao != "" && $senha != ""){
        $query = "select usuario.nome as nomeUsuario, usuario.id_usuario as ID from usuario where usuario.email = '". $identificacao ."' or usuario.cnpj = '". $identificacao ."' and usuario.senha = '". $senha ."';";
        $resultados = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_assoc($resultados)){
            $_SESSION["loginID"] = $linha["ID"];
            $_SESSION["nomeUsuario"] = $linha["nomeUsuario"];
        }
    }
    header("Location: index.php");
?>
