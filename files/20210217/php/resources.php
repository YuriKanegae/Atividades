<?php
    session_start();

    if(!empty($_POST)){
        include 'conexao.php';

        //Checagem de dados vazios
        $noEmptyValue = TRUE;
        foreach($_POST as $value){
            if($value == NULL){
                $noEmptyValue = FALSE;
            }
        }

        if($noEmptyValue){
            $method = $_POST["method"];
            $resource = $_POST["resource"];

            if($method == 'get'){
                if($resource == 'login'){
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $sql = "select nome, permissao from administrador where email = ? and senha = ?";
                    if($stmt = mysqli_prepare($conexao, $sql)){
                        mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
                        mysqli_stmt_execute($stmt);

                        $resultado = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($resultado) == 1){
                            $linha = mysqli_fetch_assoc($resultado);

                            $_SESSION["nome"] = $linha["nome"];
                            $_SESSION["permissao"] = $linha["permissao"];

                            echo '{"code": 300, "location": "home.php"}';
                        }else{
                            $sql = "select nome from usuario where email = ? and senha = ?";
                            if($stmt = mysqli_prepare($conexao, $sql)){
                                mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
                                mysqli_stmt_execute($stmt);

                                $resultado = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($resultado) == 1){
                                    $linha = mysqli_fetch_assoc($resultado);

                                    $_SESSION["nome"] = $linha["nome"];

                                    echo '{"code": 300, "location": "home.php"}';
                                }else{
                                    echo '{"code":400, "message": "Credenciais não encontradas"}';
                                }
                            }else{
                                echo '{"code":400, "message": "Falha ao se comunicar com o BD"}';
                            }
                        }
                    }else{
                        echo '{"code":400, "message": "Falha ao se comunicar com o BD"}';
                    }



                    mysqli_close($conexao);
                }
            }else if($method == 'post'){
                if($resource == 'cadastro'){
                    $cpf = $_POST['cpf'];
                    $cpf = str_replace('.', '', $cpf);
                    $cpf = str_replace('-', '', $cpf);

                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $sql = "insert into usuario(cpf, nome, email, senha, data_assinatura) values (?, ?, ?, ?, ?)";

                    if($stmt = mysqli_prepare($conexao, $sql)){
                        $data = date("Ymd");
                        mysqli_stmt_bind_param($stmt, "sssss", $cpf, $nome, $email, $senha, $data);
                        mysqli_stmt_execute($stmt);

                        echo '{"code":300, "location":"login.php"}';
                    }else{
                        echo '{"code":400, "message":"Falha ao se comunicar com o BD"}';
                    }
                    mysqli_close($conexao);
                }
            }
        }else{
            echo '{"code": 400, "message": "Requisição com parâmetros vazios"}';
        }
    }else{
        echo '{"code": 400, "message": "Requisição sem POST"}';
    }
?>
