<?php
    include 'config/base.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfólio | Contato</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/fonts.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/cor.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/componentes.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/global.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/navbar.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/global/animacoes.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/home/home.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/sobre/sobre.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/formacao/formacao.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/footer/footer.css">
        <link rel="stylesheet" href="<?=BASE_URL?>/css/contato/contato.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    </head>
    <body class="body-contato">
        <header>
            <div class="navbar fixed-top" id="navbar">
                <div class="logo">
                    <img src="./assets/img/logo/logo-black.svg" id="logo1" alt="logo">
                    <img src="assets/img/logo/logo-white.svg" id="logo2" alt="logo">
                </div>
                <nav class="menu">
                    <ul class="menu-itens">
                        <li><a href="index.php#">Início</a></li>
                        <li><a href="index.php#sobre">Sobre</a></li>
                        <li><a href="index.php#habilidades">Habilidades</a></li>
                        <li>
                            <a id="activedrop">Projetos<span class="material-symbols-rounded" id="iconProjetos">keyboard_arrow_down</span></a>
                            <ul class="menu-itens-dropdown" id="dropdown-menu">
                                <li>
                                    <a href="index.php#projetosDestaque"><span class="material-symbols-rounded">star</span><span class="menu-itens-dropdown-text">Em destaque</span></a>
                                </li>
                                <li>
                                    <a href="projetos.php"><span class="material-symbols-rounded">folder_copy</span><span class="menu-itens-dropdown-text">Visualizar todos</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="index.php#formacao">Formação</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </nav>
                <nav class="menu-mobile" id="drop-mobile">
                    <span class="material-symbols-rounded" id="icon-mobile">menu</span>
                    <ul class="bg-line-mobile1">
                        <ul class="menu-mobile-itens" id="drop-menu-mobile">
                            <li><a href="index.php#">Início</a></li>
                            <li><a href="index.php#sobre">Sobre</a></li>
                            <li><a href="index.php#habilidades">Habilidades</a></li>
                            <li><a href="index.php#projetosDestaque">Projetos destaque</a></li>
                            <li><a href="projetos.php">Todos os projetos</a></li>
                            <li><a href="index.php#formacao">Formação</a></li>
                            <li><a href="#">Contato</a></li>
                        </ul>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section class="contato js-scroll" id="contato">
                <h1 class="font-1-h2-b cor-c3">Contato</h1>
                <p class="font-2-lg-r cor-c3">Gostou do meu trabalho ou tem uma proposta? <br> Envie-me uma mensagem.</p>
                
                <form class="container-form-contato">
                    <div class="item-nome">
                        <label for="nome" class="font-1-s-2">Nome</label>
                        <input type="text" id="nome" placeholder="Nome e Sobrenome" required>
                    </div>

                    <div class="item-email">
                        <label for="email" class="font-1-s-2">E-mail</label>
                        <input type="email" id="email" placeholder="Seu_email@mail.com" required>
                    </div>

                    <div class="item-telefone">
                        <label for="telefone" class="font-1-s-2">Telefone</label>
                        <input type="text" id="telefone" placeholder="(99) 99999-9999" required>
                    </div>

                    <div class="item-titulo-mensagem col-valor">
                        <label for="titulo-mensagem" class="font-1-s-2">Título da mensagem</label>
                        <input type="text" id="titulo-mensagem" placeholder="Título da sua mensagem" required>
                    </div>

                    <div class="item-mensagem col-valor">
                        <label for="mensagem" class="font-1-s-2">Mensagem</label>
                        <textarea id="mensagem" placeholder="Como posso te ajudar?" required></textarea>
                    </div>
                    
                    <div class="container-footer-contato col-valor">
                        <button class="btn-acao-contato font-1-s-2 peso-semi-bold" type="">Enviar</button>
                    </div>

                    <span class="forma-contato"></span>
                </form>
            </section>
            <footer class="footer">
                <div class="footer-container">
                    <div class="container-info-footer">
                        <div>
                            <h1 class="font-1-h2-b cor-c1 titulo-formacao-academica">Siga-me nas redes</h1>
                            <p class="font-2-lg-r peso-leve cor-c1 ">Fique à vontade para contactar-me. Se gostou do meu trabalho, me envie um feedback. Ficarei feliz em ouvir.</p>
                        </div>
                        <div class="icones-sociais container-icones-footer">
                            <a class="cor-c6" href="https://www.linkedin.com/in/gabrielm-oliveira/"><i class='bx bxl-linkedin'></i></a>
                            <a class="cor-c6" href="https://github.com/dev-modesto"><i class='bx bxl-github'></i></a>
                            <a class="cor-c6" href="mailto:gabriel_26@outlook.com.br"><i class='bx bxs-envelope'></i></a>
                        </div>
                    </div>
                </div>
                <div class="container-copyright">
                    <div class="container-info-corpyright">
                        <p>© 2024 · Desenvolvido por <span>devModesto</span></p>
                        <div class="container-logo-footer">
                            <img src="./assets/img/logo/logo-white.svg" alt="logo">
                        </div>
                    </div>
                </div>
            </footer>
        </main>

        <?php 
            include BASE_PATH . "/include/footer/footerScripts.php";
        ?>

    </body> 
</html>
