<?php

	session_start();

	include "conteudo.php";

	if(isset($_SESSION["cpf"])){
		$titulo = "Entrada";
		$conteudos = array();
		$conteudos[0] = "<p>Olá, ".$_SESSION['email'].".</p>";
		$conteudos[1] = "<p>Seu tipo é ".$_SESSION['tipo'].".</p>";
		$conteudos[2] = "<p>Seja bem vindo ao sistema</p>";
		$conteudos[3] = "<p><a href='limpa_cookies.php'>Limpeza de Cookies</a></p>";
		$conteudos[4] = "<p><a href='logout.php'>Sair</a></p>";
		exibir($titulo, $conteudos);
	}
	else {
		//session_destroy();
		header("location: form_login.php");
	}
?>
