<?php 
    include_once 'config/base.php';
    include_once BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    include_once BASE_PATH . '/include/funcoes/db-queries/tecnologia.php';

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
<?php 
     }
?>