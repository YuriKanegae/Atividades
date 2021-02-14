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
        var HTML = "<label for = 'email'>E-mail:</label>"
            +"<input class = 'form-control' type = 'email' name = 'email' id = 'email' required>"
            +"<label for = 'senha'>Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'senha' id = 'senha' required>"
            +"<button class = 'btn btn-primary'>Enviar</button>"
            +"<button class = 'btn btn-danger' type = 'reset'>Limpar</button>"
            +"Novo na plataforma? <a href= '#' onclick = \"geraForm('cadastro')\"> Registrar-se </a>";

        acao = 'login';
    }else if(tipo == 'cadastro'){
        var HTML = "<label for = 'cpf'>CPF:</label>"
            +"<input class = 'form-control' type = 'text' name = 'cpf' id = 'cpf' required>"
            +"<label for = 'nome'>Nome:</label>"
            +"<input class = 'form-control' type = 'text' name = 'nome' id = 'nome' required>"
            +"<label for = 'email'>E-mail:</label>"
            +"<input class = 'form-control' type = 'email' name = 'email' id = 'email' required>"
            +"<label for = 'senha'>Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'senha' id = 'senha' required>"
            +"<label for = 'confirmacao_senha'>Confirmação de Senha:</label>"
            +"<input class = 'form-control' type = 'password' name = 'confirmacao_senha' id = 'confirmacao_senha' required>"
            +"<button class = 'btn btn-primary'>Enviar</button>"
            +"<button class = 'btn btn-danger' type = 'reset'>Limpar</button>"
            +"Já se cadastrou? <a href= '#' onclick = \"geraForm('login')\"> Registrar-se </a>";

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
                console.log(response.message);
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

        $.post('resources.php', dados, function(response){
            response = JSON.parse(response);

            if(response.code == 300){
                window.location.href = response.location;
            }else if(response.code == 400){
                console.log(response.message);
            }
        });
    }

}
