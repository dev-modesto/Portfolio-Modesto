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
                <form class="form-container" id="form-projeto" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" id="id" value="<?php echo $id ?>" hidden>
                    <input type="hidden" name="tecnologias" id="tecnologias" value="">
                    <input type="hidden" name="id-projeto" id="id-projeto" value="1">

                    <ul class="nav nav-underline">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dados-pessoais-cliente-tab-editar" data-bs-toggle="tab" data-bs-target="#dados-pessoais-cliente-tab-editar-pane" type="button" role="tab" aria-controls="dados-pessoais-cliente-tab-editar-pane" aria-selected="true">Dados pessoais</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="links-projeto-editar" data-bs-toggle="tab" data-bs-target="#links-projeto-editar-pane" type="button" role="tab" aria-controls="links-projeto-editar-pane" aria-selected="false">Links</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-tecnologias-tab-editar" data-bs-toggle="tab" data-bs-target="#tab-tecnologias-tab-editar-pane" type="button" role="tab" aria-controls="tab-tecnologias-tab-editar-pane" aria-selected="false">Tecnologias</button>
                        </li>
                    </ul>
                    <br>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="dados-pessoais-cliente-tab-editar-pane" role="tabpanel" aria-labelledby="dados-pessoais-cliente-tab-editar" tabindex="0">
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
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="imagem-projeto">Imagem do projeto <em>*</em></label>
                                <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto" required>
                            </div>

                            <div class="mb-4">
                                <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                                <textarea class="form-control descricao-projeto" name="descricao-projeto" id="descricao-projeto"><?php echo $descricaoProjeto ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                                <textarea class="form-control" name="descricao-tipo-projeto" id="descricao-tipo-projeto"><?php echo $descricaoTipoProjeto ?></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="links-projeto-editar-pane" role="tabpanel" aria-labelledby="links-projeto-editar" tabindex="0">
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
                        </div>

                        <div class="tab-pane fade" id="tab-tecnologias-tab-editar-pane" role="tabpanel" aria-label="tab-tecnologias" tabindex="0">
                            <?php 

                                $sql = 
                                    "SELECT 
                                    t.id_tecnologia,
                                    t.nome,
                                    t.id_imagem,
                                    i.caminho_original
                                    FROM tbl_tecnologia t
                                    INNER JOIN tbl_imagem i
                                    ON t.id_imagem = i.id_imagem
                                ";
                                        
                                $consulta = mysqli_query($con, $sql);

                                ?>
                                    <div class="container-tecnologias">
                                <?php

                                        while ($row = mysqli_fetch_assoc($consulta)) {
                                            $idTecnologia = $row['id_tecnologia'];
                                            $nome = $row['nome'];
                                            $idImagem = $row['id_imagem'];
                                            $caminhoImagem = $row['caminho_original'];
                                            ?>
                                            
                                                <div class="container-imagem-tecnologia" data-id-tecnologia="<?php echo $idTecnologia ?>">
                                                    <img src="<?php echo BASE_URL . $caminhoImagem ?>" alt="">
                                                </div>
                                                
                                            <?php
                                        }

                                        ?>
                                    </div>
                                <?php
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer form-container-button">
                        <button type="button" class="col btn btn-secondary btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button class='col btn btn-primary' type="submit">Cadastrar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
