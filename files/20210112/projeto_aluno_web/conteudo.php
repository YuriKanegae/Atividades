<?php
	function exibir($titulo, $conteudos) {
		$html = "<!DOCTYPE html>\n";
		$html .= "<html lang='pt-BR'>\n";
		$html .= "\t<head>\n";
		$html .= "\t\t<meta charset='UTF-8' />\n";
		$html .= "\t\t<title>".$titulo."</title>\n";
		$html .= "\t</head>\n";
		$html .= "\t<body>\n";
		foreach($conteudos as $conteudo) {
			$html .= "\t\t".$conteudo."\n";
		}
		$html .= "\t</body>\n";
		$html .= "</html>";
		echo $html;
	}
?>