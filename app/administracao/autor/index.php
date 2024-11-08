<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
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
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar Autor</button>
    </div>

    <div class="container-principal">

        <div class="container-tabela">
            <table class="myTable table nowrap order-column table-hover text-left">
                <thead class="">
                    <tr>
                        <th scope="col">Nome Autor</th>
                        <th scope="col">LinkedIn</th>
                        <th scope="col">GitHub</th>
                        <th scope="col">Controle</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                        $cAutor = cAutor($con);
                        while($exibe = mysqli_fetch_array($cAutor)){
                                $idAutor = $exibe['id_autor'];

                            ?>
                            <tr data-id-autor="<?= $idAutor ?>">
                                <td><?= $exibe['nome']?></td>
                                <td><?= $exibe['link_linkedin']?></td>
                                <td><?= $exibe['link_github']?></td>
                                <td class="td-icons">
                                    <a class="btn-visualizar-info-autor icone-controle-visualizar " href="#"><span class="icon-btn-controle material-symbols-rounded">visibility</span></a>
                                    <a class="btn-editar-autor icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                    <a class="btn-excluir-autor icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>

            </table>
        </div>
        
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="form-container" action="include/gAutor.php" method="post">
                        <div class="mb-4">
                            <label class="font-1-s" for="instituicao-ensino">Nome Autor<em>*</em></label><br>
                            <input class="form-control" type="text" name="nome-autor" id="nome-autor" required>
                        </div>

                        <div class="mb-4">
                            <label class="font-1-s" for="link-linkedin">LinkedIn</label><br>
                            <input class="form-control" type="text" name="link-linkedin" id="link-linkedin">
                        </div>
                        
                        <div class="mb-4">
                            <label class="font-1-s" for="link-github">GitHub</label><br>
                            <input class="form-control" type="text" name="link-github" id="link-github">
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

    <div class="modalExcluir modalEditarAutor">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>
