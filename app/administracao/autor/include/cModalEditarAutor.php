<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    
    if (isset($_POST['click-editar-autor'])) {
        $id = $_POST['idPrincipal'];

        $cAutor = cAutor($con, $id);
        $arrayAutor = mysqli_fetch_assoc($cAutor);
        $nome = $arrayAutor['nome'];
        $linkedin = $arrayAutor['link_linkedin'];
        $github = $arrayAutor['link_github'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal modalEditarAutor fade" id="modalEditarAutor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarAutor" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Editar Autor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="include/aAutor.php" method="post">
                    <input type="text" name="id" id="id" value="<?= $id ?>" hidden>

                    <div class="mb-4">
                        <label class="font-1-s" for="nome-autor-editar">Nome Autor<em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-autor" id="nome-autor-editar" value="<?= $nome ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-linkedin-editar">LinkedIn</label><br>
                        <input class="form-control" type="text" name="link-linkedin" id="link-linkedin-editar" value="<?= $linkedin ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="font-1-s" for="link-github-editar">GitHub</label><br>
                        <input class="form-control" type="text" name="link-github" id="link-github-editar" value="<?= $github ?>">
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
