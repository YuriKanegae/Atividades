<?php
    session_start();

    if(!empty($_POST)){
        include 'conexao.php';

        //Checagem de dados vazios
        $noEmptyValue = TRUE;
        foreach($_POST as $value){
            if($value == NULL){
                $noEmptyValue = FALSE;
            }
        }

        if($noEmptyValue){
            $method = $_POST["method"];
            $resource = $_POST["resource"];

            if($method == 'get'){
                if($resource == 'login'){
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $sql = "select nome, permissao from administrador where email = ? and senha = ?";
                    if($stmt = mysqli_prepare($conexao, $sql)){
                        mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
                        mysqli_stmt_execute($stmt);

                        $resultado = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($resultado) == 1){
                            $linha = mysqli_fetch_assoc($resultado);

                            $_SESSION["nome"] = $linha["nome"];
                            $_SESSION["permissao"] = $linha["permissao"];

                            setcookie('acesso', 0, $time()-1, "/", "localhost", false, true);
                            echo '{"code": 300, "location": "home.php"}';
                        }else{
                            $sql = "select cpf, email, nome, data_assinatura from usuario where email = ? and senha = ?";
                            if($stmt = mysqli_prepare($conexao, $sql)){
                                mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
                                mysqli_stmt_execute($stmt);

                                $resultado = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($resultado) == 1){
                                    $linha = mysqli_fetch_assoc($resultado);

                                    $_SESSION["cpf"] = $linha["cpf"];
                                    $_SESSION["email"] = $linha["email"];
                                    $_SESSION["nome"] = $linha["nome"];
                                    $_SESSION["data_assinatura"] = $linha["data_assinatura"];

                                    setcookie('acesso', 0, time()-1, "/", "localhost", false, true);
                                    echo '{"code": 300, "location": "home.php"}';
                                }else{
                                    echo '{"code":400, "message": "Credenciais não encontradas"}';
                                }
                            }else{
                                echo '{"code":400, "message": "Falha ao se comunicar com o BD"}';
                            }
                        }
                    }else{
                        echo '{"code":400, "message": "Falha ao se comunicar com o BD"}';
                    }



                    mysqli_close($conexao);
                }else if($resource == 'listaUsuarios'){
                    $permissao = $_POST["permissao"];
                    $HTML = "a";


                    if($permissao == 'baixa'){
                        $HTML = '
                        <div class = "container col-8 offset-2">
                            <table class = "table text-center">
                                <thead class = "thead-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                    </tr>
                                </thead>
                                <thead>
                        ';
                        $sql = "select nome as Nome, email as Email from usuario";

                        $resultado = mysqli_query($conexao, $sql);
                        while($linha = $resultado->fetch_assoc()){
                            $HTML .= '
                                    <tr>
                                        <td>'. $linha['Nome'] .'</td>
                                        <td>'. $linha['Email'] .' </td>
                                    </tr>
                            ';
                        }

                        $HTML .='
                                </thead>
                            </table>
                        </div>
                        ';
                    }else if($permissao == 'alta'){
                        $HTML2 = ' ';
                        $HTML = '
                        <div class = "container col-8 offset-2">
                            <table class = "table text-center">
                                <thead class = "thead-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ';
                        $sql = "select cpf as CPF, nome as Nome, email as Email, data_assinatura as Data_Assinatura from usuario";

                        $resultado = mysqli_query($conexao, $sql);
                        while($linha = $resultado->fetch_assoc()){
                            $HTML .= '
                                    <tr>
                                        <td>'. $linha['Nome'] .'</td>
                                        <td>'. $linha['Email'] .' </td>
                                        <td>
                                            <button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#Modal_'. $linha['CPF'].'">Detalhar</button>
                                        </td>
                                    </tr>
                            ';

                            $HTML2 .= '
                            <div class = "modal fade" id = "Modal_'. $linha['CPF'].'" tabindex = "-1" role = "dialog" aria-labelledby = "label" aria-hidden="true">
                                <div class = "modal-dialog" role = "document">
                                    <div class = "modal-content">
                                        <div class = "modal-header">
                                            <h5 class = "modal-title" id = "'. $linha['CPF'].'Label">'. $linha['Nome'].'</h5>
                                            <button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
                                                <span aria-hidden = "true">&times;</span>
                                            </button>
                                        </div>
                                        <div class = "modal-body">
                                            <table class = "table text-center">
                                                <thead class = "thead-dark">
                                                    <tr>
                                                        <th>Dado</th>
                                                        <th>Valor</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <th>CPF</th>
                                                        <td>'. $linha['CPF'] .'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-mail</th>
                                                        <td>'.  $linha['Email'] .'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <td>'. $linha['Nome'] .'</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Data Assinatura</th>
                                                        <td>'. $linha['Data_Assinatura'] .'</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }

                        $HTML .='
                                </tbody>
                            </table>
                        </div>
                        '. $HTML2;

                    }



                    $objeto = new \stdClass();
                    $objeto->code = 200;
                    $objeto->html = $HTML;

                    echo json_encode($objeto);
                }
            }else if($method == 'post'){
                if($resource == 'cadastro'){
                    $cpf = $_POST['cpf'];
                    $cpf = str_replace('.', '', $cpf);
                    $cpf = str_replace('-', '', $cpf);

                    $sql = 'select * from usuario where cpf = ?';
                    if($stmt = mysqli_prepare($conexao, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $cpf);
                        mysqli_stmt_execute($stmt);

                        $resultado = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($resultado) == 1){
                            echo '{"code":400, "message":"CPF já cadastrado"}';
                        }else{
                            $email = $_POST['email'];

                            $sql = 'select * from usuario where email = ?';
                            if($stmt = mysqli_prepare($conexao, $sql)){
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);

                                $resultado = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($resultado) == 1){
                                    echo '{"code":400, "message":"E-mail já cadastrado"}';
                                }else{
                                    $nome = $_POST['nome'];
                                    $senha = $_POST['senha'];

                                    $sql = "insert into usuario(cpf, nome, email, senha, data_assinatura) values (?, ?, ?, ?, ?)";

                                    if($stmt = mysqli_prepare($conexao, $sql)){
                                        $data = date("Ymd");
                                        mysqli_stmt_bind_param($stmt, "sssss", $cpf, $nome, $email, $senha, $data);
                                        mysqli_stmt_execute($stmt);

                                        echo '{"code":300, "location":"login.php"}';
                                    }else{
                                        echo '{"code":400, "message":"Falha ao se comunicar com o BD"}';
                                    }
                                }
                            }else{
                                echo '{"code":400, "message":"Falha ao se comunicar com o BD"}';
                            }
                        }
                    }else{
                        echo '{"code":400, "message":"Falha ao se comunicar com o BD"}';
                    }

                    mysqli_close($conexao);
                }
            }
        }else{
            echo '{"code": 400, "message": "Requisição com parâmetros vazios"}';
        }
    }else{
        echo '{"code": 400, "message": "Requisição sem POST"}';
    }
?>
