<?php
    include 'config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/tecnologia.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    include BASE_PATH . '/filtros.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio | aaaa</title>

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
                                <a href="#"><span class="material-symbols-rounded">folder_copy</span><span class="menu-itens-dropdown-text">Visualizar todos</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="index.php#formacao">Formação</a></li>
                    <li><a href="">Contato</a></li>
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
                        <li><a href="#">Todos os projetos</a></li>
                        <li><a href="index.php#formacao">Formação</a></li>
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
                    filtroProjetosMobile($con);
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

                            date_default_timezone_set('America/Sao_Paulo');
                            $newDtDesenvolvimento = new DateTime($dtDesenvolvimento);
                            $dtDesenvolvimentoFormatada = date_format($newDtDesenvolvimento, 'd/m/Y');

                            $linkDeploy = $valorProjeto['link_deploy'];
                            $linkFigma = $valorProjeto['link_figma'];
                            $linkRepositorio = $valorProjeto['link_repositorio'];
                            $statusProgresso = $valorProjeto['status'];

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

                            $cAutorProjeto = cAutorProjeto($con, $idProjeto);
                            $consultaAutorProjeto = mysqli_fetch_all($cAutorProjeto, MYSQLI_ASSOC);

                            ?>

                            <div class="container-card-projeto-completo js-scroll">
                                <div class="container-card-projeto-imagem">
                                    <div class="tec-etiqueta todos-projetos" data-name="<?= $nomeProjeto ?>">
                                        <p class="font-1-md-sb cor-c9">Tecs. utilizadas</p>
                                        <div class="cabecalho-techs-cards">
                                            <?php
                                                $cTecnologiaProjeto = cTecnologiaProjeto($con, $idProjeto);
                                                $arrayTecnologiaProjeto = mysqli_fetch_all($cTecnologiaProjeto, MYSQLI_ASSOC);

                                                foreach ($arrayTecnologiaProjeto as $chave => $valor) {
                                                    $nomeTecnologia = $valor['nome'];
                                                    $idImagem = $valor['id_imagem'];
                                                    $caminhoPlain = $valor['caminho_plain'];

                                                    ?>
                                                        <img src="<?= BASE_URL . $caminhoPlain ?>" alt="icone <?= $nomeTecnologia ?>">
                                                    <?php
                                                }
                                                
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card-projeto-completo-imagem">
                                        <a class="btn-img-ant btn-img-prevnext" onclick="prevImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_left</span></a>
                                        <img id="imagem-projeto-<?= $indiceProjeto ?>" src="<?= $imagens[0]['caminho'] ?>" alt="">
                                        <a class="btn-img-prox btn-img-prevnext" onclick="nextImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_right</span></a>
                                    </div>
                                    <div class="container-indice-marcador-imagem indice-projeto-<?= $indiceProjeto ?>">
                                        <?php
                                            $indiceImagem = 0;
                                            foreach($imagens as $imagem) {
                                                $classeAtivo = $indiceImagem === 0 ? 'ativo' : '';

                                                ?>
                                                    <span class="marcador-imagem-projeto indice-imagem-<?= $indiceProjeto . $indiceImagem?> <?= $classeAtivo ?>"></span>
                                                <?php

                                                $indiceImagem++;
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="card-projeto-titulo">
                                    <span class="card-projeto-numero-marcador cor-c4"><?=$indiceProjetoFormatado?></span>
                                    <h1 class="card-projeto-nome-titulo font-1-h2-b"><?=$nomeProjeto?></h1>
                                </div>

                                <div class="card-projeto-conteudo">
                                    <div class="card-projeto-accordion">
                                        <div class="accordion-container">
                                            <div class="accordion-titulo ativo font-2-md-r">Descrição<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo ativo">
                                                <p class="font-2-md-r peso-normal"><?= $descricao ?></p>
                                            </div>
                                        </div>
                                        <div class="accordion-container">
                                            <div class="accordion-titulo font-2-md-r">Tecnologias utilizadas<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo tecnologias">
                                                <?php

                                                    $cTecnologiaProjeto = cTecnologiaProjeto($con, $idProjeto);
                                                    $arrayTecnologiaProjeto = mysqli_fetch_all($cTecnologiaProjeto, MYSQLI_ASSOC);

                                                    foreach ($arrayTecnologiaProjeto as $chave => $valor) {
                                                        $nomeTecnologia = $valor['nome'];
                                                        $idImagem = $valor['id_imagem'];
                                                        $caminhoOriginal = $valor['caminho_original'];

                                                        ?>
                                                            <div class="card-imagem-tecnologia-projeto">
                                                                <img src="<?= BASE_URL . $caminhoOriginal ?>" alt="icone <?= $nomeTecnologia ?>">
                                                                <p class="font-1-sm-r peso-normal"><?= $nomeTecnologia ?></p>
                                                            </div>
                                                        <?php
                                                    }

                                                ?>
                                            </div>
                                        </div>
                                        <div class="accordion-container">
                                            <div class="accordion-titulo font-2-md-r">Tipo de Projeto<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo">
                        
                                            </div>
                                        </div>
                                        <div class="accordion-container">
                                            <div class="accordion-titulo font-2-md-r">Data de desenvolvimento<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo">
                                                <p class="font-2-md-r peso-normal"><?php echo $statusProgresso == 'Andamento' ? 'Projeto em andamento' : $dtDesenvolvimentoFormatada ?></p>
                                            </div>
                                        </div>
                                        <div class="accordion-container autores">
                                            <div class="accordion-titulo font-2-md-r">Autor (es)<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo autores">
                                                <?php

                                                    foreach ($consultaAutorProjeto as $chave => $valor) {
                                                        $nomeAutor = $valor['nome'];
                                                        $linkLinkedin = $valor['link_linkedin'];
                                                        $linkGithub = $valor['link_github'];

                                                        ?>
                                                            <a class="font-2-md-r peso-normal" href="<?= $linkLinkedin?>" aria-disabled="<?php echo $linkLinkedin == '' ? 'true' : 'false' ?>">
                                                                <span class="material-symbols-rounded">person_pin</span><?= $nomeAutor ?>
                                                            </a>

                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-projeto-container-btn">
                                        <?php 
                                            if (!$linkDeploy == "") {
                                                ?>
                                                    <a class="btn-links-cards projetos deploy font-1-md-l cor-c12" href="<?= $linkDeploy ?>"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                                <?php
                                            }
                                            
                                            if (!$linkFigma == "") {
                                                ?>
                                                    <a class="btn-links-cards projetos font-1-md-l cor-c12" href="<?= $linkFigma ?>"><i class='bx bxl-figma'></i>FIGMA</a>
                                                <?php
                                            }
                                            
                                            if (!$linkRepositorio == "") {
                                                ?>
                                                    <a class="btn-links-cards projetos font-1-md-l cor-c12" href="<?= $linkRepositorio ?>"><i class='bx bxl-github'></i>GITHUB</a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <script>
                                window['imagensProjeto<?= $indiceProjeto ?>'] = <?= json_encode($imagens) ?>;
                                window['indiceAtual<?= $indiceProjeto ?>'] = 0;
                            </script>
                            
                            <hr>

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
    include BASE_PATH . "/include/footer/footerScripts.php";
?>

<script src="<?= BASE_URL . '/js/imagensProjetos.js'?>"></script>
<script src="<?= BASE_URL . '/js/accordion.js'?>"></script>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        initAccordion();
    });

</script>

</body>
</html>