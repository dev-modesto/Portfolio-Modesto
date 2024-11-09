<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@200;300;400;500;600;700&family=Roboto:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/componentes.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/global.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/navbar.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-lateral.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-top.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/tabela.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/modal.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/pre-loader.css">
</head>
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
                                $cFormacaoAcademica = cFormacaoAcademica($con, null, $categorias);
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
                                $categorias = ['Curso livre'];
                                $cFormacaoAcademica = cFormacaoAcademica($con, null, $categorias);
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
                            <select class="form-select" name="categoria-curso" id="">
                                <option value="" selected>Escolha a area de formacao</option>
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
                        <select class="form-select" name="img-formacao" id="img-formacao">
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
                        <select class="form-select" name="status" id="" required>
                            <option value="" selected>Defina um status</option>
                            <option value="Concluído">Concluído</option>
                            <option value="Andamento">Andamento</option>
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