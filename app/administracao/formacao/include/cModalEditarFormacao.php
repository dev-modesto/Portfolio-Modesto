<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
    
    if (isset($_POST['click-editar-formacao'])) {
        $id = $_POST['idPrincipal'];

        $cFormacacaoAcademica = cFormacaoAcademica($con, $id);
        $array = mysqli_fetch_assoc($cFormacacaoAcademica);
        $nome = $array['nome'];
        $idAreaFormacao = $array['id_area_formacao'];
        $instituicao = $array['instituicao'];
        $dtInicio = $array['dt_inicio'];
        $dtConclusao = $array['dt_fim'];
        $categoriaCurso = $array['categoria_curso'];
        $totalHoras = $array['total_horas'];
        $idImagem = $array['id_imagem'];
        $linkCertificado = $array['link_certificado'];
        $status = $array['status'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal modalEditarFormacao modal-lg fade" id="modalEditarFormacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarFormacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Editar formação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form class="form-container" action="include/aFormacao.php" method="post">
                <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="nome-formacao-editar">Nome formação <em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-formacao" id="nome-formacao-editar" value="<?= $nome ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" class="font-1-s" for="area-formacao-editar">Área formação <em>*</em></label><br>
                        <select class="form-select" name="area-formacao" id="area-formacao-editar" required>
                            <?php 

                                $consultaAreaFormacao = cAreaFormacao($con);
                                while($row = mysqli_fetch_assoc($consultaAreaFormacao)){
                                    $selected = $row['id_area_formacao'] == $idAreaFormacao ? 'selected' : '';
                                    echo "<option value='" . $row['id_area_formacao'] . "' $selected >" . $row['nome'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="instituicao-ensino-editar">Instituição de ensino <em>*</em></label><br>
                    <input class="form-control" type="text" name="instituicao-ensino" id="instituicao-ensino-editar" value="<?= $instituicao ?>" required>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="data-inicio-editar">Data Inicio</label><br>
                        <input class="form-control" type="date" name="data-inicio" id="data-inicio-editar" value="<?= $dtInicio ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="font-1-s" for="data-fim-editar">Data Fim</label><br>
                        <input class="form-control" type="date" name="data-fim" id="data-fim-editar" value="<?= $dtConclusao ?>">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="categoria-curso-editar">Categoria do Curso <em>*</em></label><br>
                        <select class="form-select" name="categoria-curso" id="categoria-curso-editar" required >
                            <option value="Acadêmico" <?= ($categoriaCurso == 'Acadêmico') ? 'selected' : ''; ?>>Acadêmico</option>
                            <option value="Curso Livre" <?= ($categoriaCurso == 'Curso livre') ? 'selected' : ''; ?>>Curso Livre</option>
                            <option value="Técnico" <?= ($categoriaCurso == 'Técnico') ? 'selected' : ''; ?>>Técnico</option>
                            <option value="Tecnólogo" <?= ($categoriaCurso == 'Tecnólogo') ? 'selected' : ''; ?>>Tecnólogo</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" for="total-horas-editar">Total horas <em>*</em></label><br>
                        <input class="form-control" type="text" name="total-horas" id="total-horas-editar" value="<?= $totalHoras ?>" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="img-formacao-editar">Imagem <em>*</em></label><br>
                    <select class="form-select" name="img-formacao" id="img-formacao-editar" required>
                        <?php 
                            $categoriaImagem = ['instituicao'];
                            $consultaImagens = cImagens($con, null, $categoriaImagem);
                            
                            while($row = mysqli_fetch_assoc($consultaImagens)){
                                $selectedImg = $row['id_imagem'] == $idImagem ? 'selected' : '';
                                echo "<option value='" . $row['id_imagem'] . "' $selectedImg >" . $row['nome_titulo'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="link-certificado-editar">Link Certificado</label><br>
                    <input class="form-control" type="text" name="link-certificado" id="link-certificado-editar" value="<?= $linkCertificado ?>">
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="status-curso-editar">Status <em>*</em></label><br>
                    <select class="form-select" name="status" id="status-curso-editar" required>
                        <option value="Andamento" <?= ($status == 'Andamento') ? 'selected' : ''?>>Andamento</option>
                        <option value="Concluído" <?= ($status == 'Concluído') ? 'selected' : '' ?>>Concluído</option>
                    </select>
                </div>

                <div class="modal-footer form-container-button">
                    <button type="button" class="col btn btn-secondary btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                    <button class='col btn btn-primary' type="submit">Salvar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
