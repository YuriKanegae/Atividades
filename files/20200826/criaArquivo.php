<?php
    $nomeArquivo = "arquivos/" . $_GET["nomeArquivo"] . ".html";

    $fontWeight = $_GET["fontWeight"];
    $fontStyle = $_GET["fontStyle"];
    $textDecoration = $_GET["textDecoration"];

    $HTML = '
    <html lang = "pt-br">
        <head>
            <meta charset = "UTF-8"/>

            <title>' .$_GET["nomeArquivo"]. '</title>
        </head>
        <body>
            <div style = "font-weight: ' .$fontWeight. ';font-style: ' .$fontStyle. ';text-decoration: ' .$textDecoration. '; ">' .$_GET["HTML"]. '</div>
        </body>
    </html>';

    $arquivo = fopen($nomeArquivo,'w+');
    fwrite($arquivo, $HTML);
    fclose($arquivo);
?>
