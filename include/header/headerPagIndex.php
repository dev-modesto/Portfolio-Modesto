<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfólio | devModesto </title>
        <meta name="description" content="Gabriel Modesto é um Desenvolvedor Web fascinado por criar interfaces web funcionais e otimizadas. Conheça meu portfólio e veja como posso transformar suas ideias em experiências incríveis na web.">
        
        <link rel="shortcut icon" href="<?= BASE_URL . '/assets/img/logo/logo-pingo-minimizado.svg'?>" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/fonts.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/cor.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/componentes.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/filtros.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/global.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/navbar.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/animacoes.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/home/home.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/sobre/sobre.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/habilidades/habilidades.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/projetos/projetos-destaque.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/formacao/formacao.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/footer/footer.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    </head>
    <body>
        <header class="header-menu-principal">
            <div class="navbar fixed-top" id="navbar">
                <div class="logo">
                    <a href="#"><img src="./assets/img/logo/logo-black.svg" id="logo1" alt="logo"></a>
                    <a href="#"><img src="assets/img/logo/logo-white.svg" id="logo2" alt="logo"></a>
                </div>
                <nav class="menu">
                    <ul class="menu-itens">
                        <li><a href="#">Início</a></li>
                        <li><a href="#sobre">Sobre</a></li>
                        <li><a href="#habilidades">Habilidades</a></li>
                        <li>
                            <a id="activedrop"> Projetos<span class="material-symbols-rounded" id="iconProjetos">keyboard_arrow_down</span>
                            </a>
                            <ul class="menu-itens-dropdown dropdown-menu" id="dropdown-menu">
                                <li>
                                    <a href="#projetosDestaque">
                                        <span class="material-symbols-rounded">star</span>
                                        <span class="menu-itens-dropdown-text">Em destaque</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="projetos.php">
                                        <span class="material-symbols-rounded">folder_copy</span>
                                        <span class="menu-itens-dropdown-text">Visualizar todos</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#formacao">Formação</a></li>
                        <li><a href="contato.php">Contato</a></li>
                    </ul>
                </nav>
                <nav class="menu-mobile" id="drop-mobile">
                    <span class="material-symbols-rounded" id="icon-mobile">menu</span>
                    <ul class="bg-line-mobile1">
                        <ul class="menu-mobile-itens" id="drop-menu-mobile">
                            <li><a href="#">Início</a></li>
                            <li><a href="#sobre">Sobre</a></li>
                            <li><a href="#habilidades">Habilidades</a></li>
                            <li><a href="#projetosDestaque">Projetos destaque</a></li>
                            <li><a href="projetos.php">Todos os projetos</a></li>
                            <li><a href="#formacao">Formação</a></li>
                            <li><a href="contato.php">Contato</a></li>
                        </ul>
                    </ul>
                </nav>
            </div>
        </header>