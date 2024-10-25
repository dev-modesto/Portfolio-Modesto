<?php
    include 'config/base.php';
    include BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    include BASE_PATH . '/include/funcoes/db-queries/formacao.php';
    include BASE_PATH . '/include/funcoes/db-queries/tecnologia.php';
    include BASE_PATH . '/filtros.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio | aaaa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- import das fontes -->
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
    <link rel="stylesheet" href="<?=BASE_URL?>/css/habilidades/habilidades.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/projetos/projetos-destaque.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/projetos/todosProjetos.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/formacao/formacao.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/footer/footer.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
</head>
<style>
    .tecnologia + .tecnologia {
        margin-left: 15px;
    }
</style>
<body>
    <header>
        <div class="navbar fixed-top" id="navbar">
            <div class="logo">
                <img src="./assets/img/logo/logo-black.svg" id="logo1" alt="logo">
                <img src="assets/img/logo/logo-white.svg" id="logo2" alt="logo">
            </div>
            <nav class="menu">
                <ul class="menu-itens">
                    <li><a href="#">Início</a></li>
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="#habilidades">Habilidades</a></li>
                    <li>
                        <a id="activedrop"> 
                            Projetos         
                            <span class="material-symbols-rounded" id="iconProjetos">
                            keyboard_arrow_down
                            </span>
                        </a>
                        <ul class="menu-itens-dropdown" id="dropdown-menu">
                            <li>
                                <a href="#projetosDestaque">
                                    <span class="material-symbols-rounded">
                                        star
                                    </span> <span class="menu-itens-dropdown-text">Em destaque</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="material-symbols-rounded">
                                        folder_copy
                                    </span><span class="menu-itens-dropdown-text">Visualizar todos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#formacao">Formação</a></li>
                    <li><a href="#contato">Contato</a></li>
                </ul>
            </nav>
            <nav class="menu-mobile" id="drop-mobile">
                <span class="material-symbols-rounded" id="icon-mobile">
                    menu
                </span>
                <ul class="bg-line-mobile1">
                    <ul class="menu-mobile-itens" id="drop-menu-mobile">
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Habilidades</a></li>
                        <li><a href="#">Projetos destaque</a></li>
                        <li><a href="#">Todos os projetos</a></li>
                        <li><a href="#">Formação</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </ul>
            </nav>
        </div>
    </header>

    <main>

        <section class="todosProjetos js-scroll" id="todosProjetos">
            <h1 class="font-1-h2-b">Projetos</h1>
            <p class="font-2-lg-r texto-destaque">Aqui, você encontra todos os meus projetos em detalhes. Fique á vontade para explorá-los.</p>

            <div class="container-filtro-projetos">
                <?php 
                    filtroProjetosDesk($con);
                ?>
            </div>

            <div class="container-principal-todos-projetos">
                <?php
                    $cProjeto = cProjeto($con, null, null, null, null, 'Ativo');
                    $arrayProjeto = mysqli_fetch_all($cProjeto, MYSQLI_ASSOC);
            
                    $totalProjetos = mysqli_num_rows($cProjeto);
                    $totalProjetosFormatado = str_pad($totalProjetos, 2, 0, STR_PAD_LEFT);
                
                ?>

                <div class="container-marcador-total-projetos">
                        <span class="total-projetos">TOTAL - <?=$totalProjetosFormatado?> </span>
                </div>
                <div class="container-cards-projetos">
                    <?php 

                        $indiceProjeto = 1;

                        foreach ($arrayProjeto as $chave => $valorProjeto) {
                            $idProjeto = $valorProjeto['id_projeto'];
                            $nomeProjeto = $valorProjeto['nome_projeto'];
                            $descricao = $valorProjeto['descricao'];
                            $descicaoTipoProjeto = $valorProjeto['descricao_tipo_projeto'];
                            $tipoProjeto = $valorProjeto['tipo_projeto'];
                            $dtDesenvolvimento = $valorProjeto['dt_desenvolvimento'];
                            $linkDeploy = $valorProjeto['link_deploy'];
                            $linkFigma = $valorProjeto['link_figma'];
                            $linkRepositorio = $valorProjeto['link_repositorio'];

                            $tipoImagem = ['thumbnail', 'extra'];
                            $cProjetoImagem = cProjetoImagem($con, $idProjeto, null, $tipoImagem);
                            $arrayImagens = mysqli_fetch_all($cProjetoImagem, MYSQLI_ASSOC);
                            $imagens = [];


                            foreach ($arrayImagens as $valor) {
                                $imagens[] = [
                                    'caminho' => BASE_URL . $valor['caminho_original'],
                                    'tipo' => $valor['tipo_imagem']
                                ];
                            }

                            $indiceProjetoFormatado = str_pad($indiceProjeto, 2, '0', STR_PAD_LEFT);

                            ?>

                            <div class="container-card-projeto-completo">
                                <div class="container-card-projeto-imagem">
                                    <div class="container-card-projeto-imagem-techs" data-name="<?= $nomeProjeto ?>">
                                        <p class="font-1-md-sb cor-c9">Tecs. utilizadas</p>
                                        <div class="cabecalho-techs-cards">
                                            <?php
                                                $cTecnologiaProjeto = cTecnologiaProjeto($con, $idProjeto);

                                                while ($arrayTecnologia = mysqli_fetch_assoc($cTecnologiaProjeto)) {
                                                    $nomeTecnologia = $arrayTecnologia['nome'];
                                                    $idTecnologia = $arrayTecnologia['id_tecnologia'];
                                                    $idImagem = $arrayTecnologia['id_imagem'];

                                                    $cTecnologiaInfoImagem = cTecnologiaInfoImagem($con, $idTecnologia);

                                                    while ($arrayInfoImagem = mysqli_fetch_assoc($cTecnologiaInfoImagem)) {
                                                        $caminhoPlain = $arrayInfoImagem['caminho_plain'];
                                                        ?>
                                                            <img src="<?= BASE_URL . $caminhoPlain ?>" alt="icone <?= $nomeTecnologia ?>">
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card-projeto-completo-imagem">
                                        <a class="btn-img-ant btn-img-prevnext" onclick="prevImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_left</span></a>
                                        <img id="imagem-projeto-<?= $indiceProjeto ?>" src="<?= $imagens[0]['caminho'] ?>" alt="">
                                        <a class="btn-img-prox btn-img-prevnext" onclick="nextImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_right</span></a>
                                    </div>
                                </div>

                                <div class="card-projeto-completo-informacao">
                                    <div class="card-projeto-titulo">
                                        <span class="card-projeto-numero-marcador font-1-h2-b cor-c4"><?=$indiceProjetoFormatado?></span>
                                        <h1 class="font-1-h4-sb"><?=$nomeProjeto?></h1>
                                    </div>

                                    <div class="card-projeto-conteudo">
                                        <div class="card-projeto-accordion">
                                            <div class="accordion-container">
                                                <div class="accordion-titulo ativo">Descrição<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                <div class="accordion-conteudo ativo">
                                                    <p class="font-1-md-l">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate maxime dolorum, velit saepe natus est hic accusantium nobis, neque cumque labore ducimus architecto. Natus, nesciunt ullam! Nulla autem dolorem voluptatibus.</p>
                                                </div>
                                            </div>
                                            <div class="accordion-container">
                                                <div class="accordion-titulo">Tecnologias utilzadas<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                <div class="accordion-conteudo">

                                                </div>
                                            </div>
                                            <div class="accordion-container">
                                                <div class="accordion-titulo">Tipo de Projeto<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                <div class="accordion-conteudo">

                                                </div>
                                            </div>
                                            <div class="accordion-container">
                                                <div class="accordion-titulo">Data de desenvolvimento<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                <div class="accordion-conteudo">

                                                </div>
                                            </div>
                                            <div class="accordion-container">
                                                <div class="accordion-titulo">Autor (es)<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                <div class="accordion-conteudo">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-projeto-container-btn">
                                            <?php 
                                                if (!$linkDeploy == "") {
                                                    ?>
                                                        <a class="btn-links-cards projetos deploy font-1-md-l cor-c9" href="<?= $linkDeploy ?>"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                                    <?php
                                                }
                                                
                                                if (!$linkFigma == "") {
                                                    ?>
                                                        <a class="btn-links-cards projetos font-1-md-l cor-c9" href="<?= $linkFigma ?>"><i class='bx bxl-figma'></i>FIGMA</a>
                                                    <?php
                                                }
                                                
                                                if (!$linkRepositorio == "") {
                                                    ?>
                                                        <a class="btn-links-cards projetos font-1-md-l cor-c9" href="<?= $linkRepositorio ?>"><i class='bx bxl-github'></i>GITHUB</a>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                window['imagensProjeto<?= $indiceProjeto ?>'] = <?= json_encode($imagens) ?>;
                                window['indiceAtual<?= $indiceProjeto ?>'] = 0;
                            </script>
                            
                            <?php
                                $indiceProjeto++;
                        }

                    ?>
                </div>
            </div>
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
    include BASE_PATH . "/include/footer/footer-scripts.php";
?>

<script src="js/animacoes.js"></script>

<script>
    
    function atualizaImagem(valorIndice) {
        const imagemProjeto = document.getElementById('imagem-projeto-' + valorIndice);
        imagemProjeto.src = window['imagensProjeto' + valorIndice][window['indiceAtual' + valorIndice]].caminho;
    }

    function prevImage(valorIndice) {
        const indiceAtual = window['indiceAtual' + valorIndice];
        window['indiceAtual' + valorIndice] = (indiceAtual > 0) ? indiceAtual - 1 : window['imagensProjeto' + valorIndice].length - 1;
        atualizaImagem(valorIndice);
    }

    function nextImage(valorIndice) {
        const indiceAtual = window['indiceAtual' + valorIndice];
        window['indiceAtual' + valorIndice] = (indiceAtual < window['imagensProjeto' + valorIndice].length - 1) ? indiceAtual + 1 : 0;
        atualizaImagem(valorIndice);
    }

    function initAccordion() {
        const titulosAccordion = document.querySelectorAll('.accordion-titulo');

        titulosAccordion.forEach(titulo => {
            titulo.removeEventListener('click', accordionClickHandler); // Remove qualquer evento existente
            titulo.addEventListener('click', accordionClickHandler); // Adiciona novamente
        });
    }

    function accordionClickHandler() {
        const conteudo = this.nextElementSibling;
        const tituloAtual = this;
        
        const allTitulos = this.closest('.card-projeto-accordion').querySelectorAll('.accordion-titulo');
        allTitulos.forEach(titulo => {
            titulo.classList.remove('ativo');
        });

        const conteudoAtivo = conteudo.classList.contains('ativo');

        if (conteudoAtivo) {
            tituloAtual.classList.remove('ativo');
        } else {
            tituloAtual.classList.add('ativo');
        }

        const allConteudos = this.closest('.card-projeto-accordion').querySelectorAll('.accordion-conteudo');
        allConteudos.forEach(item => {
            if (item !== conteudo) {
                item.classList.remove('ativo');
            }
        });

        conteudo.classList.toggle('ativo');
    }

    initAccordion();

    document.addEventListener("DOMContentLoaded", function() {
        const icons = document.querySelectorAll(".habilidades-icons");

        icons.forEach(icon => {
            icon.addEventListener("mouseover", function() {
                this.src = this.getAttribute("data-original");
            });

            icon.addEventListener("mouseout", function() {
                this.src = this.getAttribute("data-plain");
            });
        });
    });

</script>

</body>
</html>