<?php
    include 'config/base.php';

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
        $login = isset($_SESSION['login']) ? $_SESSION['login'] : '';
    }

    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/tecnologia.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    include BASE_PATH . '/include/filtros/filtros.php';
    include BASE_PATH . '/include/header/headerPagProjetos.php';

?>

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
                    $visibilidade = $login == null ? 'Publico' : null;
                    $cProjeto = cProjeto($con, null, null, null, null, $visibilidade, 'Ativo');
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
                            $descricaoFuncionalidades = $valorProjeto['descricao_funcionalidades'];
                            $descricaoTipoProjeto = $valorProjeto['descricao_tipo_projeto'];
                            $tipoProjeto = $valorProjeto['tipo_projeto'];
                            $dtDesenvolvimento = $valorProjeto['dt_desenvolvimento'];

                            $newDtDesenvolvimento = new DateTime($dtDesenvolvimento);
                            $dtDesenvolvimentoFormatada = date_format($newDtDesenvolvimento, 'd/m/Y');

                            $linkDeploy = $valorProjeto['link_deploy'];
                            $linkFigma = $valorProjeto['link_figma'];
                            $linkRepositorio = $valorProjeto['link_repositorio'];
                            $statusProgresso = $valorProjeto['status'];
                            $visibilidadeProjeto = $valorProjeto['visibilidade'];

                            $tipoImagem = ['thumbnail', 'extra'];
                            $cProjetoImagem = cProjetoImagem($con, $idProjeto, null, $tipoImagem);
                            $arrayImagens = mysqli_fetch_all($cProjetoImagem, MYSQLI_ASSOC);
                            $imagemThumbnail = [];
                            $imagensExtras = [];

                            foreach ($arrayImagens as $valor) {
                                if ($valor['tipo_imagem'] === 'thumbnail') {

                                    $imagemThumbnail[] = [
                                        'caminho' => BASE_URL . $valor['caminho_original'],
                                        'tipo' => $valor['tipo_imagem']
                                    ];

                                } else {
                                    
                                    $imagensExtras[] = [
                                        'caminho' => BASE_URL . $valor['caminho_original'],
                                        'tipo' => $valor['tipo_imagem']
                                    ];
                                }
                            }

                            $imagens = [];

                            if ($imagemThumbnail) {
                                $imagens = array_merge($imagemThumbnail);
                            }

                            $imagens = array_merge($imagens, $imagensExtras);

                            $indiceProjetoFormatado = str_pad($indiceProjeto, 2, '0', STR_PAD_LEFT);

                            $cAutorProjeto = cAutorProjeto($con, $idProjeto);
                            $consultaAutorProjeto = mysqli_fetch_all($cAutorProjeto, MYSQLI_ASSOC);

                            ?>

                            <div class="container-card-projeto-completo js-scroll <?= $visibilidadeProjeto == 'Administrador' ? 'visibilidade-administrador' : '' ?>">
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
                                        <button class="btn-img-ant btn-img-prevnext" onclick="prevImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_left</span></button>
                                        <img id="imagem-projeto-<?= $indiceProjeto ?>" src="<?= $imagens[0]['caminho'] ?>" alt="">
                                        <button class="btn-img-prox btn-img-prevnext" onclick="nextImage(<?= $indiceProjeto ?>)"><span class="material-symbols-rounded">chevron_right</span></a>
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
                                        <?php

                                            if (strlen($descricaoFuncionalidades) > 0) {
                                                ?>
                                                    <div class="accordion-container">
                                                        <div class="accordion-titulo font-2-md-r">Funcionalidades do projeto<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                                        <div class="accordion-conteudo">
                                                            <p class="font-2-md-r peso-normal p-legenda"><?= $descricaoFuncionalidades ?></p>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        
                                        ?>
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
                                                <p class="font-2-md-r peso-normal p-legenda"><span class="legenda-bg status-0"><?= $tipoProjeto ?></span><br><?= $descricaoTipoProjeto ?></p>
                                            </div>
                                        </div>
                                        <div class="accordion-container">
                                            <div class="accordion-titulo font-2-md-r">Data de desenvolvimento<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
                                            <div class="accordion-conteudo">
                                                <p class="font-2-md-r peso-normal p-legenda"><span class="legenda-bg <?= $statusProgresso == 'Andamento' ? 'status-2' : 'status-1'?>"><?php echo $statusProgresso == 'Andamento' ? 'Projeto em andamento' : 'Concluído em: ' . $dtDesenvolvimentoFormatada ?></span></p>
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
                                                            <a class="font-2-md-r peso-normal" href="<?= $linkLinkedin == '' ? '#' : $linkLinkedin ?>" target="_blank" rel="noopener noreferrer" aria-disabled="<?php echo $linkLinkedin == '' ? 'true' : 'false' ?>">
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
                                                    <a class="btn-links-cards projetos deploy font-1-md-l cor-c12" href="<?= $linkDeploy ?>" target="_blank" rel="noopener noreferrer"><i class='bx bxs-pointer '></i>DEPLOY</a>
                                                <?php
                                            }
                                            
                                            if (!$linkFigma == "") {
                                                ?>
                                                    <a class="btn-links-cards projetos font-1-md-l cor-c12" href="<?= $linkFigma ?>" target="_blank" rel="noopener noreferrer"><i class='bx bxl-figma'></i>FIGMA</a>
                                                <?php
                                            }
                                            
                                            if (!$linkRepositorio == "") {
                                                ?>
                                                    <a class="btn-links-cards projetos font-1-md-l cor-c12" href="<?= $linkRepositorio ?>" target="_blank" rel="noopener noreferrer"><i class='bx bxl-github'></i>GITHUB</a>
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
        
        <?php
            include BASE_PATH . "/include/footer/footer.php";
            include BASE_PATH . "/include/footer/footerScripts.php";
        ?>
    </main>

    <script src="<?= BASE_URL . '/js/imagensProjetos.js'?>"></script>
    <script src="<?= BASE_URL . '/js/accordion.js'?>"></script>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            initAccordion();
        });

    </script>

</body>
</html>