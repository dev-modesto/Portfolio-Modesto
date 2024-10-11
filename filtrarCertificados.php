<?php 
    include 'config/base.php';
    include_once FUNCAO_DATA;

    $and = "";

    if (isset($_POST['click-btn-filtrar'])) {
        $idFiltro = $_POST['idFiltro'];
        
        if ($idFiltro != 0 ) {
            $and = "AND a.id_area_formacao = '$idFiltro'";
        }
    } 

    $sql = "SELECT 
        f.id_formacao, 
        f.nome, 
        f.id_area_formacao,
        f.instituicao, 
        f.categoria_curso,
        f.dt_inicio, 
        f.dt_fim, 
        f.id_imagem,
        f.total_horas,
        i.caminho_original,
        f.link_certificado,
        f.status
        FROM tbl_formacao f 
        INNER JOIN tbl_imagem i
        ON f.id_imagem = i.id_imagem
        INNER JOIN tbl_area_formacao a
        ON f.id_area_formacao = a.id_area_formacao
        WHERE f.categoria_curso = 'Curso Livre' $and
    ";

    $consulta = mysqli_query($con, $sql);

    while ($resultado = mysqli_fetch_assoc($consulta)) {

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
            <div class="card-formacao" data-tag-name-course="<?= $categoriaCurso ?>">

                <!-- card frontal -->
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

                <!-- card verso -->
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