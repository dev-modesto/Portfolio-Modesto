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
                            <ul class="menu-itens-dropdown dropdown-menu" id="dropdown-menu">
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
                        <input type="text" id="nome" name="nome" placeholder="Nome e Sobrenome" required>
                    </div>

                    <div class="item-email">
                        <label for="email" class="font-1-s-2">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Seu_email@mail.com" required>
                    </div>

                    <div class="item-telefone">
                        <label for="telefone" class="font-1-s-2">Telefone</label>
                        <input type="fone" id="telefone" name="telefone" placeholder="(99) 99999-9999" required>
                    </div>

                    <div class="item-titulo-mensagem col-valor">
                        <label for="titulo-mensagem" class="font-1-s-2">Título da mensagem</label>
                        <input type="text" id="titulo-mensagem" name="titulo-mensagem" placeholder="Título da sua mensagem" required>
                    </div>

                    <div class="item-mensagem col-valor">
                        <label for="mensagem" class="font-1-s-2">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" placeholder="Como posso te ajudar?" required></textarea>
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

<script>
 
    $(document).ready(function () {

        function statusItensForm(parametro) {
            $('.item-nome input').attr('disabled', parametro);
            $('.item-email input').attr('disabled', parametro);
            $('.item-telefone input').attr('disabled', parametro);
            $('.item-titulo-mensagem input').attr('disabled', parametro);
            $('.item-mensagem textarea').attr('disabled', parametro);
            $('.btn-acao-contato').attr('disabled', parametro);
        }

        function limparFormulario() {
            $('.item-nome input').val('');
            $('.item-email input').val('');
            $('.item-telefone input').val('');
            $('.item-titulo-mensagem input').val('');
            $('.item-mensagem textarea').val('');
            $('.btn-acao-contato').val('');
        }

        const btnEnviarEmail = $('.btn-acao-contato')[0];
        const containerFooter = $('.container-footer-contato')[0];
        
        $('.container-form-contato').submit(function (e) {
            e.preventDefault();
            const dadosFormulario = new FormData(this);

            $.ajax({
                type: "post",
                url: "servicos/contato/enviarEmail.php",
                data: dadosFormulario,
                contentType: false,
                processData: false,
                
                beforeSend: function () {
                    btnEnviarEmail.innerHTML = 'Enviando... <svg width="24" height="24" stroke="#45D7C6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"/></g></svg>';

                    statusItensForm(true);

                },
                success: function (response) {

                    if(response.sucesso) {
                        limparFormulario();
                        btnEnviarEmail.innerHTML = 'Mensagem enviada <span class="material-symbols-rounded cor-p4">check</span>';

                        setTimeout(() => {
                        statusItensForm(false);
                            btnEnviarEmail.innerHTML = 'Enviar';
                        }, 2000);

                    } else {
                        limparFormulario();
                        containerFooter.innerHTML = '<div class="container-error-mensagem"><p class="texto-error"><span class="material-symbols-rounded">error</span>Ocorreu um erro. Não foi possível enviar a mensagem.</p><div>';
                        
                        setTimeout(() => {
                            statusItensForm(false);
                            containerFooter.innerHTML = '<button class="btn-acao-contato font-1-s-2 peso-semi-bold">Enviar</button>';
                        }, 3000);
                    }
                },
                error: function(response) {
                    limparFormulario();
                    containerFooter.innerHTML = '<div class="container-error-mensagem"><p class="texto-error"><span class="material-symbols-rounded">error</span>Ocorreu um erro. Não foi possível enviar a mensagem.</p><div>';
                    
                    setTimeout(() => {
                        statusItensForm(false);
                        containerFooter.innerHTML = '<button class="btn-acao-contato font-1-s-2 peso-semi-bold">Enviar</button>';
                    }, 3000);
                }
            });
        })
    });

</script>
