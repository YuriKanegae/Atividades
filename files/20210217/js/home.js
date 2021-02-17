function gerarRelatorio(permissao){
    let dados = {
        'method': 'get',
        'resource': 'listaUsuarios',
        'permissao': permissao
    };

    $.post('resources.php', dados, function(response){
        response = JSON.parse(response);

        if(response.code == 200){
            $("#conteudo").html(response.html);
        }else if(response.code == 400){
            $('#mensagemErro').html(response.message);
        }
    });
}
