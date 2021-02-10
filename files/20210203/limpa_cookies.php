<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION["cpf"])){
		header("location: form_login.php");
	}
?>
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8"/>
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <link rel = "stylesheet" href = "css\bootstrap.min.css"/>
        <title>Tabela de Cookies</title>

		<script>
			var chaves = null;

			function geraTabela(){
				$.post("gerenciadorCookie.php", {'method': 'get', 'subject': 'cookie'}, function(retorno){
					chaves = Object.keys(retorno);

					var HTML = null;
					for(var i = 0; i < chaves.length; i++){
						HTML += '<tr>'
								+'<td scope = "col">'+ i +'</td>'
								+'<td scope = "col">'+ chaves[i] +'</td>'
								+'<td scope = "col">'+ retorno[chaves[i]] +'</td>'
								+'<td scope = "col">'
									+'<input type = "checkbox" name = "'+ i +'" id = "'+ i +'"/>'
									+'<label for = "'+ i +'">SIM</label>'
								+'</td>'
							+'</tr>';
					}
					$('#tbody').html(HTML);
				});
			}

			function marcarTodos(objeto){
				if(objeto.checked){
					for(var i = 0; i < chaves.length; i++){
						$('#' + i.toString()).attr('checked', true);
					}
				}else{
					for(var i = 0; i < chaves.length; i++){
						$('#' + i.toString()).attr('checked', false);
					}
				}
			}

			function limpaCookies(){
				var cookiesSelecionados = [];

				for(var i = 0; i < chaves.length; i++){
					if($('#' + i.toString()).prop('checked')){
						cookiesSelecionados.push(chaves[i]);
					}
				}

				$.post("gerenciadorCookie.php", {'method': 'delete', 'subject': cookiesSelecionados}, function(retorno){
					document.location.reload(true);
				});
			}
		</script>
    </head>
    <body onload = "geraTabela()">

		<header>
			<h2 class = "text-center"><a href = "index.php">Voltar para a Home</a></h2>
			<br/>
			<br/>
			<br/>
		</header>
        <main>
			<h1 class = "text-center" style = "padding-bottom: 30px;">Limpeza de Cookies</h1>

			<div class = "container">
				<table class = "table text-center">
					<!--Cabeçalho da tabela-->
					<thead class = "thead-dark">
						<tr>
							<th scope = "col">#</th>
							<th scope = "col">Nome do Cookie</th>
							<th scope = "col">Valor do Cookie</th>
							<th scope = "col">Deseja apagar?</th>
						</tr>
					</thead>

					<!--Corpo da tabela-->
					<tbody id = "tbody"></tbody>

					<!--Pé da tabela-->
					<tfoot>
						<tr>
							<th colspan = "3">
								Deseja apagar todos os cookies?
							</th>
							<th>
								<input type = "checkbox" name = "marcarTodos" id = "marcarTodos" onchange = "marcarTodos(this);">
								<label for = "marcarTodos">SIM</label>
							</th>
						</tr>
					</tfoot>
				</table>

				<div class = "text-center">
					<button class = "btn btn-danger" onclick = 'limpaCookies()'>Limpar Cookies</button>
				</div>
			</div>

        </main>

        <!--Bibliotecas necessárias-->
        <script src = "js\jquery-3.5.1.min.js"></script>
        <script src = "js\popper.min.js"></script>
        <script src = "js\bootstrap.min.js"></script>
    </body>
</html>
