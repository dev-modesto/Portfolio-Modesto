<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';

    $tituloPaginaHead = 'Formação | Administração | devModesto';
    $tituloPagina = 'Formação';
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

    <div class="container-button">
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar formação</button>
    </div>

    <div class="container-principal">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="educacao-formal-tab" data-bs-toggle="tab" data-bs-target="#educacao-formal" type="button" role="tab" aria-controls="educacao-formal" aria-selected="true">Educação Formal</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cursos-livres-tab" data-bs-toggle="tab" data-bs-target="#cursos-livres" type="button" role="tab" aria-controls="cursos-livres" aria-selected="false">Cursos Livres</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="educacao-formal" role="tabpanel" aria-labelledby="educacao-formal-tab" tabindex="0">
                <div class="container-tabela">
                    <table class="myTable table nowrap order-column table-hover text-left">
                        <thead>
                            <tr>
                                <th scope="col">Nome Formação</th>
                                <th scope="col">Institutição</th>
                                <th scope="col">Categoria curso</th>
                                <th scope="col">Total horas</th>
                                <th scope="col">Status</th>
                                <th scope="col">Controle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 

                                $categorias = ['Tecnólogo', 'Técnico'];
                                $cFormacaoAcademica = cFormacaoAcademica($con, null, null, $categorias);
                                $retorno = mysqli_fetch_all($cFormacaoAcademica, MYSQLI_ASSOC);

                                foreach ($retorno as $chave => $exibe) {
                                        $idFormacao = $exibe['id_formacao'];
                                    ?>
                                    <tr data-id-formacao="<?= $idFormacao ?>">
                                        <td><?= $exibe['nome']?></td>
                                        <td><?= $exibe['instituicao']?></td>
                                        <td><?= $exibe['categoria_curso']?></td>
                                        <td><?= $exibe['total_horas']?></td>
                                        <td><span class="legenda-bg <?= $exibe['status'] == 'Andamento' ? 'status-2' : 'status-1'?>"><?= $exibe['status']?></span></td>
                                        <td class="td-icons">
                                            <a class="btn-editar-formacao icone-controle-editar" href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                            <a class="btn-excluir-formacao icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane" id="cursos-livres" role="tabpanel" aria-labelledby="cursos-livres-tab" tabindex="0">
                <div class="container-tabela">
                    <table class="myTable table nowrap order-column table-hover text-left">
                        <thead>
                            <tr>
                                <th scope="col">Nome Formação</th>
                                <th scope="col">Institutição</th>
                                <th scope="col">Categoria curso</th>
                                <th scope="col">Total horas</th>
                                <th scope="col">Status</th>
                                <th scope="col">Controle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php 
                                $categorias = ['Curso livre', 'Acadêmico'];
                                $cFormacaoAcademica = cFormacaoAcademica($con, null, null, $categorias);
                                $retorno = mysqli_fetch_all($cFormacaoAcademica, MYSQLI_ASSOC);

                                foreach ($retorno as $chave => $exibe) {
                                        $idFormacao = $exibe['id_formacao'];
                                    ?>
                                    <tr data-id-formacao="<?= $idFormacao ?>">
                                        <td><?= $exibe['nome']?></td>
                                        <td><?= $exibe['instituicao']?></td>
                                        <td><?= $exibe['categoria_curso']?></td>
                                        <td><?= $exibe['total_horas']?></td>
                                        <td><span class="legenda-bg <?= $exibe['status'] == 'Andamento' ? 'status-2' : 'status-1'?>"><?= $exibe['status']?></span></td>
                                        <td class="td-icons">
                                            <a class="btn-editar-formacao icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                            <a class="btn-excluir-formacao icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar formação</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="form-container" action="include/gFormacao.php" method="post">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="nome-formacao">Nome formação <em>*</em></label><br>
                            <input class="form-control" type="text" name="nome-formacao" id="nome-formacao" required>
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" class="font-1-s" for="area-formacao">Área formação <em>*</em></label><br>
                            <select class="form-select" name="area-formacao" id="area-formacao" required>
                                <option value="" selected>Escolha a area de formacao</option>
                                <?php 

                                    $consultaAreaFormacao = cAreaFormacao($con);
                                    while($row = mysqli_fetch_assoc($consultaAreaFormacao)){
                                        echo "<option value='" . $row['id_area_formacao'] . "'>" . $row['nome'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="instituicao-ensino">Instituição de ensino <em>*</em></label><br>
                        <input class="form-control" type="text" name="instituicao-ensino" id="instituicao-ensino" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="data-inicio">Data Inicio</label><br>
                            <input class="form-control" type="date" name="data-inicio" id="data-inicio">
                        </div>

                        <div class="col-md-6">
                            <label class="font-1-s" for="data-fim">Data Fim</label><br>
                            <input class="form-control" type="date" name="data-fim" id="data-fim">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="categoria-curso">Categoria do Curso <em>*</em></label><br>
                            <select class="form-select" name="categoria-curso" id="categoria-curso" required>
                                <option value="" selected>Escolha a area de formacao</option>
                                <option value="Acadêmico">Acadêmico</option>
                                <option value="Curso Livre">Curso Livre</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Tecnólogo">Tecnólogo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" for="total-horas">Total horas <em>*</em></label><br>
                            <input class="form-control" type="text" name="total-horas" id="total-horas" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="img-formacao">Imagem <em>*</em></label><br>
                        <select class="form-select" name="img-formacao" id="img-formacao" required>
                            <option value="" selected>Escolha a imagem</option>
                            <?php 
                                $categoriaImagem = ['instituicao'];
                                $consultaImagens = cImagens($con, null, $categoriaImagem);
                                
                                while($row = mysqli_fetch_assoc($consultaImagens)){
                                    echo "<option value='" . $row['id_imagem'] . "'>" . $row['nome_titulo'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-certificado">Link Certificado</label><br>
                        <input class="form-control" type="text" name="link-certificado" id="link-certificado">
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="status-curso">Status <em>*</em></label><br>
                        <select class="form-select" name="status" id="status-curso" required>
                            <option value="" selected>Defina um status</option>
                            <option value="Andamento">Andamento</option>
                            <option value="Concluído">Concluído</option>
                        </select>
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

    <div class="modalExcluir modalEditarFormacao">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>