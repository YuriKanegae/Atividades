/*
    Reponsável pela geração de formulário de login e cadastro
    Parâmetros:
        tipo : login, cadastro
            login: email e senha
            cadastro: cpf, nome, email, senha e confirmação de senha
*/

//Para controle de comunicação com o servidor
var acao = 'login';
function geraForm(tipo){
    if(tipo == 'login'){
        var HTML = "<div class = 'form-group'>"
            +"<h1 class = 'text-center'>LOGIN</h1>"
            +"</div>"
            +"<div clas = 'form-group'>"
            +"<scpan class = '' id = 'mensagemErro' style = 'color: red;font-size: 20px'></span>"
            +"</div>"
            +"<hr/>"
            +"<div class = 'form-group'>"
            +"<label for = 'email'>E-mail:</label>"
            +"<input class = 'form-control' type = 'email' name = 'email' id = 'email' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<label for = 'senha'>Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'senha' id = 'senha' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<button class = 'btn btn-danger' type = 'reset'>Limpar</button>"
            +"<button class = 'btn btn-primary float-right'>Enviar</button>"
            +"</div>"
            +"<hr/>"
            +"<div class = 'form-group text-center'>"
            +"Novo na plataforma? <a href= '#' onclick = \"geraForm('cadastro')\"> Registrar-se </a>"
            +"</div>";

        acao = 'login';
    }else if(tipo == 'cadastro'){
        var HTML = "<div class = 'form-group'>"
            +"<h1 class = 'text-center'>CADASTRO</h1>"
            +"</div>"
            +"<div clas = 'form-group'>"
            +"<scpan class = '' id = 'mensagemErro' style = 'color: red;font-size: 20px'></span>"
            +"</div>"
            +"<hr/>"
            +"<div class = 'form-group'>"
            +"<label for = 'cpf'>CPF:</label>"
            +"<input class = 'form-control' type = 'text' name = 'cpf' id = 'cpf' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<label for = 'nome'>Nome:</label>"
            +"<input class = 'form-control' type = 'text' name = 'nome' id = 'nome' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<label for = 'email'>E-mail:</label>"
            +"<input class = 'form-control' type = 'email' name = 'email' id = 'email' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<label for = 'senha'>Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'senha' id = 'senha' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<label for = 'confirmacao_senha'>Confirmação de Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'confirmacao_senha' id = 'confirmacao_senha' required>"
            +"</div>"
            +"<div class = 'form-group'>"
            +"<button class = 'btn btn-danger' type = 'reset'>Limpar</button>"
            +"<button class = 'btn btn-primary float-right'>Enviar</button>"
            +"</div>"
            +"<hr/>"
            +"<div class = 'form-group text-center'>"
            +"Já se cadastrou? <a href= '#' onclick = \"geraForm('login')\"> Registrar-se </a>"
            +"</div>";

        acao = 'cadastro';
    }

    $("#form").html(HTML);
}

/*
    Resonsável pelo login ou pelo cadastro
    PS: leva em conta o valor da váriavel acao para definir a comunicação
*/
function submitForm(){
    event.preventDefault();

    if(acao == 'login'){
        let dados = {
            'method': 'get',
            'resource': 'login',
            'email': $("input[name=email]").val(),
            'senha': $.md5($("input[name=senha]").val())
        };

        $.post('resources.php', dados, function(response){
            console.log(response);
            response = JSON.parse(response);

            if(response.code == 300){
                window.location.href = response.location;
            }else if(response.code == 400){
                $('#mensagemErro').html(response.message);
            }
        });
    }else if(acao == 'cadastro'){
        let dados = {
            'method': 'post',
            'resource': 'cadastro',
            'cpf': $("input[name=cpf]").val(),
            'nome': $("input[name=nome]").val(),
            'email': $("input[name=email]").val(),
            'senha': $.md5($("input[name=senha]").val())
        };

        if($("input[name=senha]").val() == $("input[name=confirmacao_senha]").val()){

            if(cpf($("input[name=cpf]").val())){
                $.post('resources.php', dados, function(response){
                    response = JSON.parse(response);

                    if(response.code == 300){
                        window.location.href = response.location;
                    }else if(response.code == 400){
                        $('#mensagemErro').html(response.message);
                    }
                });
            }else{
                $('#mensagemErro').html("CPF inválido");
            }

        }else{
            $('#mensagemErro').html("Senhas diferentes");
        }
    }
}
