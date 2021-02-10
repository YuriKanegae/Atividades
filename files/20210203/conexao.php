<?php

	$host = "localhost";
	$bd = "revisao_aula";
	$usuario = "root";
	$senha = "usbw";

	//$conexao = mysqli_connect($host,$usuario,$senha,$bd) or die("Erro ao abrir a conexão com o banco de dados.");

	$conexao = mysqli_connect($host,$usuario,$senha,$bd);

	/*
	if (mysqli_connect_errno()) {
		echo "Falha em se conectar com o banco de dados<br />" . mysqli_connect_error();
		exit();
	}*/

	if(!$conexao) {
		echo mysqli_connect_errno();
		exit();
	}

	mysqli_set_charset($conexao, "utf8");
?>
