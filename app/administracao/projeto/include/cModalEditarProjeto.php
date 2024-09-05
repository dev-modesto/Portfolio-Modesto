<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    include BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    
    if (isset($_POST['click-editar-projeto'])) {
        $idProjeto = $_POST['idPrincipal'];

        $cProjeto = cProjetoEspecifico($con, $idProjeto);
        $arrayProjeto = mysqli_fetch_assoc($cProjeto);

        $nomeProjeto = $arrayProjeto['nome_projeto'];
        $descricaoProjeto = $arrayProjeto['descricao'];
        $descricaoTipoProjeto = $arrayProjeto['descricao_tipo_projeto'];
        $tipoProjeto = $arrayProjeto['tipo_projeto'];
        $dtLancamento = $arrayProjeto['dt_desenvolvimento'];
        $linkDeploy = $arrayProjeto['link_deploy'];
        $linkFigma = $arrayProjeto['link_figma'];
        $linkRepositorio = $arrayProjeto['link_repositorio'];
        $projetoDestaque = $arrayProjeto['destaque'];
        $statusGeral = $arrayProjeto['status_geral'];
        $statusProgresso = $arrayProjeto['status'];

        $cProjetoImagemProjeto = cProjetoImagem($con,$idProjeto,'projeto');
        $arrayImagensProjeto = mysqli_fetch_assoc($cProjetoImagemProjeto);
        $caminhoOriginal = $arrayImagensProjeto['caminho_original'];
        $textoAlternativo = $arrayImagensProjeto['texto_alt'];

        $cProjetoImagemLogo = cProjetoImagem($con, $idProjeto, 'logo');
        $arrayImagemLogoProjeto = mysqli_fetch_assoc($cProjetoImagemLogo);
        $caminhoOriginalLogo = $arrayImagemLogoProjeto['caminho_original'];

        $sqlConsultaTecProjeto = "SELECT id_tecnologia FROM tbl_tecnologia_projeto WHERE id_projeto = '$idProjeto'";
        $consultaTecProjeto = mysqli_query($con, $sqlConsultaTecProjeto);

        $arrayTecProjeto = [];
        
        while ($arrayProjetoTec = mysqli_fetch_assoc($consultaTecProjeto)) {
            $arrayTecProjeto[] = $arrayProjetoTec['id_tecnologia'];
        }

        $tecnologiasId = implode(',', $arrayTecProjeto);


    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal modal-lg fade modalEditarProjeto" id="modalEditarProjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarProjeto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar projeto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" id="form-projeto-editar" enctype="multipart/form-data">
                    <input type="text" name="id" id="id" value="<?php echo $idProjeto ?>" hidden>
                    <input type="hidden" name="tecnologias-editar" id="tecnologias-editar" value="<?php echo $tecnologiasId ?>">
                    <input type="hidden" name="id-projeto" id="id-projeto" value="1">

                    <ul class="nav nav-underline">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="informacoes-iniciais-tab-editar" data-bs-toggle="tab" data-bs-target="#informacoes-iniciais-pane-editar" type="button" role="tab" aria-controls="informacoes-iniciais-pane-editar" aria-selected="true">Início</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="imagens-tab-editar" data-bs-toggle="tab" data-bs-target="#imagens-pane-editar" type="button" role="tab" aria-controls="imagens-pane-editar" aria-selected="true">Imagens</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="descricoes-tab-editar" data-bs-toggle="tab" data-bs-target="#descricoes-pane-editar" type="button" role="tab" aria-controls="descricoes-pane-editar" aria-selected="false">Descrições</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="links-projeto-tab-editar" data-bs-toggle="tab" data-bs-target="#links-projeto-pane-editar" type="button" role="tab" aria-controls="links-projeto-pane-editar" aria-selected="false">Links</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tecnologias-tab-editar" data-bs-toggle="tab" data-bs-target="#tecnolgias-pane-editar" type="button" role="tab" aria-controls="tecnolgias-pane-editar" aria-selected="false">Tecnologias</button>
                        </li>
                    </ul>
                    <br>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="informacoes-iniciais-pane-editar" role="tabpanel" aria-labelledby="informacoes-iniciais-tab-editar" tabindex="0">
                            <div class="mb-1 container-status-geral-projeto">
                                <div class="status-geral-projeto">
                                    <input type="radio" class="danger-outlined btn-check" name="status-geral-projeto-editar" id="danger-outlined-editar" autocomplete="off" value="Inativo" <?php echo $statusGeral == 'Inativo' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-danger" for="danger-outlined-editar">Inativo</label>
                                    
                                    <input type="radio" class="btn-check" name="status-geral-projeto-editar" id="success-outlined-editar" autocomplete="off" value="Ativo" <?php echo $statusGeral == 'Ativo' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-success" for="success-outlined-editar">Ativo</label>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12 mb-4">
                                    <label class="font-1-s nome-projeto" for="nome-projeto">Nome projeto <em>*</em></label><br>
                                    <input class="form-control" type="text" name="nome-projeto" id="nome-projeto" value="<?php echo $nomeProjeto ?>" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="projeto-destaque">Projeto em destaque? <em>*</em></label><br>
                                    <div class="container-check">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-destaque-nao-editar">Não</label>
                                            <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-nao-editar" value="Nao" <?php echo $projetoDestaque == 'Nao' ? 'checked' : '' ?>>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-destaque-sim-editar">Sim</label>
                                            <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-sim-editar" value="Sim" <?php echo $projetoDestaque == 'Sim' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="status-progresso-projeto">Progresso projeto<em>*</em></label><br>
                                    <div class="container-check">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="status-progresso-projeto-andamento-editar">Andamento</label>
                                            <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-projeto-andamento-editar" value="Andamento" <?php echo $statusProgresso == 'Andamento' ? 'checked' : '' ?>>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="status-progresso-concluido-editar">Concluído</label>
                                            <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-concluido-editar" value="Concluido" <?php echo $statusProgresso == 'Concluido' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" class="font-1-s" for="tipo-projeto">Tipo projeto <em>*</em></label>
                                    <select class="form-select" name="tipo-projeto" id="tipo-projeto" required>
                                        <option value="livre" <?php echo $tipoProjeto == 'Livre' ? 'selected' : ''?>>Livre</option>
                                        <option value="academico" <?php echo $tipoProjeto == 'Acadêmico' ? 'selected' : ''?>>Acadêmico</option>
                                        <option value="profissional" <?php echo $tipoProjeto == 'Profissional' ? 'selected' : ''?>>Profissional</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="data-desenvolvimento">Data desenvolvimento <em>*</em></label><br>
                                    <input class="form-control" type="date" name="data-desenvolvimento" id="data-desenvolvimento" value="<?php echo $dtLancamento?>">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="imagens-pane-editar" role="tabpanel" aria-labelledby="imagens-tab-editar" tabindex="0">
                            <div class="mb-4">
                                <label class="font-1-s" for="imagem">Imagem atual do projeto <em>*</em></label>
                                <div>
                                    <img src="<?php echo BASE_URL . $caminhoOriginal; ?>" alt="<?php echo $textoAlternativo; ?>" style="max-width: 100px; height: auto;">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="imagem-projeto">Imagem do projeto <em>*</em></label>
                                <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto">
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="imagem">Logo atual <em>*</em></label>
                                <div>
                                    <img src="<?php echo BASE_URL . $caminhoOriginalLogo; ?>" alt="<?php echo $textoAlternativo; ?>" style="max-width: 100px; height: auto;">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="logo-projeto">Logo<em>*</em></label>
                                <input class="form-control" type="file" name="logo-projeto" id="logo-projeto">
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="texto-alt">Texto Alternativo<em>*</em></label>
                                <input class="form-control" type="text" name="texto-alt" id="texto-alt" value="<?php echo $textoAlternativo ?>" required>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="descricoes-pane-editar" role="tabpanel" aria-labelledby="descricoes-tab-editar" tabindex="0">
                            <div class="mb-1">
                                <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                                <textarea class="form-control descricao-projeto" name="descricao-projeto" id="descricao-projeto"><?php echo $descricaoProjeto?></textarea>
                                <div class="feedback-qnt-invalida" style="display: flex; justify-content: end; padding: 5px">
                                    <span class="feedback-invalido">0</span>/190 caracteres
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                                <textarea class="form-control" name="descricao-tipo-projeto" id="descricao-tipo-projeto"><?php echo $descricaoTipoProjeto?></textarea>
                            </div>
                        </div>
    
                        <div class="tab-pane fade" id="links-projeto-pane-editar" role="tabpanel" aria-labelledby="links-projeto-tab-editar" tabindex="0">
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
                                <input class="form-control" type="text" name="link-repositorio" id="link-repositorio" value="<?php echo $linkDeploy ?>">
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tecnolgias-pane-editar" role="tabpanel" aria-label="tecnologias-tab-editar" tabindex="0">
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
                        <button class='col btn btn-primary cadastrar'>Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        var idTecAnt = $('#tecnologias-editar').val();
        var array = idTecAnt ? idTecAnt.split(',').map(Number) : [];
        // console.log(array);

        $('body').on('click', '.container-imagem-tecnologia', function (e) { 
            e.preventDefault();

            var idImagem = $(this).data('id-imagem');
            var idTecnologia = $(this).data('id-tecnologia');

            if (array.includes(idTecnologia)) {
                var index = array.indexOf(idTecnologia);
                array.splice(index, 1);
                $(this).removeClass('selected');

            } else {
                array.push(idTecnologia);
                $(this).addClass('selected');
            }

            $('#tecnologias-editar').val(array.join(','));
        });

        $('#form-projeto-editar').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            
            $.ajax({
                type: 'POST',
                url: 'include/aProjeto.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // console.log(response);
                    if (response.sucesso) {
                        window.location.href = '../projeto/index.php?msg=' + encodeURIComponent(response.mensagem);

                    } else {
                        window.location.href = '../projeto/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                    }
                },
                
                error: function(response) {
                    window.location.href = '../projeto/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                }

            });
        });

    });
</script>