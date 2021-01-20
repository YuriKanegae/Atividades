<?php
    session_start();

    if(!empty($_POST)){

        include "conexao.php";

        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $query = "select cpf, id_perfil from usuario where email=? and senha=?";

        if($stmt = mysqli_prepare($conexao, $query)){

            mysqli_stmt_bind_param($stmt, 'ss', $email, $senha);

            mysqli_stmt_execute($stmt);
            $resultados = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($resultados) == 1){

                $linha = mysqli_fetch_assoc($resultados);


                $_SESSION["cpf"] = $linha["cpf"];
                $_SESSION["email"] = $email;

                $_SESSION["nivel"] = $linha["id_perfil"];

                header("location: index.php");
            }else{

                header("location: login.php");
            }

            mysqli_stmt_close($stmt);
        }else{

            echo "Houve um erro: ". mysqli_error($conexao);
        }

        mysqli_close($conexao);
    }
?>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8"/>

        <title>Página de login</title>

        <script src = "../js/jquery.js"></script>
        <script src = "../js/md5.js"></script>

        <script>
            $(document).ready(function(){
                $("#form").submit(function(){
                    var senha = $("input[name='senha']").val();
                    senha = $.md5(senha);

                    $("input[name='senha']").val(senha);
                });
            });
        </script>
    </head>
    <body>
        <main>
            <form id = "form" action = "login.php" method = "POST">
                <label for="email"><b>Endereço de e-mail</b></label>
				<input type="text" placeholder="Digite seu e-mail" name="email" id="email" required>

				<label for="senha"><b>Senha</b></label>
				<input type="password" placeholder="Digite sua senha" name="senha" id="senha" required>

				<input type = "submit" name = "submeter" value = "Login"/>
            </form>
        </main>


    </body>
</html>
