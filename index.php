<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/portfolio-modesto/config/config.php';
    include ARQUIVO_CONEXAO;
    include FUNCAO_DATA;

    $sql = "SELECT 
            f.id_formacao, 
            f.nome, 
            f.instituicao, 
            f.categoria_curso,
            f.dt_inicio, 
            f.dt_fim, 
            f.id_imagem,
            f.total_horas,
            i.caminho,
            f.link_certificado,
            f.status
        FROM tbl_formacao f 
        INNER JOIN tbl_imagem i
        ON f.id_imagem = i.id_imagem
        WHERE categoria_curso = 'Curso Livre'
    ";

    $consulta = mysqli_query($con, $sql);

    $sqlFormacao = 
        "SELECT 
            f.id_formacao, 
            f.nome, 
            f.instituicao, 
            f.categoria_curso,
            f.dt_inicio, 
            f.dt_fim, 
            f.id_imagem,
            i.caminho,
            f.link_certificado,
            f.status
        FROM tbl_formacao f 
        INNER JOIN tbl_imagem i
        ON f.id_imagem = i.id_imagem
        WHERE categoria_curso != 'Curso Livre' 
        ORDER BY id_formacao DESC
    ";
    
    $consultaFormacao = mysqli_query($con, $sqlFormacao);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio | Modesto</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- meus icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
