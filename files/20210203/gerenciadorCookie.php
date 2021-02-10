<?php
    if(!empty($_POST)){
        $method = $_POST["method"];
        $subject = $_POST["subject"];

        if($method == "get"){
            if($subject == "cookie"){
                $variaveis = array();

                foreach ($_COOKIE as $key=>$val){
                    $variaveis[$key] = $val;
                }

                header('Content-Type: application/json');
                echo json_encode($variaveis);
            }
        }else if($method == "delete"){
            for($i = 0; $i < sizeof($subject); $i++){
                setcookie($subject[$i], "", time()-1, "/", "localhost", false, true);
                echo "FOI";
            }
        }
    }
?>
