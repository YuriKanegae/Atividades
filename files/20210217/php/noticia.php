<?php
    session_start();

    include 'const_cookie.php';
    include 'cabecalho.php';

    $nomeCookie = COOKIE;
    $cookie = base64_decode($_COOKIE[$nomeCookie]);
    if(!isset($_SESSION['valorCookie']) && !isset($_SESSION["nome"])){
      header('Location: gravar_cookie.php');
  }else if($cookie>5){
      echo '
    <button type="button" id="botao" class="btn btn-primary" data-toggle="modal" data-target="#modal" style="display:block;"></button>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title" id="exampleModalLongTitle"><b>Alerta!</b></h1>
          </div>
          <div class="modal-body">
            Limite de acessos atingido!<br>
            Deseja tornar-se um assinante? <a class="btn btn-link" href="#">Cadastrar</a><br>
            Já é assinante? Clique aqui para entrar <a class="btn btn-link" href="login.php">Login</a>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
          $("#botao").hide();
          $("#modal").modal("show");
      });

      $(\'#modal\').modal({
        backdrop: \'static\', keyboard: false
      });
    </script>
    ';
    }else{
        echo'

      <h1 class="text-center">Lorem ipsum cursus venenatis</h1>
      <div class="container">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Lorem ipsum cursus venenatis</h5>
            <p class="card-text">Lorem ipsum cursus venenatis aliquet tortor orci torquent tempor mauris platea pharetra tempus, fermentum porttitor cursus quisque vestibulum sit aenean quam interdum cubilia euismod diam, auctor sollicitudin duis morbi condimentum maecenas phasellus pulvinar ornare semper inceptos. senectus diam nisl pellentesque aliquet tellus adipiscing dictumst mauris commodo, interdum nostra lorem nullam quam dapibus facilisis faucibus, diam habitant nisl mauris id justo class ad. primis aliquam sed aliquam fermentum pretium senectus vestibulum molestie etiam mi, bibendum neque torquent dui quisque sociosqu amet cursus. lacinia conubia tincidunt torquent potenti sit proin, in dapibus pellentesque enim dapibus suspendisse sed, ipsum a lorem cras porta. </p>
          </div>
        </div>
      </div>
      ';
    }

    include 'rodape.php';
?>
