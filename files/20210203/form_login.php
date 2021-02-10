<?php
	include "const_cookie.php";
?>

<!DOCTYPE html>

<html lang="pt-BR">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="UTF-8" />
		<title>Form de login</title>
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />
	</head>
	
	<body>
		<h1>Form de login modal</h1>

		<button class="modalbtn">Login</button>

		<div class="modal">
  
			<form id="f1" class="modal-content animate" action="autenticacao.php" method="post">
				
				<div class="imgcontainer">
					<button type="button" class="close" title="Fechar">&times;</button>
					<img src="imagens/img_avatar2.png" alt="Avatar" class="avatar" />
				</div>
				
				<div id="erro"></div>
				
				<div class="container">
					<label for="email"><b>Endereço de e-mail</b></label>
					<input type="text" placeholder="Digite seu e-mail" name="email" id="email" required 
					value="<?php echo isset($_COOKIE[NOME_COOKIE])?base64_decode($_COOKIE[NOME_COOKIE]):"";?>">
							
					<label for="senha"><b>Senha</b></label>
					<input type="password" placeholder="Digite sua senha" name="senha" id="senha" required>
				  
					<input type="submit" name="submeter" value="Login" class="submitbtn" />

					<input type="checkbox" name="lembrete" value="sim" id="lembrete" />
					<label for="lembrete">Lembrar meu e-mail</label>
				</div>
				
				<div class="container" style="background-color:#f1f1f1">
					<button type="button" class="cancelbtn">Cancelar</button>
				</div>
				
			</form>
			
		</div>

		<script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/MD5.js"></script>
		<script src="js/login.js"></script>
		<noscript>Seu navegador não suporta JavaScript</noscript>
	</body>
	
</html>