</head>
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
        <section class="home">
            <div class="home-info order2">
                <h1 class="font-1-h1-b">Web Developer Front End</h1>
                <p class="font-2-xl-r">Me chamo <strong>Gabriel Modesto</strong> e eu sou fascinado por desenvolver interfaces web.</p>
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

        <section class="sobre" id="sobre">
            <h1 class="font-1-h2-b">Sobre</h1>
            <p class="font-2-lg-r">Estudante de Análise e Desenvolvimento de Sistemas na Faculdade Digital Descomplica e formado em Técnico em Informática (voltado ao desenvolvimento web) na instituição de ensino SENAC RJ.</p>
            <br>
            <p class="font-2-lg-r">
            Como desenvolvedor Web, atuante em ambas as vertentes de desenvolvimento, meu foco principal está voltado ao <strong>Front-end</strong>, onde meu objetivo é o desenvolviemento de <strong>interfaces funcionais, seguras, otimizadas</strong>e, é claro, <strong>agradáveis.</strong> Viso a <strong>excelência</strong>, buscando superar sempres às expectativas das das partes interessadas, estando em constante aprendizado e aperfeiçoando técnicas a fim de oferecer ao usuário final uma <strong>melhor experiência</strong>.</p>
            <div class="sobre-localizacao">
                <span  class="material-symbols-rounded cor-c13">location_on</span>
                <p class="font-2-lg-r">Rio de Janeiro, RJ.</p>
            </div>
        </section>

        <section class="habilidades" id="habilidades">
            <h1 class="font-1-h2-b">Minhas <span>habilidades</span></h1>
            <div class="habilidades-containerExterno">
                <div class="habilidades-containerTecnologias">
                    <div class="habilidades-principais-container">
                        <h2 class="font-2-lg-r">Tecnologias que estou em aprendizado contínuo</h2>
                        <div class="habilidades-principais-container-icons scroll-habilidades-principais">
                            
                            <div class="container-icons" data-tech="JavaScript">
                                <img class="habilidades-icons" src="assets/img/tecnologias/javascript-plain.svg" alt="JavaScript" data-original="assets/img/tecnologias/javascript-original.svg" data-plain="assets/img/tecnologias/javascript-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="TypeScript">
                                <img class="habilidades-icons" src="assets/img/tecnologias/typescript-plain.svg" alt="TypeScript" data-original="assets/img/tecnologias/typescript-original.svg" data-plain="assets/img/tecnologias/typescript-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="PHP">
                                <img class="habilidades-icons" src="assets/img/tecnologias/php-plain.svg" alt="PHP" data-original="assets/img/tecnologias/php-original.svg" data-plain="assets/img/tecnologias/php-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="SQL (MySQL e SQL Server)">
                                <img class="habilidades-icons" src="assets/img/tecnologias/sql-plain.svg" alt="sql" data-original="assets/img/tecnologias/sql-original.svg" data-plain="assets/img/tecnologias/sql-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="React">
                                <img class="habilidades-icons" src="assets/img/tecnologias/react-plain.svg" alt="React" data-original="assets/img/tecnologias/react-original.svg" data-plain="assets/img/tecnologias/react-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="Node.js">
                                <img class="habilidades-icons" src="assets/img/tecnologias/nodejs-plain.svg" alt="Node.js" data-original="assets/img/tecnologias/nodejs-original.svg" data-plain="assets/img/tecnologias/nodejs-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="HTML5">
                                <img class="habilidades-icons" src="assets/img/tecnologias/html5-plain.svg" alt="HTML5" data-original="assets/img/tecnologias/html5-original.svg" data-plain="assets/img/tecnologias/html5-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="CSS3">
                                <img class="habilidades-icons" src="assets/img/tecnologias/css3-plain.svg" alt="CSS3" data-original="assets/img/tecnologias/css3-original.svg" data-plain="assets/img/tecnologias/css3-plain.svg">
                            </div>

                        </div>
                    </div>
                    <div class="habilidades-ferramentas-container">
                       <h2 class="font-2-lg-r">Ferramentas que utilizo no dia a dia</h2>
                        <div class="habilidades-principais-container-icons">
                            <div class="container-icons" data-tech="Git">
                                <img class="habilidades-icons" src="assets/img/tecnologias/git-plain.svg" alt="HTML5" data-original="assets/img/tecnologias/git-original.svg" data-plain="assets/img/tecnologias/git-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="GitHub">
                                <img class="habilidades-icons" src="assets/img/tecnologias/github-plain.svg" alt="HTML5" data-original="assets/img/tecnologias/github-original.svg" data-plain="assets/img/tecnologias/github-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="VS Code">
                                <img class="habilidades-icons" src="assets/img/tecnologias/vscode-plain.svg" alt="HTML5" data-original="assets/img/tecnologias/vscode-original.svg" data-plain="assets/img/tecnologias/vscode-plain.svg">
                            </div>
                            <div class="container-icons" data-tech="Figma">
                                <img class="habilidades-icons" src="assets/img/tecnologias/figma-plain.svg" alt="HTML5" data-original="assets/img/tecnologias/figma-original.svg" data-plain="assets/img/tecnologias/figma-plain.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="projetosDestaque" id="projetosDestaque">
            <h1 class="font-1-h2-b">Projetos em destaque</h1>
            <p class="font-2-lg-r">Abaixo, encontram-se alguns dos melhores projetos. Fique à vontade para visualizar e explorá-los.</p>

            <div class="projetosDestaque-container-cards">

                <!-- card completo  -->
                <div class="projetoDestaque-cards">
                    <!-- frente do card -->
                    <div class="projetoDestaque-cards-frontal">
                        <div class="projetoDestaque-cards--techs" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c6">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                            <img src="assets/img/projetos/WorldTech.jpg" alt="">
                            </div>
                    </div>

                    <!-- verso do card -->
                    <div class="projetoDestaque-cards-verso">
                        <div class="projetoDestaque-cards--techs techs-verso" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c2">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                            <div class="projetoDestaque-cards--conteudo-buttons">
                                <div class="container-btn-links-cards">
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-figma'></i>FIGMA</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-github'></i>GITHUB</a>
                                </div>
                                <div class="conteudo-buttons-link-logo">
                                    <a href="#">
                                        <img src="assets/img/projetos/logo-worldtech.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="projetoDestaque-cards--conteudo-texto">
                                <h3>Descrição</h3>
                                <p class="font-2-md-r cor-c3">A WorldTech é um site de e-commerce, ao qual foi desenvolvido em sala de aula, no período de 5 aulas, com o propósito de avaliação final do módulo em Projeto Integrador.</p>
                                <br>
                                <a href="#" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card completo  -->
                <div class="projetoDestaque-cards">
                    <!-- frente do card -->
                    <div class="projetoDestaque-cards-frontal">
                        <div class="projetoDestaque-cards--techs" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c6">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                            <img src="assets/img/projetos/WorldTech.jpg" alt="">
                        </div>
                    </div>

                    <!-- verso do card -->
                    <div class="projetoDestaque-cards-verso">
                        <div class="projetoDestaque-cards--techs techs-verso" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c2">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                            <div class="projetoDestaque-cards--conteudo-buttons">
                                <div class="container-btn-links-cards">
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxs-pointer'></i>DEPLOY</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-figma'></i>FIGMA</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-github'></i>GITHUB</a>
                                </div>
                                <div class="conteudo-buttons-link-logo">
                                    <a href="#">
                                        <img src="assets/img/projetos/logo-worldtech.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="projetoDestaque-cards--conteudo-texto">
                                <h3>Descrição</h3>
                                <p class="font-2-md-r cor-c3">A WorldTech é um site de e-commerce, ao qual foi desenvolvido em sala de aula, no período de 5 aulas, com o propósito de avaliação final do módulo em Projeto Integrador.</p>
                                <br>
                                <a href="#" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card completo  -->
                <div class="projetoDestaque-cards">
                    <!-- frente do card -->
                    <div class="projetoDestaque-cards-frontal">
                        <div class="projetoDestaque-cards--techs" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c6">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                            <img src="assets/img/projetos/WorldTech.jpg" alt="">
                        </div>
                    </div>

                    <!-- verso do card -->
                    <div class="projetoDestaque-cards-verso">
                        <div class="projetoDestaque-cards--techs techs-verso" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c2">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                            <div class="projetoDestaque-cards--conteudo-buttons">
                                <div class="container-btn-links-cards">
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxs-pointer'></i>DEPLOY</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-figma'></i>FIGMA</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-github'></i>GITHUB</a>
                                </div>
                                <div class="conteudo-buttons-link-logo">
                                    <a href="#">
                                        <img src="assets/img/projetos/logo-worldtech.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="projetoDestaque-cards--conteudo-texto">
                                <h3>Descrição</h3>
                                <p class="font-2-md-r cor-c3">A WorldTech é um site de e-commerce, ao qual foi desenvolvido em sala de aula, no período de 5 aulas, com o propósito de avaliação final do módulo em Projeto Integrador.</p>
                                <br>
                                <a href="#" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card completo  -->
                <div class="projetoDestaque-cards">
                    <!-- frente do card -->
                    <div class="projetoDestaque-cards-frontal">
                        <div class="projetoDestaque-cards--techs" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c6">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                            <img src="assets/img/projetos/WorldTech.jpg" alt="">
                        </div>
                    </div>

                    <!-- verso do card -->
                    <div class="projetoDestaque-cards-verso">
                        <div class="projetoDestaque-cards--techs techs-verso" data-name="WorldTech">
                            <p class="font-1-md-sb cor-c2">PHP MYSQL JAVASCRIPT HTML CSS BOOTSTRAP</p>
                        </div>
                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                            <div class="projetoDestaque-cards--conteudo-buttons">
                                <div class="container-btn-links-cards">
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxs-pointer'></i>DEPLOY</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-figma'></i>FIGMA</a>
                                    <a class="btn-links-cards font-1-md-l cor-c2" href="#"><i class='bx bxl-github'></i>GITHUB</a>
                                </div>
                                <div class="conteudo-buttons-link-logo">
                                    <a href="#">
                                        <img src="assets/img/projetos/logo-worldtech.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="projetoDestaque-cards--conteudo-texto">
                                <h3>Descrição</h3>
                                <p class="font-2-md-r cor-c3">A WorldTech é um site de e-commerce, ao qual foi desenvolvido em sala de aula, no período de 5 aulas, com o propósito de avaliação final do módulo em Projeto Integrador.</p>
                                <br>
                                <a href="#" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <a href="#" class="projetosDestaque-btn-visualizar-todos"><span class="material-symbols-rounded">folder_copy</span>Ver todos os projetos</a>

        </section>

        <section class="formacao">
            <div class="formacao-academica-container">
                <div class="container-titulo-formacao-academica">
                    <h1 class="font-1-h2-b cor-c3 titulo-formacao-academica">Formação acadêmica</h1>
                </div>
                <!-- container dos cards academicos -->
                <div class="formacao-academica-cards">
                    <span class="formacao-academica-linesx"></span>
                    <span class="formacao-academica-lines"></span>

                    <?php
                        while ($arrayFormacao = mysqli_fetch_assoc($consultaFormacao)) {
                            $idFormacao = $arrayFormacao['id_formacao'];
                            $nomeCursoFormacao = $arrayFormacao['nome'];
                            $instituicaoFormacao = $arrayFormacao['instituicao'];
                            $categoriaCursoFormacao = $arrayFormacao['categoria_curso'];
                            $dt_inicio = $arrayFormacao['dt_inicio'];
                            $dt_fim = $arrayFormacao['dt_fim'];
                            $caminhoImagem = $arrayFormacao['caminho'];
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
                    
                    
                    <form action="" class="form-filtro-certificados">

                        <!-- filtro certificados -->
                        <div class="filtro-certificados" role="group">
                            <button type="submit" name="categoria" value="todos" class="filtro-certificados-button">TODOS</button>
                            <button type="submit" name="categoria" value="frontEnd" class="filtro-certificados-button">FRONT-END</button>
                            <button type="submit" name="categoria" value="analiseDados" class="filtro-certificados-button">ANÁLISE DE DADOS</button>
                            <button type="submit" name="categoria" value="redesInfra" class="filtro-certificados-button">REDES E INFRA.</button>
                            <button type="submit" name="categoria" value="logicaProgramacao" class="filtro-certificados-button">ALGORIT. E LÓG. DE PROGRAMAÇÃO</button>
                        </div>

                        <!-- filtro certificados - mobile -->
                        <div class="filtro-certificados-mobile">
                            <select name="filtro-mobile-select" id="filtro-mobile-select">
                                <option value="todos">TODOS</option>
                                <option value="frontEnd">FRONT-END</option>
                                <option value="analiseDados">ANÁLISE DE DADOS</option>
                                <option value="redesInfra">REDES E INFRA.</option>
                                <option value="logicaProgramacao">ALGORIT. E LÓG. DE PROGRAMAÇÃO</option>
                            </select>
                            <button type="submit" class="filtro-mobile-button">Filtrar</button>
                        </div>

                    </form>

                    <!-- container dos cards certificados -->
                    <div class="certificados-cards">
                        <?php 

                            while ($resultado = mysqli_fetch_assoc($consulta)) {
                                $idFormacao = $resultado['id_formacao'];
                                $nomeCurso = $resultado['nome'];
                                $instituicao = $resultado['instituicao'];
                                $categoriaCurso = $resultado['categoria_curso'];
                                $totalHoras = $resultado['total_horas'];
                                $dt_fim = $resultado['dt_fim'];
                                $caminhoImagem = $resultado['caminho'];
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

    </main>

<script src="script.js"></script>

</body>
</html>