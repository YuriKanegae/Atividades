<?php
	session_start();
	
    if(!empty($_POST)) {
		
		include "conexao.php";
		
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT cpf, tipo FROM usuario WHERE email='$email' AND senha='$senha'";
        
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
		
        if(mysqli_num_rows($resultado) == 1) {
            
            $linha = mysqli_fetch_assoc($resultado);
			
            $_SESSION["cpf"] = $linha["cpf"];
            $_SESSION["tipo"] = $linha["tipo"];
			$_SESSION["email"] = $email;
			
            header("location: index.php");
        }
        else {
			
            header("location: erro.html");
        }
    }

?>