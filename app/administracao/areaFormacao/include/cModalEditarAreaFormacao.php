<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/formacao.php';

    if (isset($_POST['click-editar-area-formacao'])) {
        $id = $_POST['idPrincipal'];

        $consultaAreaFormacao = cAreaFormacao($con, $id);
        $arrayConsultaAreaFormacao = mysqli_fetch_assoc($consultaAreaFormacao);
        $nome = $arrayConsultaAreaFormacao['nome'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal modalEditarAreaFormacao fade" id="modalEditarAreaFormacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarAreaFormacao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Área</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="form-container" action="include/aAreaFormacao.php" method="post">
                    <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                    <div class="mb-4">
                        <label class="font-1-s" for="area-formacao">Nome área de formação<em>*</em></label><br>
                        <input class="form-control" type="text" name="area-formacao" id="area-formacao" value="<?= $nome ?>" required>
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