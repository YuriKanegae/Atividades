<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = 'UTF-8'/>
        <meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'/>
        <meta name = 'viewport' content = 'width=device-width, initial-scale=1'/>

        <link rel = 'stylesheet' href = '../css/bootstrap.min.css'/>
        <link rel = 'stylesheet' href = '../css/estilo.css'/>

        <script src = '../js/jquery-3.5.1.min.js'></script>
        <script src = '../js/popper.min.js'></script>
        <script src = '../js/bootstrap.min.js'></script>
        <script src = '../js/md5.js'></script>
    		<noscript>Seu navegador não suporta JavaScript</noscript>

        <title>Portal NEWS</title>
    </head>
    <body>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <!--Primeiro item da ordem - necessário para o nav ficar formatado-->
        <div class = "navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2"></div>

        <!--Segundo item da ordem - Elementos que estão no meio-->
        <div class="mx-auto order-0">

          <!--Elementos centrais-->
          <ul class = "navbar-nav ml-auto">
            <li class = "nav-item text-white">
              Portal NEWS
            </li>
          </ul>

          <!--Botão para expandir os itens-->
          <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = ".dual-collapse2">
            <span class = "navbar-toggler-icon"></span>
          </button>
        </div>
        
        <!--Terceiro item da ordem - Elementos que estão a direita-->
        <div class = "navbar-collapse collapse w-100 order-3 dual-collapse2">
          <ul class = "navbar-nav ml-auto">
            <li class = "nav-item">
              <?php
                if(!isset($_SESSION['nome'])){
                  echo '
                    <a class = "mx-auto" href = "login.php">Login</a>
                  ';
                }else{
                  echo '
                    <a class = "mx-auto" href = "logout.php">Logout</a>
                  ';
                }
              ?>
            </li>
          </ul>
        </div>
      </nav>
