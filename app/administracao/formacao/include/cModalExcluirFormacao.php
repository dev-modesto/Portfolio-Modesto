<?php

    session_start();

    if(isset($_POST['click-excluir-formacao'])){
        $id = $_POST['idPrincipal'];
        $_SESSION['idSessao'] = $id;
        
    } else {
        header('Location: ../index.php');
    }

?>

<div class="modal fade" id="modalExcluir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalExcluir" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-second">
                <span class="icone-alerta-modal material-symbols-rounded">error</span>
            </div>
            <div class="modal-body body-alerta-modal">
                <p>
                    <strong>Você tem certeza que deseja remover?</strong> <br>
                </p>
            </div>

            <form class="was-validated form-container" action="include/eFormacao.php" method="post">
                <input type="text" name="id-formacao" id="id-formacao" value="<?= $id ?>" hidden>
                <div class="modal-footer excluir form-container-button">
                    <button class="col btn btn-secondary btn-modal-cancelar" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button class="col btn btn-modal-excluir" type="submit">Excluir</button>
                </div>
            </form>
            
        </div>
    </div>
</div>