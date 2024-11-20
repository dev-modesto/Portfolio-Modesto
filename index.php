<?php
    include 'config/base.php';

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
        $login = isset($_SESSION['login']) ? $_SESSION['login'] : '';
    }

    $visibilidade = $login == null ? 'Publico' : null;

    include BASE_PATH . '/include/funcoes/calendarioData/data.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/dbQuery/tecnologia.php';
    include BASE_PATH . '/include/filtros/filtros.php';
    include BASE_PATH . "/include/header/headerPagIndex.php";

?>
    <main>
        <section class="home js-scroll">
            <div class="home-info order2">
                <div class="texto-home">
                    <h1 class="font-1-h1-b">Web Developer Front End</h1>
                    <p class="font-1-xxl-1">Me chamo <strong>Gabriel Modesto</strong> e eu sou fascinado por desenvolver interfaces web.</p>
                </div>
                <div class="icones-sociais">
                    <a class="cor-c6" aria-label="Perfil do Linkedin" href="https://www.linkedin.com/in/gabrielm-oliveira/"><i class='bx bxl-linkedin'></i></a>
                    <a class="cor-c6" aria-label="Perfil do GitHub" href="https://github.com/dev-modesto"><i class='bx bxl-github'></i></a>
                    <a class="cor-c6" aria-label="Endereço de e-mail para contato" href="mailto:contato@devmodesto.com.br"><i class='bx bxs-envelope'></i></a>
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
                                        <div class="container-icons" data-tech="<?= $nomeTec ?>">
                                            <img class="habilidades-icons" src="<?= BASE_URL . $caminhoPlainTec ?>" alt="<?= 'imagem do icone da tecnologia ' . $nomeTec?>" data-original="<?= BASE_URL . $caminhoOriginalTec ?>" data-plain="<?= BASE_URL . $caminhoPlainTec ?>">
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
                                        <div class="container-icons" data-tech="<?= $nomeFerramenta ?>">
                                            <img class="habilidades-icons" src="<?= BASE_URL . $caminhoPlainFerramenta ?>" alt="<?= 'imagem do icone da tecnologia ' . $nomeFerramenta?>" data-original="<?= BASE_URL . $caminhoOriginalFerramenta ?>" data-plain="<?= BASE_URL . $caminhoPlainFerramenta ?>">
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

                    $cProjeto = cProjeto($con, null, null, null, 'Sim', $visibilidade, 'Ativo');

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
                            $visibilidadeProjeto = $arrayProjeto['visibilidade'];

                            $tipoImagemProjeto = ['thumbnail'];
                            $cProjetoImagemProjeto = cProjetoImagem($con, $idProjeto, 'projeto', $tipoImagemProjeto);
                            $qntImgThumbnail = mysqli_num_rows($cProjetoImagemProjeto);
                            $caminhoOriginal = '/assets/img/outros/nao-encontrado-img-thumbnail.svg';
                            $textoAlternativo = 'imagem thumbnail não encontrada';

                            $tipoImagemLogo = ['logo'];
                            $cProjetoImagemLogo = cProjetoImagem($con, $idProjeto, 'projeto', $tipoImagemLogo);
                            $qntImgLogo= mysqli_num_rows($cProjetoImagemLogo);
                            $caminhoOriginalLogo = '/assets/img/outros/nao-encontrado-img-logo.svg';
                            $textoAlternativoLogo = 'imagem logo não encontrada';
                            
                            if ($qntImgThumbnail !== 0) {
                                $arrayImagensProjeto = mysqli_fetch_assoc($cProjetoImagemProjeto);
                                $caminhoOriginal = $arrayImagensProjeto['caminho_original'];
                                $textoAlternativo = $arrayImagensProjeto['texto_alt'];
                            } 
                            
                            if ($qntImgLogo !== 0) {
                                $arrayImagemLogoProjeto = mysqli_fetch_assoc($cProjetoImagemLogo);
                                $caminhoOriginalLogo = $arrayImagemLogoProjeto['caminho_original'];
                                $textoAlternativoLogo = $arrayImagemLogoProjeto['texto_alt'];
                            }

                            ?>
                                <div class="projetoDestaque-cards <?= $visibilidadeProjeto == 'Administrador' ? 'visibilidade-administrador' : '' ?> ">
                                    <div class="projetoDestaque-cards-frontal">
                                        <div class="tec-etiqueta" data-name="<?= $nomeProjeto ?>">
                                            <p class="font-1-md-sb cor-c2">Tecs. utilizadas</p>
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
                                        <div class="projetoDestaque-cards--conteudo conteudo-img">
                                            <img src="<?= BASE_URL . $caminhoOriginal ?>" alt="<?= $textoAlternativo ?>">
                                        </div>
                                    </div>

                                    <div class="projetoDestaque-cards-verso">
                                        <div class="tec-etiqueta techs-verso" data-name="<?= $nomeProjeto ?>">
                                            <p class="font-1-md-sb cor-c2">Tecs. utilizadas</p>
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
                                        <div class="projetoDestaque-cards--conteudo conteudo-card-verso">
                                            <div class="projetoDestaque-cards--conteudo-buttons">
                                                <div class="container-btn-links-cards">
                                                    <?php 
                                                        if (!$linkDeploy == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?= $linkDeploy ?>"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                                            <?php
                                                        }
                                                        
                                                        if (!$linkFigma == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?= $linkFigma ?>"><i class='bx bxl-figma'></i>FIGMA</a>
                                                            <?php
                                                        }
                                                        
                                                        if (!$linkRepositorio == "") {
                                                            ?>
                                                                <a class="btn-links-cards font-1-md-l cor-c2" href="<?= $linkRepositorio ?>"><i class='bx bxl-github'></i>GITHUB</a>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="container-buttons-link-logo">
                                                    <div class="conteudo-buttons-link-logo">
                                                        <a href="#">
                                                            <img src="<?= BASE_URL . $caminhoOriginalLogo ?>" alt="<?= $textoAlternativoLogo ?>" width="90" height="90">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="projetoDestaque-cards--conteudo-texto">
                                                <div class="conteudo-texto">
                                                    <h3>Descrição</h3>
                                                    <p class="font-2-md-r descricao-destaque cor-c3"><?= $descricao ?></p>
                                                </div>
                                                <div class="container-button-saiba-mais">
                                                    <a href="projetos.php" class="font-2-md-r cor-p3">Saiba mais em todos os projetos</a>
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

            <a href="projetos.php" class="projetosDestaque-btn-visualizar-todos"><span class="material-symbols-rounded">folder_copy</span>Ver todos os projetos</a>

        </section>

        <section class="formacao js-scroll" id="formacao">
            <div class="formacao-academica-container">
                <div class="container-titulo-formacao-academica">
                    <h1 class="font-1-h2-b cor-c3 titulo-formacao-academica">Formação acadêmica</h1>
                </div>

                <div class="formacao-academica-cards">
                    <span class="formacao-academica-linesx"></span>
                    <span class="formacao-academica-lines"></span>

                    <?php

                        $categorias = ['Tecnólogo', 'Técnico'];
                        $cFormacaoAcademica = cFormacaoAcademica($con, null, null, $categorias);
                        foreach ($cFormacaoAcademica as $chave => $arrayFormacao) {
                  
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
                                <div class="card-formacao card-grid-academico" data-tag-name-course="<?= $categoriaCursoFormacao ?>">
                                    <div class="card-formacao-frontal">
                                        <div class="card-formacao-img-logo">
                                            <img src="<?= BASE_URL . $caminhoImagem ?>" alt="">
                                        </div>
                                        <div class="card-formacao-texto">
                                            <p class="card-formacao--instituicao"><?= $instituicaoFormacao ?></p>
                                            <h3 class="card-formacao--curso"><?= $nomeCursoFormacao ?></h3>
                                            <div class="card-formacao-periodo">
                                                <p class="card-formacao-periodo--inicio"><?= $dataFormacaoInicioFormatada ?> - <?= $dataFormacaoFimFormatada ?> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-formacao-verso">
                                        <div class="card-formacao-verso--status">
                                            <?php 
                                                if ($status == 'Concluído') {
                                                    ?>
                                                        <a href="<?= $linkDiploma ?>"><span class="material-symbols-rounded">school</span>VISUALIZAR DIPLOMA</a>    
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
                                        <span class="material-symbols-rounded <?= $classe ?>"><?= $icone ?></span>
                                    </div>
                                </div>
                            
                            <?php
                        }
                    ?>
                </div>

                <div class="formacao-academica-container-certificados">
                    <h1 class="font-1-h2-b cor-c3">Certificados</h1>
                    
                    <form class="form-filtro-certificados" id="filtrar-certificados">
                        <?php 
                            filtroCertificadosDesk($con);
                            filtroCertificadosMobile($con);
                        ?>
                    </form>

                    <div class="certificados-cards">
                        <?php 

                            $categorias = ['Curso Livre', 'Acadêmico'];
                            $cFormacaoAcademica = cFormacaoAcademica($con, null, null, $categorias);
                            foreach ($cFormacaoAcademica as $chave => $resultado) {

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
                                    <div class="card-formacao" data-tag-name-course="<?= $categoriaCurso ?>">
                                        <div class="card-formacao-frontal">
                                            <div class="card-formacao-img-logo">
                                                <img src="<?= BASE_URL . $caminhoImagem ?>" alt="">
                                            </div>
                                            <div class="card-formacao-texto">
                                                <p class="card-formacao--instituicao"><?= $instituicao ?></p>
                                                <h3 class="card-formacao--curso"><?= $nomeCurso ?></h3>
                                                <div class="card-formacao-periodo">
                                                    <p class="card-formacao-periodo--conclusao"><?= $dataCertificadoConclusao ?></p>
                                                </div>
                                                <p class="card-formacao-horas"><?= $totalHoras ?> horas</p>
                                            </div>
                                        </div>

                                        <div class="card-formacao-verso">
                                            <div class="card-formacao-verso--status">
                                                <?php 
                                                    if ($status == 'Concluído') {
                                                        ?>
                                                            <a href="<?= $linkCertificadoCurso ?>"><span class="material-symbols-rounded">workspace_premium</span>VISUALIZAR CERTIFICADO</a>
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
                                            <span class="material-symbols-rounded <?= $classe ?>"><?= $icone ?></span>
                                        </div>
                                    </div>
                                
                                <?php
                            }                            
                        ?>
                    </div>
                
                </div>

            </div>

        </section>

        <?php
            include BASE_PATH . "/include/footer/footer.php";
            include BASE_PATH . "/include/footer/footerScripts.php";
        ?>
    </main>

    <script src="js/animacoes.js"></script>

    <script>

        document.addEventListener("DOMContentLoaded", function() {

            function mudarSrcImagensHabilidades() {
                const icons = document.querySelectorAll(".habilidades-icons");
                
                icons.forEach(icon => {
                    icon.addEventListener("mouseover", function() {
                        this.src = this.getAttribute("data-original");
                    });

                    icon.addEventListener("mouseout", function() {
                        this.src = this.getAttribute("data-plain");
                    });
                    
                });
            }

            mudarSrcImagensHabilidades();

        });

    </script>

</body>
</html>