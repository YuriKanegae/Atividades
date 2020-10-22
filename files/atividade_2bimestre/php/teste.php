<form action = "teste.php" method = "POST">
    <input type = "checkbox" name = "1" /> A<br/>
    <input type = "checkbox" name = "2" /> A<br/>

    <input type = "submit" value = "Enviar">
</form>
<?php
    if(!empty($_POST)){
        echo $_POST["1"]. "<br/>";
        echo $_POST["2"]. "<br/>";
    }
?>
