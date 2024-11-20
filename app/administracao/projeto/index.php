<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';

    $tituloPaginaHead = 'Projetos | Administração | devModesto';
    $tituloPagina = 'Projetos';
    include BASE_PATH . '/include/head/headPagAdministracao.php';
?>

<body>
<?php
    include BASE_PATH . '/include/preLoad/preLoad.php';
    include BASE_PATH . "/include/menu/sidebar.php";
?>

<div class="conteudo">

    <?php
        mensagemValida();
        mensagemInvalida();
    ?>

    <div class="container-principal">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="projetos-tab" data-bs-toggle="tab" data-bs-target="#projetos" type="button" role="tab" aria-controls="projetos" aria-selected="true">Projetos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="categorias-projeto-tab" data-bs-toggle="tab" data-bs-target="#categorias-projeto" type="button" role="tab" aria-controls="categorias-projeto" aria-selected="false">Categorias</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="projetos" role="tabpanel" aria-labelledby="projetos-tab" tabindex="0">
                <div class="mt-4 mb-4 container-button">
                    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar projeto</button>
                </div>

                <div class="container-tabela">
                    <table class="myTable table nowrap order-column table-hover text-left">
                        <thead class="">
                            <tr>
                                <th scope="col">Nome Projeto</th>
                                <th scope="col">Tipo projeto</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Data lançamento</th>
                                <th scope="col">Projeto em destaque</th>
                                <th scope="col">Visibilidade</th>
                                <th scope="col">Status geral</th>
                                <th scope="col">Progresso</th>
                                <th scope="col">Controle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 
                                $cProjeto = cProjeto($con);

                                while($exibe = mysqli_fetch_array($cProjeto)){
                                        $idProjeto = $exibe['id_projeto'];
                                        $newDtDesenvolvimento = new DateTime($exibe['dt_desenvolvimento']);
                                        $dataFormatada = date_format($newDtDesenvolvimento, 'd/m/Y');

                                    ?>
                                    <tr data-id-projeto="<?= $idProjeto ?>">
                                        <td><?= $exibe['nome_projeto']?></td>
                                        <td><span class="legenda-bg status-0"><?= $exibe['tipo_projeto']?></span></td>
                                        
                                        <td><?= $exibe['nome_categoria_projeto']?></td>
                                        <td><?= $dataFormatada?></td>
                                        <td class="td-legenda-bg-3"><?= $exibe['destaque'] == 'Sim' ? '<span class="material-symbols-rounded">star_rate</span>' : ''?></td>
                                        <td class="td-legenda-visibilidade"><span class="material-symbols-rounded"><?= $exibe['visibilidade'] == 'Publico' ? 'public' : 'person'?></span></td>
                                        <td class="td-legenda-bg-2"><span class="legenda-bg-2 <?= $exibe['status_geral'] == 'Inativo' ? 'status-3' : 'status-1'?>"><p class=""><?= $exibe['status_geral']?></p></span></td>
                                        <td><span class="legenda-bg <?= $exibe['status'] == 'Andamento' ? 'status-2' : 'status-1'?>"><?= $exibe['status']?></span></td>
                                        <td class="td-icons">
                                            <a class="btn-galeria-projeto icone-controle-galeria " href="#"><span class="icon-btn-controle material-symbols-rounded">photo_library</span></a>
                                            <a class="btn-editar-projeto icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                            <a class="btn-excluir-projeto icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="tab-pane" id="categorias-projeto" role="tabpanel" aria-labelledby="categorias-projeto-tab" tabindex="0">
                <div class="mt-4 mb-4 container-button">
                    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#modalcadastrarCategoria"> <span class="material-symbols-rounded">add</span>Cadastrar categoria</button>
                </div>

                <div class="container-tabela">
                    <table class="myTable table nowrap order-column table-hover text-left">
                        <thead class="">
                            <tr>
                                <th scope="col">Nome categoria</th>
                                <th scope="col">Controle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 

                                $cCategoriaProjeto = cCategoriaProjeto($con);
                                $arrayCategoriaProjeto = mysqli_fetch_all($cCategoriaProjeto, MYSQLI_ASSOC); 
                                foreach ($arrayCategoriaProjeto as $valor) {
                                    $idCategoriaProjeto = $valor['id_categoria'];
                                    $nome = $valor['nome'];

                                    ?>
                                        <tr data-id-categoria-projeto="<?= $idCategoriaProjeto ?>">
                                            <td><?= $nome ?></td>
                                            <td class="td-icons">
                                                <a class="btn-editar-categoria-projeto icone-controle-editar" href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                                <a class="btn-excluir-categoria-projeto icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-lg fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar projeto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="form-container" id="form-projeto" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="tecnologias" id="tecnologias" value="">
                        <input type="hidden" name="autores" id="autores" value="">

                        <ul class="nav nav-underline">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal active" id="informacoes-iniciais" data-bs-toggle="tab" data-bs-target="#informacoes-iniciais-pane" type="button" role="tab" aria-controls="informacoes-iniciais-pane" aria-selected="true">Início</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="imagens" data-bs-toggle="tab" data-bs-target="#imagens-pane" type="button" role="tab" aria-controls="imagens-pane" aria-selected="true">Imagens</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="descricoes-tab" data-bs-toggle="tab" data-bs-target="#descricoes-tab-pane" type="button" role="tab" aria-controls="descricoes-tab-pane" aria-selected="false">Descrições</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="links-projeto" data-bs-toggle="tab" data-bs-target="#links-projeto-pane" type="button" role="tab" aria-controls="links-projeto-pane" aria-selected="false">Links</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="tab-autores-projeto" data-bs-toggle="tab" data-bs-target="#autores-projeto-pane" type="button" role="tab" aria-controls="autores-projeto-pane" aria-selected="false">Autores</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="tab-tecnologias-tab" data-bs-toggle="tab" data-bs-target="#tab-tecnologias-tab-pane" type="button" role="tab" aria-controls="tab-tecnologias-tab-pane" aria-selected="false">Tecnologias</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link nav-modal" id="tab-outros-tab" data-bs-toggle="tab" data-bs-target="#tab-outros-tab-pane" type="button" role="tab" aria-controls="tab-outros-tab-pane" aria-selected="false">Outros</button>
                            </li>
                        </ul>
                        <br>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informacoes-iniciais-pane" role="tabpanel" aria-labelledby="informacoes-iniciais" tabindex="0">
                                <div class="mb-1 container-status-geral-projeto">
                                    <div class="status-geral-projeto">
                                        <input type="radio" class="danger-outlined btn-check" name="status-geral-projeto" id="danger-outlined" autocomplete="off" value="Inativo">
                                        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
                                        
                                        <input type="radio" class="btn-check" name="status-geral-projeto" id="success-outlined" autocomplete="off" value="Ativo" checked>
                                        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s nome-projeto" for="nome-projeto">Nome projeto <em>*</em></label><br>
                                        <input class="form-control" type="text" name="nome-projeto" id="nome-projeto" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="data-desenvolvimento">Data desenvolvimento <em>*</em></label><br>
                                        <input class="form-control" type="date" name="data-desenvolvimento" id="data-desenvolvimento">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="projeto-destaque">Projeto em destaque? <em>*</em></label><br>
                                        <div class="container-check">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="projeto-destaque-nao">Não</label>
                                                <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-nao" value="Nao" checked>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="projeto-destaque-sim">Sim</label>
                                                <input class="form-check-input" type="radio" name="projeto-destaque" id="projeto-destaque-sim" value="Sim">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="status-progresso-projeto">Progresso projeto<em>*</em></label><br>
                                        <div class="container-check">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="status-progresso-projeto-andamento">Andamento</label>
                                                <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-projeto-andamento" value="Andamento"  checked>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="status-progresso-concluido">Concluído</label>
                                                <input class="form-check-input" type="radio" name="status-progresso-projeto" id="status-progresso-concluido" value="Concluido">
                                            </div>
                                        </div>
                                    </div>
                                </div>
      
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" class="font-1-s" for="tipo-projeto">Tipo projeto <em>*</em></label>
                                        <select class="form-select" name="tipo-projeto" id="tipo-projeto" required>
                                            <option value="" selected>Escolha o tipo de projeto</option>
                                            <option value="academico">Acadêmico</option>
                                            <option value="livre">Livre</option>
                                            <option value="pessoal">Pessoal</option>
                                            <option value="profissional">Profissional</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="categoria-projeto">Categoria projeto<em>*</em></label><br>
                                        <select class="form-select" name="id-categoria-projeto" id="categoria-projeto">
                                            <option value="" selected>Escolha uma categoria</option>
                                            <?php

                                               foreach ($cCategoriaProjeto as $valor) {
                                                $idCategoriaProjeto = $valor['id_categoria'];
                                                $nome = $valor['nome'];
                                                ?>
                                                    <option value="<?= $idCategoriaProjeto ?>"><?= $nome ?></option>
                                                <?php
                                               }
                                            ?>

                                        </select>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="imagens-pane" role="tabpanel" aria-labelledby="imagens" tabindex="0">
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="imagem-projeto">Thumbnail<em>*</em></label>
                                        <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="logo-projeto">Logo<em>*</em></label>
                                        <input class="form-control" type="file" name="logo-projeto" id="logo-projeto" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="nome-titulo-img-thumbnail">Título img thumbnail<em>*</em></label><br>
                                        <input class="form-control" type="text" name="nome-titulo-img-thumbnail" id="nome-titulo-img-thumbnail" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="nome-titulo-img-logo">Título img logo<em>*</em></label><br>
                                        <input class="form-control" type="text" name="nome-titulo-img-logo" id="nome-titulo-img-logo" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="texto-alt-thumbnail">Texto Alt. thumbnail<em>*</em></label>
                                        <input class="form-control" type="text" name="texto-alt-thumbnail" id="texto-alt-thumbnail" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="texto-alt-logo">Texto Alt. logo<em>*</em></label>
                                        <input class="form-control" type="text" name="texto-alt-logo" id="texto-alt-logo" required>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="descricoes-tab-pane" role="tabpanel" aria-labelledby="descricoes" tabindex="0">
                                <div class="mb-1">
                                    <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                                    <textarea class="form-control descricao-projeto desc-projeto" name="descricao-projeto" id="descricao-projeto"></textarea>
                                    <div class="feedback-qnt-caracteres descricao-projeto-feedback" style="display: flex; justify-content: end; padding: 5px">
                                        <span class="feedback-caracteres">0 caracteres</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="font-1-s" for="radio-desc-funcionalidades">Adicionar descrição de funcionalidades?</label><br>
                                    <div class="container-check funcionalidades">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="radio-desc-funcionalidades-nao">Não</label>
                                            <input class="form-check-input radio-desc-funcionalidades" type="radio" name="radio-desc-funcionalidades" id="radio-desc-funcionalidades-nao" value="Nao" checked>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="radio-desc-funcionalidades-sim">Sim</label>
                                            <input class="form-check-input radio-desc-funcionalidades" type="radio" name="radio-desc-funcionalidades" id="radio-desc-funcionalidades-sim" value="Sim">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 container-descricao-funcionalidades">
                                    <label class="font-1-s" for="descricao-funcionalidades">Descrição de funcionalidades</label>
                                    <textarea class="form-control descricao-funcionalidades desc-funcionalidades" name="descricao-funcionalidades" id="descricao-funcionalidades"></textarea>
                                    <div class="feedback-qnt-caracteres descricao-funcionalidades-feedback" style="display: flex; justify-content: end; padding: 5px">
                                        <span class="feedback-caracteres">0 caracteres</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                                    <textarea class="form-control descricao-tipo-projeto desc-tipo-projeto" name="descricao-tipo-projeto" id="descricao-tipo-projeto"></textarea>
                                </div>
                            </div>
        
                            <div class="tab-pane fade" id="links-projeto-pane" role="tabpanel" aria-labelledby="links-projeto" tabindex="0">
                                <div class="mb-4">
                                    <label class="font-1-s" for="link-deploy">Link Deploy</label>
                                    <input class="form-control" type="text" name="link-deploy" id="link-deploy">
                                </div>

                                <div class="mb-4">
                                    <label class="font-1-s" for="link-figma">Link Figma</label>
                                    <input class="form-control" type="text" name="link-figma" id="link-figma">
                                </div>

                                <div class="mb-4">
                                    <label class="font-1-s" for="link-repositorio">Link repositório Github</label>
                                    <input class="form-control" type="text" name="link-repositorio" id="link-repositorio">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="autores-projeto-pane" role="tabpanel" aria-labelledby="tab-autores-projeto" tabindex="0">
                                <div class="mb-4">
                                    <label class="font-1-s" for="projeto-equipe">Projeto em equipe? <em>*</em></label><br>
                                    <div class="container-check">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-equipe-nao">Não</label>
                                            <input class="form-check-input projeto-equipe" type="radio" name="projeto-equipe" id="projeto-equipe-nao" value="Nao" checked>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="projeto-equipe-sim">Sim</label>
                                            <input class="form-check-input projeto-equipe" type="radio" name="projeto-equipe" id="projeto-equipe-sim" value="Sim">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="container-principal-autores-projeto row mb-4">
                                    <div class="col-md-12 mb-4">
                                        <label class="font-1-s" for="autores-projeto">Autores do projeto</label>
                                        <select class="form-select form-autores-projeto" name="autores-projeto" id="autores-projeto">
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
                                        <button type="button" class="btn btn-primary" id="btn-adicionar-autor">Adicionar</button>
                                    </div>
                                    <div class="container-autores-projeto mb-4">
                
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-tecnologias-tab-pane" role="tabpanel" aria-label="tab-tecnologias" tabindex="0">
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
                                                
                                                    <div class="container-imagem-tecnologia cadastrar" data-id-tecnologia="<?= $idTecnologia ?>">
                                                        <img src="<?= BASE_URL . $caminhoImagem ?>" alt="">
                                                    </div>
                                                    
                                                <?php
                                            }

                                            ?>
                                        </div>
                                    <?php
                                ?>
                            </div>

                            <div class="tab-pane fade" id="tab-outros-tab-pane" role="tabpanel" aria-labelledby="tab-outros-tab" tabindex="0">
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="font-1-s" for="status-progresso-projeto">Visibilidade do projeto<em>*</em></label><br>
                                        <div class="container-check">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="visibilidade-publico">Público</label>
                                                <input class="form-check-input" type="radio" name="visibilidade-projeto" id="visibilidade-publico" value="Publico" checked>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label" for="visibilidade-somente-eu">Somente eu</label>
                                                <input class="form-check-input" type="radio" name="visibilidade-projeto" id="visibilidade-somente-eu" value="Administrador">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer form-container-button">
                            <button type="button" class="col btn btn-secondary btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button class='col btn btn-primary cadastrar' type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalcadastrarCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalcadastrarCategoriaLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar Categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="form-container" action="include/gCategoriaProjeto.php" method="post">
                        <div class="mb-4">
                            <label class="font-1-s" for="nome-categoria">Nome Categoria<em>*</em></label><br>
                            <input class="form-control" type="text" name="nome-categoria" id="nome-categoria" required>
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

    <div class="modalExcluir modalEditarProjeto modalEditarCategoriaProjeto">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>

<script>

    $(document).ready(function () {
        var array = [];

        $('body').on('click', '.container-imagem-tecnologia.cadastrar', function (e) { 
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

            $('#tecnologias').val(array.join(','));
        });

        $('#form-projeto').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            
            $.ajax({
                type: 'POST',
                url: 'include/gProjeto.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
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
        
        const classeTextAreaDescricaoProjeto = '.descricao-projeto';
        const classeTextAreaDescricaoFuncionalidades = '.descricao-funcionalidades';
        const classeContainerFeedbackDescricaoProjeto  = '.descricao-projeto-feedback';
        const classeContainerFeedbackDescricaoFuncionalidades  = '.descricao-funcionalidades-feedback';
        quantidadeCaracteres(classeTextAreaDescricaoProjeto, classeContainerFeedbackDescricaoProjeto);
        quantidadeCaracteres(classeTextAreaDescricaoFuncionalidades, classeContainerFeedbackDescricaoFuncionalidades);

        var arrayAutores = [];

        $('#btn-adicionar-autor').click(function (e){
            e.preventDefault();

            var idAutor = $('.form-autores-projeto').val();
            idAutor = Number(idAutor);
            var nomeAutor = $('#autores-projeto option:selected').text();

            if (idAutor === 0 || arrayAutores.includes(idAutor)) {
                return;

            } else {
                arrayAutores.push(idAutor);
            }

            $('#autores').val(arrayAutores.join(','));

            $('.container-autores-projeto').append(`
                <div class="autor-item" data-id="${idAutor}">
                    <a class="btn-remover-autor icone-excluir-autor" href="#" data-id="${idAutor}"><span class="icon-btn-controle material-symbols-rounded">close</span></a><span class="nome-autor">${nomeAutor}</span>
                </div>
            `);
        });

        $(document).on('click', '.btn-remover-autor', function () {
            var idAutor = $(this).data('id');

            arrayAutores = arrayAutores.filter(function (autor) {
                return autor !== idAutor;
            });

            $('#autores').val(arrayAutores.join(','));

            $(`.autor-item[data-id="${idAutor}"]`).remove();
        });

        var projetoEquipe = $('.projeto-equipe').val();
        var containerPrincipalAutores = $('.container-principal-autores-projeto')[0];

        function visibilidadeContainerAutores(projetoEquipe) {
            if (projetoEquipe == 'Nao') {
                containerPrincipalAutores.style.display = 'none';

            } else {
                containerPrincipalAutores.style.display = 'block';
            }
        }

        $('.projeto-equipe').change(function (e) { 
            e.preventDefault();
            var projetoEquipe = $(this).val();
            visibilidadeContainerAutores(projetoEquipe);

        });

        visibilidadeContainerAutores(projetoEquipe);

        $('.btn-galeria-projeto').click(function (e) { 
            e.preventDefault();
            const idProjeto = $(this).closest('tr').data('id-projeto');
            const queryString = $.param({
                'click-galeria-projeto':true,
                'id-projeto':idProjeto
            });
            
            window.location.href = 'include/galeriaProjeto.php?' + queryString;
            
        });

        $('.radio-desc-funcionalidades').click(function (e) { 
            const descricaoFuncionalidades = $(this).val();
            const containerTextoFuncionalidades = $('.container-descricao-funcionalidades')[0];

            function visibilidadeContainerTextFuncionalidades(descricaoFuncionalidades) {
                if (descricaoFuncionalidades == 'Nao') {
                    containerTextoFuncionalidades.style.display = 'none';

                } else {
                    containerTextoFuncionalidades.style.display = 'block';
                }
            }
            
            visibilidadeContainerTextFuncionalidades(descricaoFuncionalidades);
            
        });

        $('#staticBackdrop').on('shown.bs.modal', function() {
            resetarFeedbackCaracteres('.descricao-projeto-feedback');
            resetarFeedbackCaracteres('.descricao-funcionalidades-feedback');
        });

    });
</script>

<script src="<?= BASE_URL . '/js/quantidadeCaracteres.js'?>"></script>