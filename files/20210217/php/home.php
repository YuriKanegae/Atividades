<?php
    session_start();
    if(!isset($_SESSION["nome"])){
        header('Location: index.php');
    }
    include 'cabecalho.php';

    if(!isset($_SESSION['permissao'])){
        echo '
        <div class = \'container\'>
            <div class = \'row col-6 offset-3\' style = \'margin-top: 50px;\'>
                <table class = \'table text-center\'>
                    <thead class = \'thead-dark\'>
                        <tr>
                            <th>Dado</th>
                            <th>Valor</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th>CPF</th>
                            <td>'. $_SESSION["cpf"] .'</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>'.  $_SESSION["email"] .'</td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <td>'. $_SESSION["nome"] .'</td>
                        </tr>
                        <tr>
                            <th>Data Assinatura</th>
                            <td>'. $_SESSION["data_assinatura"] .'</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>';
    }else{
        echo'
            <script src = \'../js/home.js\'></script>

            <div id = \'conteudo\' style = \'margin-top: 50px;\'></div>
            <div class = \'text-center\'>
                <button class =\'btn btn-primary\' onclick = \'gerarRelatorio("'. $_SESSION['permissao'] .'")\'>Gerar relatório</button>
            </div>
        ';
    }

    include 'rodape.php';
?>
