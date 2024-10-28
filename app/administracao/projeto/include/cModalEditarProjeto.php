<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    
    if (isset($_POST['click-editar-projeto'])) {
        $idProjeto = $_POST['idPrincipal'];

        $cProjeto = cProjeto($con, $idProjeto);
        $arrayProjeto = mysqli_fetch_assoc($cProjeto);

        $nomeProjeto = $arrayProjeto['nome_projeto'];
        $descricaoProjeto = $arrayProjeto['descricao'];
        $descricaoTipoProjeto = $arrayProjeto['descricao_tipo_projeto'];
        $idCategoria = $arrayProjeto['id_categoria'];
        $tipoProjeto = $arrayProjeto['tipo_projeto'];
        $dtLancamento = $arrayProjeto['dt_desenvolvimento'];
        $linkDeploy = $arrayProjeto['link_deploy'];
        $linkFigma = $arrayProjeto['link_figma'];
        $linkRepositorio = $arrayProjeto['link_repositorio'];
        $projetoDestaque = $arrayProjeto['destaque'];
        $statusGeral = $arrayProjeto['status_geral'];
        $projetoEquipe = $arrayProjeto['projeto_equipe'];
        $statusProgresso = $arrayProjeto['status'];

        $tipoImagemProjeto = ['thumbnail'];
        $cProjetoImagemProjeto = cProjetoImagem($con, $idProjeto,'projeto', $tipoImagemProjeto);
        $qntImgThumbnail = mysqli_num_rows($cProjetoImagemProjeto);
        $caminhoOriginal = '/assets/img/outros/nao-encontrado-img-thumbnail.svg';
        $textoAltImgThumbnail = 'imagem logo não encontrada';
        $nomeTituloImgThumbnail = 'informações da imagem não encontradas.';

        $tipoImagemLogo = ['logo'];
        $cProjetoImagemLogo = cProjetoImagem($con, $idProjeto, 'projeto', $tipoImagemLogo);
        $qntImgLogo = mysqli_num_rows($cProjetoImagemLogo);
        $caminhoOriginalLogo = '/assets/img/outros/nao-encontrado-img-logo.svg';
        $textoAltImgLogo = 'imagem logo não encontrada';
        $nomeTituloImgLogo = 'informações da imagem não encontradas.';
        
        if ($qntImgThumbnail > 0) {
            $arrayImagensProjeto = mysqli_fetch_assoc($cProjetoImagemProjeto);
            $caminhoOriginal = $arrayImagensProjeto['caminho_original'];
            $textoAltImgThumbnail = $arrayImagensProjeto['texto_alt'];
            $nomeTituloImgThumbnail = $arrayImagensProjeto['nome_titulo'];
        } 

        if ($qntImgLogo > 0) {
            $arrayImagemLogoProjeto = mysqli_fetch_assoc($cProjetoImagemLogo);
            $caminhoOriginalLogo = $arrayImagemLogoProjeto['caminho_original'];
            $textoAltImgLogo = $arrayImagemLogoProjeto['texto_alt'];
            $nomeTituloImgLogo = $arrayImagemLogoProjeto['nome_titulo'];
        } 

        $sqlConsultaTecProjeto = "SELECT id_tecnologia FROM tbl_tecnologia_projeto WHERE id_projeto = '$idProjeto'";
        $consultaTecProjeto = mysqli_query($con, $sqlConsultaTecProjeto);

        $arrayTecProjeto = [];
        
        while ($arrayProjetoTec = mysqli_fetch_assoc($consultaTecProjeto)) {
            $arrayTecProjeto[] = $arrayProjetoTec['id_tecnologia'];
        }

        $tecnologiasId = implode(',', $arrayTecProjeto);

        $arrayAutoresProjeto = [];
        $cAutorProjeto = cAutorProjeto($con, $idProjeto, 'sim');
        $consultaProjeto = mysqli_fetch_all($cAutorProjeto, MYSQLI_ASSOC);

        foreach ($consultaProjeto as $valor) {
            $idProjeto = $valor['id_projeto'];
            $idAutor = $valor['id_autor'];
            $arrayAutoresProjeto[] = $idAutor;
        }

        $autoresId = implode(',', $arrayAutoresProjeto);

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
                    <input type="text" name="id" id="id" value="<?= $idProjeto ?>" hidden>
                    <input class="tecnologias-editar" type="hidden" name="tecnologias-editar" id="tecnologias-editar" value="<?= $tecnologiasId ?>">
                    <input type="hidden" name="autores-editar" id="autores-editar" value="<?= $autoresId ?>">

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
                                <button class="nav-link" id="tab-autores-projeto-editar" data-bs-toggle="tab" data-bs-target="#autores-projeto-pane-editar" type="button" role="tab" aria-controls="autores-projeto-pane-editar" aria-selected="false">Autores</button>
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
                                    <input type="radio" class="danger-outlined btn-check" name="status-geral-projeto-editar" id="danger-outlined-editar" autocomplete="off" value="Inativo" <?= $statusGeral == 'Inativo' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-danger" for="danger-outlined-editar">Inativo</label>
                                    
                                    <input type="radio" class="btn-check" name="status-geral-projeto-editar" id="success-outlined-editar" autocomplete="off" value="Ativo" <?= $statusGeral == 'Ativo' ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-success" for="success-outlined-editar">Ativo</label>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s nome-projeto" for="nome-projeto">Nome projeto <em>*</em></label><br>
                                    <input class="form-control" type="text" name="nome-projeto" id="nome-projeto" value="<?= $nomeProjeto ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="data-desenvolvimento">Data desenvolvimento <em>*</em></label><br>
                                    <input class="form-control" type="date" name="data-desenvolvimento" id="data-desenvolvimento" value="<?= $dtLancamento?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="projeto-destaque">Projeto em destaque? <em>*</em></label><br>
                                    <div class="container-check">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-destaque-nao-editar">Não</label>
                                            <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-nao-editar" value="Nao" <?= $projetoDestaque == 'Nao' ? 'checked' : '' ?>>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-destaque-sim-editar">Sim</label>
                                            <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-sim-editar" value="Sim" <?= $projetoDestaque == 'Sim' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="status-progresso-projeto">Progresso projeto<em>*</em></label><br>
                                    <div class="container-check">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="status-progresso-projeto-andamento-editar">Andamento</label>
                                            <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-projeto-andamento-editar" value="Andamento" <?= $statusProgresso == 'Andamento' ? 'checked' : '' ?>>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="status-progresso-concluido-editar">Concluído</label>
                                            <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-concluido-editar" value="Concluido" <?= $statusProgresso == 'Concluido' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" class="font-1-s" for="tipo-projeto">Tipo projeto <em>*</em></label>
                                    <select class="form-select" name="tipo-projeto" id="tipo-projeto" required>
                                        <option value="livre" <?= $tipoProjeto == 'Livre' ? 'selected' : ''?>>Livre</option>
                                        <option value="academico" <?= $tipoProjeto == 'Acadêmico' ? 'selected' : ''?>>Acadêmico</option>
                                        <option value="profissional" <?= $tipoProjeto == 'Profissional' ? 'selected' : ''?>>Profissional</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="categoria-projeto">Categoria projeto<em>*</em></label><br>
                                    <select class="form-select" name="id-categoria-projeto" id="categoria-projeto">
                                        <?php
                                            $cCategoriaProjeto = cCategoriaProjeto($con);
                                            $arrayCategoriaProjeto = mysqli_fetch_all($cCategoriaProjeto, MYSQLI_ASSOC); 
                                            $idCategoriaProjeto = '';
                                            foreach ($arrayCategoriaProjeto as $valor) {
                                                $idCategoriaProjeto = $valor['id_categoria'];
                                                $nome = $valor['nome'];

                                                $selected = $idCategoria == $idCategoriaProjeto ? 'selected' : '';

                                                ?>
                                                    <option value="<?= $idCategoriaProjeto?>" <?= $selected ?>><?= $nome ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>   
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="imagens-pane-editar" role="tabpanel" aria-labelledby="imagens-tab-editar" tabindex="0">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="imagem">Imagem atual do projeto <em>*</em></label>
                                    <div>
                                        <img src="<?= BASE_URL . $caminhoOriginal; ?>" alt="<?= $textoAltImgThumbnail; ?>" style="max-width: 100px; height: auto;">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="imagem">Logo atual <em>*</em></label>
                                    <div>
                                        <img src="<?= BASE_URL . $caminhoOriginalLogo; ?>" alt="<?= $textoAltImgLogo; ?>" style="max-width: 100px; height: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="imagem-projeto">Thumbnail<em>*</em></label>
                                    <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="logo-projeto">Logo<em>*</em></label>
                                    <input class="form-control" type="file" name="logo-projeto" id="logo-projeto">
                                </div>
                            </div>
                                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="nome-titulo-img-thumbnail">Título img thumbnail<em>*</em></label><br>
                                    <input class="form-control" type="text" name="nome-titulo-img-thumbnail" id="nome-titulo-img-thumbnail" value="<?= $nomeTituloImgThumbnail?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="nome-titulo-img-logo">Título img logo<em>*</em></label><br>
                                    <input class="form-control" type="text" name="nome-titulo-img-logo" id="nome-titulo-img-logo" value="<?= $nomeTituloImgLogo?>" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="texto-alt-thumbnail">Texto Alt. thumbnail<em>*</em></label>
                                    <input class="form-control" type="text" name="texto-alt-thumbnail" id="texto-alt-thumbnail" value="<?= $textoAltImgThumbnail?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="font-1-s" for="texto-alt-logo">Texto Alt. logo<em>*</em></label>
                                    <input class="form-control" type="text" name="texto-alt-logo" id="texto-alt-logo" value="<?= $textoAltImgLogo?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="descricoes-pane-editar" role="tabpanel" aria-labelledby="descricoes-tab-editar" tabindex="0">
                            <div class="mb-1">
                                <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                                <textarea class="form-control descricao-projeto" name="descricao-projeto" id="descricao-projeto"><?= $descricaoProjeto?></textarea>
                                <div class="feedback-qnt-invalida" style="display: flex; justify-content: end; padding: 5px">
                                    <span class="feedback-invalido">0</span>/190 caracteres
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                                <textarea class="form-control" name="descricao-tipo-projeto" id="descricao-tipo-projeto"><?= $descricaoTipoProjeto?></textarea>
                            </div>
                        </div>
    
                        <div class="tab-pane fade" id="links-projeto-pane-editar" role="tabpanel" aria-labelledby="links-projeto-tab-editar" tabindex="0">
                            <div class="mb-4">
                                <label class="font-1-s" for="link-deploy">Link Deploy</label>
                                <input class="form-control" type="text" name="link-deploy" id="link-deploy" value="<?= $linkDeploy ?>">
                            </div>

                            <div class="mb-4">
                                <label class="font-1-s" for="link-figma">Link Figma</label>
                                <input class="form-control" type="text" name="link-figma" id="link-figma" value="<?= $linkFigma ?>">
                            </div>

                            <div class="mb-4">
                                <label class="font-1-s" for="link-repositorio">Link repositório Github</label>
                                <input class="form-control" type="text" name="link-repositorio" id="link-repositorio" value="<?= $linkDeploy ?>">
                            </div>
                        </div>

                        <div class="tab-pane fade" id="autores-projeto-pane-editar" role="tabpanel" aria-labelledby="tab-autores-projeto-editar" tabindex="0">
                            <div class="mb-4">
                                <label class="font-1-s" for="projeto-equipe-editar">Projeto em equipe? <em>*</em></label><br>
                                <div class="container-check">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="projeto-equipe-nao-editar">Não</label>
                                        <input class="form-check-input projeto-equipe-editar" type="radio" name="projeto-equipe-editar" id="projeto-equipe-nao-editar" value="Nao" <?= $projetoEquipe == 'Nao' ? 'checked' : '' ?>>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="projeto-equipe-sim-editar">Sim</label>
                                        <input class="form-check-input projeto-equipe-editar" type="radio" name="projeto-equipe-editar" id="projeto-equipe-sim-editar" value="Sim" <?= $projetoEquipe == 'Sim' ? 'checked' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="container-principal-autores-projeto editar row mb-4">
                                <div class="col-md-12 mb-4">
                                    <label class="font-1-s" for="autores-projeto-editar">Autores do projeto</label>
                                    <select class="form-select form-autores-projeto-editar" name="autores-projeto-editar" id="autores-projeto-editar">
                                        <option value="" selected>Informe o autor</option>

                                        <?php
                                
                                            $cAutorDiferenteGabriel = cAutorDiferenteGabriel($con);

                                            foreach ($cAutorDiferenteGabriel as $chave => $valor) {
                                                $idAutor = $valor['id_autor'];
                                                $nomeAutor = $valor['nome'];

                                                ?>
                                                    <option value="<?= $idAutor ?>"><?= $nomeAutor ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <button type="button" class="btn btn-primary" id="btn-adicionar-autor-editar">Adicionar</button>
                                </div>
                                <div class="container-autores-projeto editar mb-4">

                                    <?php
                                    
                                        foreach ($consultaProjeto as $valor) {
                                            $idAutorProjeto = $valor['id_autor'];
                                            $nomeAutorProjeto = $valor['nome'];
                                            ?>
                                                <div class="autor-item" data-id="<?= $idAutorProjeto ?>">
                                                    <a class="btn-remover-autor-editar icone-excluir-autor" href="#" data-id="<?= $idAutorProjeto ?>"><span class="icon-btn-controle material-symbols-rounded">close</span></a><span class="nome-autor"><?= $nomeAutorProjeto ?></span>
                                                </div>
                                            <?php
                                        }

                                    ?>
                                </div>
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
                                            
                                                <div class="container-imagem-tecnologia editar" data-id-tecnologia="<?= $idTecnologia ?>">
                                                    <img src="<?= BASE_URL . $caminhoImagem ?>" alt="">
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
                        <button class='col btn btn-primary cadastrar'>Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>