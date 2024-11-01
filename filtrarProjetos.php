<?php 
    include_once 'config/base.php';
    include_once BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include_once BASE_PATH . '/include/funcoes/dbQuery/tecnologia.php';
    include_once BASE_PATH . '/include/funcoes/dbQuery/autor.php';

    $idCategoria = 0;

    if (isset($_POST['click-btn-filtro-projeto'])) {
        $idCategoria = $_POST['idCategoria'];
   
        $cProjeto = cProjeto($con, null, $idCategoria, null, null, 'Ativo');
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
                            <div class="accordion-titulo">Tecnologias utilzadas<span class="material-symbols-rounded btn-accordion">keyboard_arrow_down</span></div>
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
                                                <p class="font-1-sm-r"><?= $nomeTecnologia ?></p>
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
                                <p class="font-1-md-l"><?php echo $statusProgresso == 'Andamento' ? 'Projeto em andamento' : $dtDesenvolvimentoFormatada ?></p>
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
                                            <a class="" href="<?= $linkLinkedin?>" aria-disabled="<?php echo $linkLinkedin == '' ? 'true' : 'false' ?>">
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
<?php 
     }
?>