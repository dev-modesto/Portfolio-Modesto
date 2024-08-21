<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    
    if (isset($_POST['click-editar-projeto'])) {
        $id = $_POST['idPrincipal'];

        $sql = "SELECT * FROM tbl_projeto WHERE id_projeto = '$id'";
        $consult = mysqli_query($con, $sql);
        $array = mysqli_fetch_assoc($consult);
        $nomeProjeto = $array['nome_projeto'];
        $descricaoProjeto = $array['descricao'];
        $descricaoTipoProjeto = $array['descricao_tipo_projeto'];
        $tipoProjeto = $array['tipo_projeto'];
        $dtLancamento = $array['dt_desenvolvimento'];
        $idImagem = $array['id_imagem'];
        $linkDeploy = $array['link_deploy'];
        $linkFigma = $array['link_figma'];
        $linkRepositorio = $array['link_repositorio'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal modalEditarProjeto modal-lg fade" id="modalEditarProjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarProjeto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarProjeto">Editar projeto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form class="form-container" action="include/aProjeto.php" method="post">
                <input type="text" name="id" id="id" value="<?php echo $id ?>" hidden>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s nome-projeto" for="nome-formacao">Nome projeto <em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-projeto" id="nome-projeto" value="<?php echo $nomeProjeto ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" class="font-1-s" for="tipo-projeto">Tipo projeto <em>*</em></label>
                        <select class="form-select" name="tipo-projeto" id="tipo-projeto" required>
                            <option value="" selected>Escolha o tipo de projeto</option>
                            <option value="Livre" <?php echo $tipoProjeto == 'Livre' ? 'selected' : '' ?>>Livre</option>
                            <option value="Acadêmico" <?php echo $tipoProjeto == 'Acadêmico' ? 'selected' : '' ?>>Acadêmico</option>
                            <option value="Profissional" <?php echo $tipoProjeto == 'Profissional' ? 'selected' : '' ?>>Profissional</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <label class="font-1-s" for="data-desenvolvimento">Data desenvolvimento <em>*</em></label><br>
                        <input class="form-control" type="date" name="data-desenvolvimento" id="data-desenvolvimento" value="<?php echo $dtLancamento ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" for="img-formacao">Imagem <em>*</em></label>
                        <select class="form-select" name="img-formacao" id="img-formacao">
                            <option value="" selected>Escolha a imagem</option>
                            <?php 
                                $sql = "SELECT * FROM tbl_imagem WHERE categoria = 'projeto'";
                                $consulta = mysqli_query($con, $sql);
                                
                                while($row = mysqli_fetch_assoc($consulta)){
                                    $selected = $row['id_imagem'] == $idImagem ? 'selected' : '';
                                    echo "<option value='" . $row['id_imagem'] . "' $selected >" . $row['nome'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                    <textarea class="form-control descricao-projeto" name="descricao-projeto" id="descricao-projeto"><?php echo $descricaoProjeto ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                    <textarea class="form-control" name="descricao-tipo-projeto" id="descricao-tipo-projeto"><?php echo $descricaoTipoProjeto ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="link-deploy">Link Deploy</label>
                    <input class="form-control" type="text" name="link-deploy" id="link-deploy" value="<?php echo $linkDeploy ?>">
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="link-figma">Link Figma</label>
                    <input class="form-control" type="text" name="link-figma" id="link-figma" value="<?php echo $linkFigma ?>">
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="link-repositorio">Link repositório Github</label>
                    <input class="form-control" type="text" name="link-repositorio" id="link-repositorio" value="<?php echo $linkRepositorio ?>">
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
