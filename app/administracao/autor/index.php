<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    
    $tituloPaginaHead = 'Autores | Administração | devModesto';
    $tituloPagina = 'Autores';
    
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
