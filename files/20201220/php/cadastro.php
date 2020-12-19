<?php
    include("conexao.php");

    $nome = $_POST["usuarioCadastro"];
    $senha = $_POST["senhaCadastro"];

    if($_POST["tipoCadastro"] == "usuario"){
        $email = $_POST["emailCadastro"];

        //Checagem de e-mail
        $query = "select * from usuario where email = '". $email ."'";
        $resultados = mysqli_query($conexao, $query);

        $cont = 0;
        while($linha = mysqli_fetch_assoc($resultados)){
            $cont++;
        }

        //Cadastro
        if($cont == 0){
            //Cadastro em si
            $query = "insert into usuario (nome, email, senha) values('". $nome ."', '". $email ."', '". $senha ."')";
            mysqli_query($conexao, $query);

            //ID do usuario
            $query = "select usuario.id_usuario as ID, usuario.nome as nomeUsuario from usuario where email = '". $email ."'";
            $resultados = mysqli_query($conexao, $query);

            while($linha = mysqli_fetch_assoc($resultados)){
                session_start();
                $_SESSION["loginID"] = $linha["ID"];
                $_SESSION["nomeUsuario"] = $linha["nomeUsuario"];
            }
        }
    }else{
        $CNPJ = $_POST["CNPJ"];

        //Checagem de e-mail
        $query = "select * from usuario where cnpj = '". $CNPJ ."'";
        $resultados = mysqli_query($conexao, $query);

        $cont = 0;
        while($linha = mysqli_fetch_assoc($resultados)){
            $cont++;
        }

        //Cadastro
        if($cont == 0){
            //Cadastro em si
            $query = "insert into usuario (nome, cnpj, senha) values('". $nome ."', '". $CNPJ ."', '". $senha ."')";
            mysqli_query($conexao, $query);

            //ID do usuario
            $query = "select usuario.id_usuario as ID, usuario.nome as nomeUsuario from usuario where cnpj = '". $CNPJ ."'";
            $resultados = mysqli_query($conexao, $query);

            while($linha = mysqli_fetch_assoc($resultados)){
                session_start();
                $_SESSION["loginID"] = $linha["ID"];
                $_SESSION["nomeUsuario"] = $linha["nomeUsuario"];
            }
        }
    }
    header("Location: index.php")

?>
