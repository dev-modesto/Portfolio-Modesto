<?php 
    include '../../config/base.php';

    include BASE_PATH . '/include/funcoes/calendarioData/data.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';

    if (isset($_POST['click-btn-filtrar'])) {
        $idFiltro = $_POST['idFiltro'];
            
        $categorias = ['Curso Livre', 'Acadêmico'];
        $cFormacaoAcademica = cFormacaoAcademica($con, null, $idFiltro, $categorias);

        foreach($cFormacaoAcademica as $chave => $resultado) {
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
                <div class="card-formacao" data-tag-name-course="<?= $categoriaCurso ?>" onclick="telaTouchCardFormacao(event, this)">
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
                                        <a href="<?= $linkCertificadoCurso ?>" target="_blank" rel="noopener noreferrer"><span class="material-symbols-rounded">workspace_premium</span>VISUALIZAR CERTIFICADO</a>
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
        
    } else {
        header("Location: index.php");
    }
?>