<nav class = "navbar navbar-expand-lg navbar-light bg-light rounded">
    <div class = "container">

        <!--Título-->
        <a class = "navbar-brand" href="../php/index.php">Home</a>
        <!--Botão que aparece quando colapsado-->
        <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#navbar" aria-controls = "navbarsExample09" aria-expanded = "false" aria-label = "Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--Links-->
        <div class = "collapse navbar-collapse" id = "navbar">
            <ul class = "navbar-nav mr-auto">
                <!--Dropdown dos formulários-->
                <li class = "nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id = "dropdownForm" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">Cadastrar</a>
                    <div class = "dropdown-menu" aria-labelledby = "dropdownForm">
                        <a class = "dropdown-item" href = "../php/formGenero.php">GÊNERO</a>
                        <a class = "dropdown-item" href = "../php/formBanda.php">BANDA</a>
                        <a class = "dropdown-item" href = "../php/formMusica.php">MÚSICA</a>
                        <a class = "dropdown-item" href = "../php/formPlaylist.php">PLAYLIST</a><br/>
                    </div>
                </li>

                <!--Dropdown das listas-->
                <li class = "nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id = "dropdownLista" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">Listar</a>
                    <div class = "dropdown-menu" aria-labelledby = "dropdownLista">
                        <a class = "dropdown-item" href = "../php/listaGenero.php">GÊNERO</a>
                        <a class = "dropdown-item" href = "../php/listaBanda.php">BANDA</a>
                        <a class = "dropdown-item" href = "../php/listaMusica.php">MÚSICA</a>
                        <a class = "dropdown-item" href = "../php/listaPlaylist.php">PLAYLIST</a><br/>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav><br/><br/>
