<?php
    session_start();
    include "conexao.php";

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if($email != "" && $senha != ""){
        $query = "select usuario.nome as nomeUsuario, usuario.id_usuario as ID from usuario where usuario.email = '". $email ."' and usuario.senha = '". $senha ."';";
        echo $query;
        $resultados = mysqli_query($conexao, $query);

        while($linha = mysqli_fetch_assoc($resultados)){
            $_SESSION["loginID"] = $linha["ID"];
            $_SESSION["nomeUsuario"] = $linha["nomeUsuario"];
        }
    }
    header("Location: index.php");

?>
