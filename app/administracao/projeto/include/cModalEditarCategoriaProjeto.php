<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';

   
    
    if (isset($_POST['click-editar-categoria-projeto'])) {
        $id = $_POST['idPrincipal'];

        $cCategoriaProjeto = cCategoriaProjeto($con);
        $array = mysqli_fetch_assoc($cCategoriaProjeto);
        $nome = $array['nome'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal fade" id="modalEditarCategoriaProjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarCategoriaProjeto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="include/aCategoriaProjeto.php" method="post">
                    <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                    <div class="mb-4">
                        <label class="font-1-s" for="nome-categoria">Nome Categoria<em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-categoria" id="nome-categoria" value="<?= $nome ?>" required>
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