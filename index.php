<?php
    include 'config/base.php';
    include BASE_PATH . '/funcoes/funcaoData.php';
    include BASE_PATH . '/include/funcoes/db-queries/formacao.php';
    include BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    include BASE_PATH . '/include/funcoes/db-queries/tecnologia.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio | Modesto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- import das fontes -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/componentes.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/global/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/global/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/global/animacoes.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/home/home.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/sobre/sobre.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/habilidades/habilidades.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/projetos/projetos-destaque.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/formacao/formacao.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/footer/footer.css">

    <!-- meus icons -->
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
        <section class="home js-scroll">
            <div class="home-info order2">
                <div class="texto-home">
                    <h1 class="font-1-h1-b">Web Developer Front End</h1>
                    <p class="font-1-xxl-1">Me chamo <strong>Gabriel Modesto</strong> e eu sou fascinado por desenvolver interfaces web.</p>
                </div>
                <div class="icones-sociais">
                    <a class="cor-c6" href="https://www.linkedin.com/in/gabrielm-oliveira/"><i class='bx bxl-linkedin'></i></a>
                    <a class="cor-c6" href="https://github.com/dev-modesto"><i class='bx bxl-github'></i></a>
                    <a class="cor-c6" href="mailto:gabriel26_outlook.com.br"><i class='bx bxs-envelope'></i></a>
                </div>
            </div>
            <div class="home-foto order1">
                <img src="./assets/img/outros/foto.png" alt="">
            </div>
        </section>

        <section class="sobre js-scroll" id="sobre">
            <h1 class="font-1-h2-b">Sobre</h1>
            <p class="font-2-lg-r">Estudante de Análise e Desenvolvimento de Sistemas na Faculdade Digital Descomplica e formado em Técnico em Informática (voltado ao desenvolvimento web) na instituição de ensino SENAC RJ.</p>
            <br>
            <p class="font-2-lg-r">
            Como desenvolvedor Web, atuante em ambas as vertentes de desenvolvimento, meu foco principal está voltado ao <strong>Front-end</strong>, onde meu objetivo é o desenvolvimento de <strong>interfaces funcionais, seguras, otimizadas</strong> e, é claro, <strong>agradáveis.</strong> Viso a <strong>excelência</strong>, buscando superar sempres às expectativas das das partes interessadas, estando em constante aprendizado e aperfeiçoando técnicas a fim de oferecer ao usuário final uma <strong>melhor experiência</strong>.</p>
            <div class="sobre-localizacao">
                <span  class="material-symbols-rounded cor-c13">location_on</span>
                <p class="font-2-lg-r">Rio de Janeiro, RJ.</p>
            </div>
        </section>

        <section class="habilidades js-scroll" id="habilidades">
            <h1 class="font-1-h2-b">Minhas <span>habilidades</span></h1>
            <div class="habilidades-containerExterno">
                <div class="habilidades-containerTecnologias">
                    <div class="habilidades-principais-container">
                        <h2 class="font-2-lg-r">Tecnologias que estou em aprendizado contínuo</h2>
                        <div class="habilidades-principais-container-icons scroll-habilidades-principais">
                            <?php 
            
                                $cTecnologia = cTecnologia($con, null, 'visivel', 'tecnologia');

                                while ($arrayTecFerramentas = mysqli_fetch_assoc($cTecnologia)) {

                                    $nomeTec = $arrayTecFerramentas['nome'];
                                    $caminhoOriginalTec = $arrayTecFerramentas['caminho_original'];
                                    $caminhoPlainTec = $arrayTecFerramentas['caminho_plain'];

                                    ?>
                                        <div class="container-icons" data-tech="<?php echo $nomeTec ?>">
                                            <img class="habilidades-icons" src="<?php echo BASE_URL . $caminhoPlainTec ?>" alt="<?php echo 'imagem do icone da tecnologia ' . $nomeTec?>" data-original="<?php echo BASE_URL . $caminhoOriginalTec ?>" data-plain="<?php echo BASE_URL . $caminhoPlainTec ?>">
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="habilidades-ferramentas-container">
                       <h2 class="font-2-lg-r">Ferramentas que utilizo no dia a dia</h2>
                        <div class="habilidades-principais-container-icons">
                            <?php 

                                $cTecnologia = cTecnologia($con, null, 'visivel', 'ferramenta');

                                while ($arrayFerramentas = mysqli_fetch_assoc($cTecnologia)) {

                                    $nomeFerramenta = $arrayFerramentas['nome'];
                                    $caminhoOriginalFerramenta = $arrayFerramentas['caminho_original'];
                                    $caminhoPlainFerramenta = $arrayFerramentas['caminho_plain'];

                                    ?>
                                        <div class="container-icons" data-tech="<?php echo $nomeFerramenta ?>">
                                            <img class="habilidades-icons" src="<?php echo BASE_URL . $caminhoPlainFerramenta ?>" alt="<?php echo 'imagem do icone da tecnologia ' . $nomeFerramenta?>" data-original="<?php echo BASE_URL . $caminhoOriginalFerramenta ?>" data-plain="<?php echo BASE_URL . $caminhoPlainFerramenta ?>">
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="projetosDestaque js-scroll" id="projetosDestaque">
            <h1 class="font-1-h2-b">Projetos em destaque</h1>
            <p class="font-2-lg-r texto-destaque">Abaixo, encontram-se alguns dos melhores projetos. Fique à vontade para visualizar e explorá-los.</p>

            <div class="projetosDestaque-container-cards">

                <?php

                    $cProjeto = cProjeto($con, 'Sim', 'Ativo');

                    if (mysqli_num_rows($cProjeto) > 0) {
                        while ($arrayProjeto = mysqli_fetch_assoc($cProjeto)) {
                            $idProjeto = $arrayProjeto['id_projeto']; 
                            $nomeProjeto = $arrayProjeto['nome_projeto']; 
                            $descricao = $arrayProjeto['descricao']; 
                            $descricaoTpProjeto = $arrayProjeto['descricao_tipo_projeto'];
                            $tipoProjeto = $arrayProjeto['tipo_projeto']; 
                            $dataLancamento = $arrayProjeto['dt_desenvolvimento']; 
                            $linkDeploy = $arrayProjeto['link_deploy'];
                            $linkFigma = $arrayProjeto['link_figma'];
                            $linkRepositorio = $arrayProjeto['link_repositorio'];

                            $cProjetoImagemProjeto = cProjetoImagem($con, $idProjeto, 'projeto');
                            $arrayImagensProjeto = mysqli_fetch_assoc($cProjetoImagemProjeto);
                            $caminhoOriginal = $arrayImagensProjeto['caminho_original'];
                            $textoAlternativo = $arrayImagensProjeto['texto_alt'];

                            $cProjetoImagemLogo = cProjetoImagem($con, $idProjeto, 'logo');
                            $arrayImagemLogoProjeto = mysqli_fetch_assoc($cProjetoImagemLogo);
                            $caminhoOriginalLogo = $arrayImagemLogoProjeto['caminho_original'];

                            $cTecnologiaProjeto = cTecnologiaProjeto($con, $idProjeto);
                            $tecnologias = [];

                            while ($arrayTecnologia = mysqli_fetch_assoc($cTecnologiaProjeto)) {
                                // $tecnologias[] = $arrayTecnologia['nome'];
                                $tecnologias[] = '<span class="tecnologia">' . htmlspecialchars($arrayTecnologia['nome']) . '</span>';
                                
                            }

                            $tecnologiasProjeto = implode('', $tecnologias);

                            ?>
                                <!-- card completo  -->
                                <div class="projetoDestaque-cards">
                                    <!-- frente do card -->
                                    <div class="projetoDestaque-cards-frontal">
                                        <div class="projetoDestaque-cards--techs" data-name="<?php echo $nomeProjeto ?>">
                                            <p class="font-1-md-sb cor-c6"><?php echo $tecnologiasProjeto ?></p>
                                        </div>
                                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                                            <img src="<?php echo BASE_URL . $caminhoOriginal ?>" alt="<?php echo $textoAlternativo ?>">
                                        </div>
                                    </div>

                                    <!-- verso do card -->
                                    <div class="projetoDestaque-cards-verso">
                                        <div class="projetoDestaque-cards--techs techs-verso" data-name="<?php echo $nomeProjeto ?>">
                                            <p class="font-1-md-sb cor-c2"><?php echo $tecnologiasProjeto ?></p>
                                        </div>
                                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                                            <div class="projetoDestaque-cards--conteudo-buttons">
                                                <div class="container-btn-links-cards">
                                                    <?php 
                                                        if (!$linkDeploy == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?php echo $linkDeploy ?>"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                                            <?php
                                                        }
                                                        
                                                        if (!$linkFigma == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?php echo $linkFigma ?>"><i class='bx bxl-figma'></i>FIGMA</a>
                                                            <?php
                                                        }
                                                        
                                                        if (!$linkRepositorio == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?php echo $linkRepositorio ?>"><i class='bx bxl-github'></i>GITHUB</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="container-buttons-link-logo">
                                                    <div class="conteudo-buttons-link-logo">
                                                        <a href="#">
                                                            <img src="<?php echo BASE_URL . $caminhoOriginalLogo ?>" alt="" width="90" height="90">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="projetoDestaque-cards--conteudo-texto">
                                                <div class="conteudo-texto">
                                                    <h3>Descrição</h3>
                                                    <p class="font-2-md-r cor-c3"><?php echo $descricao ?></p>
                                                </div>
                                                <div class="container-button-saiba-mais">
                                                    <a href="#" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    } 
                ?>
            </div>

            <a href="#" class="projetosDestaque-btn-visualizar-todos"><span class="material-symbols-rounded">folder_copy</span>Ver todos os projetos</a>

        </section>

        <section class="formacao js-scroll" id="formacao">
            <div class="formacao-academica-container">
                <div class="container-titulo-formacao-academica">
                    <h1 class="font-1-h2-b cor-c3 titulo-formacao-academica">Formação acadêmica</h1>
                </div>
                <!-- container dos cards academicos -->
                <div class="formacao-academica-cards">
                    <span class="formacao-academica-linesx"></span>
                    <span class="formacao-academica-lines"></span>

                    <?php

                        $cFormacaoAcademico = cFormacaoAcademico($con);

                        while ($arrayFormacao = mysqli_fetch_assoc($cFormacaoAcademico)) {
                            $idFormacao = $arrayFormacao['id_formacao'];
                            $nomeCursoFormacao = $arrayFormacao['nome'];
                            $instituicaoFormacao = $arrayFormacao['instituicao'];
                            $categoriaCursoFormacao = $arrayFormacao['categoria_curso'];
                            $dt_inicio = $arrayFormacao['dt_inicio'];
                            $dt_fim = $arrayFormacao['dt_fim'];
                            $caminhoImagem = $arrayFormacao['caminho_original'];
                            $linkDiploma = $arrayFormacao['link_certificado'];
                            $status = $arrayFormacao['status'];

                            $dataFormacaoInicioFormatada = dataFormatadaMesAno($dt_inicio);
                            $dataFormacaoFimFormatada = dataFormatadaMesAno($dt_fim);

                            ?>
                                <!-- card completo -->
                                <div class="card-formacao card-grid-academico" data-tag-name-course="<?php echo $categoriaCursoFormacao ?>">

                                    <!-- card frontal -->
                                    <div class="card-formacao-frontal">
                                        <div class="card-formacao-img-logo">
                                            <img src="<?php echo BASE_URL . $caminhoImagem ?>" alt="">
                                        </div>
                                        <div class="card-formacao-texto">
                                            <p class="card-formacao--instituicao"><?php echo $instituicaoFormacao ?></p>
                                            <h3 class="card-formacao--curso"><?php echo $nomeCursoFormacao ?></h3>
                                            <div class="card-formacao-periodo">
                                                <p class="card-formacao-periodo--inicio"><?php echo $dataFormacaoInicioFormatada ?> - <?php echo $dataFormacaoFimFormatada ?> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- card verso -->
                                    <div class="card-formacao-verso">
                                        <div class="card-formacao-verso--status">
                                            <?php 
                                                if ($status == 'Concluído') {
                                                    ?>
                                                        <a href="<?php echo $linkDiploma ?>"><span class="material-symbols-rounded">school</span>VISUALIZAR DIPLOMA</a>    
                                                        <?php
                                                } else {
                                                    ?>
                                                        <a href="#" aria-disabled="true">FORMAÇÃO EM ANDAMENTO</a>    
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="container-icone-status-formacao">
                                       <?php 
                                            if ($status == 'Concluído') {
                                                $icone = 'check';
                                                $classe = 'icone-concluido';
                                            } else {
                                                $icone = 'more_horiz';
                                                $classe = 'icone-andamento';
                                            }
                                       ?> 
                                        <span class="material-symbols-rounded <?php echo $classe ?>"><?php echo $icone ?></span>
                                    </div>
                                </div>
                            
                            <?php
                        }
                    ?>
                </div>

                <div class="formacao-academica-container-certificados">
                    <h1 class="font-1-h2-b cor-c3">Certificados</h1>
                    
                    <form class="form-filtro-certificados" id="filtrar-certificados">

                        <!-- filtro certificados -->
                        <div class="filtro-certificados" role="group">
                            <button class="filtro-certificados-button active" name="categoria" value="0">TODOS</button>

                            <?php 
                                $cAreaFormacao = cAreaFormacao($con);

                                while ($arrayAreaFormacao = mysqli_fetch_assoc($cAreaFormacao)) {

                                    $idAreaFormacao = $arrayAreaFormacao['id_area_formacao'];
                                    $nomeAreaFormacao = $arrayAreaFormacao['nome'];
                                    $nomeAreaFormacao = strtoupper($nomeAreaFormacao);
                                    ?>
                                        <button class="filtro-certificados-button" name="categoria" value="<?php echo $idAreaFormacao ?>"><?php echo $nomeAreaFormacao?></button>
                                    <?php

                                }
                            ?>
                        </div>

                        <!-- filtro certificados - mobile -->
                        <div class="filtro-certificados-mobile">
                            <select name="filtro-mobile-select" class="filtro-certificados-button-min" id="filtro-mobile-select">
                                <option class="" value="0">TODOS</option>

                                <?php 
                                  $cAreaFormacao = cAreaFormacao($con);

                                    while ($arrayAreaFormacaoMin = mysqli_fetch_assoc($cAreaFormacao)) {

                                        $idAreaFormacaoMin = $arrayAreaFormacaoMin['id_area_formacao'];
                                        $nomeAreaFormacaoMin = $arrayAreaFormacaoMin['nome'];
                                        $nomeAreaFormacaoMin = strtoupper($nomeAreaFormacaoMin);
                                        ?>
                                            <option class="" value="<?php echo $idAreaFormacaoMin ?>"><?php echo $nomeAreaFormacaoMin ?></option>
                                        <?php

                                    }
                                ?>
                            </select>
                            <button type="submit" class="filtro-mobile-button">Filtrar</button>
                        </div>

                    </form>

                    <!-- container dos cards certificados -->
                    <div class="certificados-cards">
                        <?php 

                            $cFormacaoCurso = cFormacaoCurso($con);

                            while ($resultado = mysqli_fetch_assoc($cFormacaoCurso)) {

                                $idFormacao = $resultado['id_formacao'];
                                $nomeCurso = $resultado['nome'];
                                $instituicao = $resultado['instituicao'];
                                $categoriaCurso = $resultado['categoria_curso'];
                                $totalHoras = $resultado['total_horas'];
                                $dt_fim = $resultado['dt_fim'];
                                $caminhoImagem = $resultado['caminho_original'];
                                $linkCertificadoCurso = $resultado['link_certificado'];
                                $dataCertificadoConclusao = dataFormatadaMesAno($dt_fim);
                                $status = $resultado['status'];

                                ?>
                                    <!-- card completo -->
                                    <div class="card-formacao" data-tag-name-course="<?php echo $categoriaCurso ?>">
                
                                        <!-- card frontal -->
                                        <div class="card-formacao-frontal">
                                            <div class="card-formacao-img-logo">
                                                <img src="<?php echo BASE_URL . $caminhoImagem ?>" alt="">
                                            </div>
                                            <div class="card-formacao-texto">
                                                <p class="card-formacao--instituicao"><?php echo $instituicao ?></p>
                                                <h3 class="card-formacao--curso"><?php echo $nomeCurso ?></h3>
                                                <div class="card-formacao-periodo">
                                                    <p class="card-formacao-periodo--conclusao"><?php echo $dataCertificadoConclusao ?></p>
                                                </div>
                                                <p class="card-formacao-horas"><?php echo $totalHoras ?> horas</p>
                                            </div>
                                        </div>

                                        <!-- card verso -->
                                        <div class="card-formacao-verso">
                                            <div class="card-formacao-verso--status">
                                                <?php 
                                                    if ($status == 'Concluído') {
                                                        ?>
                                                            <a href="<?php echo $linkCertificadoCurso ?>"><span class="material-symbols-rounded">workspace_premium</span>VISUALIZAR CERTIFICADO</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a href="#" aria-disabled="true">CURSO EM ANDAMENTO</a>    
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="container-icone-status-formacao">
                                            <?php 
                                                if ($status == 'Concluído') {
                                                    $icone = 'check';
                                                    $classe = 'icone-concluido';
                                                } else {
                                                    $icone = 'more_horiz';
                                                    $classe = 'icone-andamento';
                                                }
                                            ?> 
                                            <span class="material-symbols-rounded <?php echo $classe ?>"><?php echo $icone ?></span>
                                        </div>
                                    </div>
                                
                                <?php
                            }                            
                        ?>
                    </div>
                
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
                        <a class="cor-c6" href="mailto:gabriel26_outlook.com.br"><i class='bx bxs-envelope'></i></a>
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