<?php 

    if(session_status() == PHP_SESSION_ACTIVE){
        $nomeUsuario = $_SESSION['nome'];
    }
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
                <h1 class="font-1-xxl-1 peso-semi-bold"><?= isset($tituloPagina) == '' ? '-' : $tituloPagina ?></h1>
            </div>
        </div>

        <div class="container-usuario-logado">
            <div class="usuario-info">
                <div class="usuario-logado-texto">
                    <p><?= $nomeUsuario ?></p>
                    <span>Administrador</span>
                </div>
                <div class="usuario-logado-icodown">
                    <span class="material-symbols-rounded ico-icodown">keyboard_arrow_down</span>
                </div>
                <div class="usuario-logado-dropdown">
                    <ul class="dropwdown-logado" class="font-2-xs">
                        <li><a href="<?= BASE_URL ?>/app/administracao/perfil/index.php"><span class="material-symbols-rounded">account_circle</span>Meu perfil</a></li>
                        <li><a href="<?=BASE_URL?>/config/logoff.php"><span class="material-symbols-rounded">logout</span>Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="container-navbar-lateral">
    <div class="logo sidebar">
        <a href="<?= BASE_URL . "/index.php#"?>" target="_blank" rel="noopener noreferrer"><img class="img-logo" src="<?=BASE_URL?>/assets/img/logo/logo-white.svg" data-logoMax="<?=BASE_URL?>/assets/img/logo/logo-white.svg" data-logoMin="<?=BASE_URL?>/assets/img/logo/logo-pingo-minimizado.svg" alt="" ></a>
    </div>

    <ul class="navbar-itens">
        <li class="cor-8"><a href="<?=BASE_URL?>/app/administracao/projeto/" class="font-1-s"><span class="material-symbols-rounded">dashboard</span><p class="texto-nav">Projetos</p></a></li>
        <li class="cor-3"><a href="<?=BASE_URL?>/app/administracao/formacao/" class="font-1-s"><span class="material-symbols-rounded">school</span><p class="texto-nav">Formação</p></a></li>
        <li class="cor-8"><a href="<?=BASE_URL?>/app/administracao/tecnologia/" class="font-1-s"><span class="material-symbols-rounded">polyline</span><p class="texto-nav">Tecnologias</p></a></li>
        <li class="cor-3"><a href="<?=BASE_URL?>/app/administracao/autor/" class="font-1-s"><span class="material-symbols-rounded">group</span><p class="texto-nav">Autores</p></a></li>
        <li class="cor-3"><a href="<?=BASE_URL?>/app/administracao/areaFormacao/" class="font-1-s"><span class="material-symbols-rounded">assignment</span><p class="texto-nav">Áreas</p></a></li>
        <li class="cor-3"><a href="<?=BASE_URL?>/app/administracao/imagem/" class="font-1-s"><span class="material-symbols-rounded">image</span><p class="texto-nav">Imagens</p></a></li>
    </ul>
</nav>

