<?php
  session_start();
    include "const_cookie.php";

    $cookie = COOKIE;
    $validadeCookie = time() + 3600 * 720;
    $caminhoCookie = "/";
    $dominioCookie = "localhost";
    $seguroCookie = false;
    $httpCookie = true;
    $valorCookie=0;

    if(!isset($_COOKIE[$cookie])){
      $valorCookie = base64_encode(1);
      $_SESSION['valorCookie']=1;
      echo '1';
    }else{
      $valorCookie=base64_decode($_COOKIE[$cookie])+1;
      $_SESSION['valorCookie']=$valorCookie;
      $valorCookie=base64_encode($valorCookie);
    }

    setcookie($cookie, $valorCookie, $validadeCookie, $caminhoCookie, $dominioCookie, $seguroCookie, $httpCookie);
    
    header('Location: noticia.php');
?>
