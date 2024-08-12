<?php 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Portfolio-Modesto/config/config.php';
?>

<body class="body-conteudo">
<header class="header">
    <div class="principal-container-header">
        <div class="container-header-esquerda">
            <div class="container-botao-menu">
                <div class="botao-menu">
                    <span class="material-symbols-rounded"> keyboard_arrow_left</span>
                </div>
            </div>
            
            <div class="container-titulo-cabecalho">
                <h1 class="font-1-xxl-1">--</h1>
            </div>
        </div>

        <div class="container-usuario-logado">
            <div class="usuario-info">
                <div class="usuario-logado-texto">
                    <p></p>
                    <span></span>
                </div>
                <div class="usuario-logado-icodown">
                    <span class="material-symbols-rounded ico-icodown">keyboard_arrow_down</span>
                </div>
                <div class="usuario-logado-dropdown">
                    <ul class="dropwdown-logado" class="font-2-xs">
                        <li><a href=""><span class="material-symbols-rounded">logout</span>Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="container-navbar-lateral">
    <div class="logo sidebar">
        <img class="img-logo" src="<?php echo BASE_URL ?>/assets/img/logo/logo-white.svg"  data-logoMax="<?php echo BASE_URL ?>/assets/img/logo/logo-white.svg" data-logoMin="<?php echo BASE_URL ?>/assets/img/logo/logo-white-min.svg" alt="">
    </div>

    <ul class="navbar-itens">
        <li class="cor-8"><a href="#" class="font-1-s" aria-disabled="true"><span class="material-symbols-rounded">dashboard</span><p class="texto-nav">Projetos</p></a></li>
        <li class="cor-3"><a href="#" class="font-1-s"><span class="material-symbols-rounded">school</span><p class="texto-nav">Formação</p></a></li>
        <li class="cor-8"><a href="#" class="font-1-s" aria-disabled="true"><span class="material-symbols-rounded">polyline</span><p class="texto-nav">Tecnologias</p></a></li>
        <li class="cor-3"><a href="#" class="font-1-s"><span class="material-symbols-rounded">group</span><p class="texto-nav">Autores</p></a></li>
        <li class="cor-3"><a href="#" class="font-1-s"><span class="material-symbols-rounded">assignment</span><p class="texto-nav">Áreas</p></a></li>
        <li class="cor-3"><a href="#" class="font-1-s"><span class="material-symbols-rounded">image</span><p class="texto-nav">Imagens</p></a></li>
    </ul>
</nav>

