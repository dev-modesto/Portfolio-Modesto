<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    
    if (isset($_POST['click-editar-formacao'])) {
        $id = $_POST['idPrincipal'];

        $sql = "SELECT * FROM tbl_formacao WHERE id_formacao = '$id'";
        $consult = mysqli_query($con, $sql);
        $array = mysqli_fetch_assoc($consult);
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

<!-- modal editar formação -->
<div class="modal modalEditarFormacao modal-lg fade" id="modalEditarFormacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarFormacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Cadastrar projeto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form class="form-container" action="include/aFormacao.php" method="post">
                <input type="text" name="id" id="id" value="<?php echo $id ?>" hidden>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="nome-formacao">Nome formação <em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-formacao" id="nome-formacao" value="<?php echo $nome ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" class="font-1-s" for="area-formacao">Área formação <em>*</em></label><br>
                        <select class="form-select" name="area-formacao" id="area-formacao" required>
                            <option value="">Escolha a área de formação</option>
                            <?php 
                                $sql = "SELECT * FROM tbl_area_formacao";
                                $consulta = mysqli_query($con, $sql);
                                
                                while($row = mysqli_fetch_assoc($consulta)){
                                    $selected = $row['id_area_formacao'] == $idAreaFormacao ? 'selected' : '';
                                    echo "<option value='" . $row['id_area_formacao'] . "' $selected >" . $row['nome'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="instituicao-ensino">Instituição de ensino <em>*</em></label><br>
                    <input class="form-control" type="text" name="instituicao-ensino" id="instituicao-ensino" value="<?php echo $instituicao ?>" required>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="data-inicio">Data Inicio</label><br>
                        <input class="form-control" type="date" name="data-inicio" id="data-inicio" value="<?php echo $dtInicio ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="font-1-s" for="data-fim">Data Fim</label><br>
                        <input class="form-control" type="date" name="data-fim" id="data-fim" value="<?php echo $dtConclusao ?>">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="categoria-curso">Categoria do Curso <em>*</em></label><br>
                        <select class="form-select" name="categoria-curso" id="" required >
                            <option value="">Escolha a categoria do curso</option>
                            <option value="Curso Livre" <?php echo ($categoriaCurso == 'Curso livre') ? 'selected' : ''; ?>>Curso Livre</option>
                            <option value="Técnico" <?php echo ($categoriaCurso == 'Técnico') ? 'selected' : ''; ?>>Técnico</option>
                            <option value="Tecnólogo" <?php echo ($categoriaCurso == 'Tecnólogo') ? 'selected' : ''; ?>>Tecnólogo</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" for="total-horas">Total horas <em>*</em></label><br>
                        <input class="form-control" type="text" name="total-horas" id="total-horas" value="<?php echo $totalHoras ?>" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="img-formacao">Imagem <em>*</em></label><br>
                    <select class="form-select" name="img-formacao" id="img-formacao">
                        <option value="" selected>Escolha a imagem</option>
                        <?php 
                            $sql = "SELECT * FROM tbl_imagem";
                            $consulta = mysqli_query($con, $sql);
                            
                            while($row = mysqli_fetch_assoc($consulta)){
                                $selectedImg = $row['id_imagem'] == $idImagem ? 'selected' : '';
                                echo "<option value='" . $row['id_imagem'] . "' $selectedImg >" . $row['nome'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="link-certificado">Link Certificado</label><br>
                    <input class="form-control" type="text" name="link-certificado" id="link-certificado" value="<?php echo $linkCertificado ?>">
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="status-curso">Status <em>*</em></label><br>
                    <select class="form-select" name="status" id="" required>
                        <option value="">Defina um status</option>
                        <option value="Concluído" <?php echo ($status == 'Concluído') ? 'selected' : '' ?>>Concluído</option>
                        <option value="Andamento" <?php echo ($status == 'Andamento') ? 'selected' : ''?>>Andamento</option>
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
