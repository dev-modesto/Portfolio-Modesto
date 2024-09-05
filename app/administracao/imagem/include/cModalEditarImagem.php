<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    
    if (isset($_POST['click-editar-imagem'])) {
        $id = $_POST['idPrincipal'];

        $sql = "SELECT * FROM tbl_imagem WHERE id_imagem = '$id'";
        $consult = mysqli_query($con, $sql);
        $array = mysqli_fetch_assoc($consult);
        $nomeOriginal = $array['nome_original'];
        $caminhoOriginal = $array['caminho_original'];
        $nomePlain = $array['nome_plain'];
        $caminhoPlain = $array['caminho_plain'];
        $textoAlt = $array['texto_alt'];
        $categoria = $array['categoria'];

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal fade" id="modalEditarImagem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarImagem" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarImagem">Editar imagem</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form class="form-container" action="include/aImagem.php" method="post" enctype="multipart/form-data">
                <input type="text" name="id" id="id" value="<?php echo $id ?>" hidden>
                <div class="mb-4">
                    <label class="font-1-s" for="imagem">Imagem atual <em>*</em></label>
                    <div>
                        <img src="<?php echo BASE_URL . $caminhoOriginal; ?>" alt="<?php echo $textoAlt; ?>" style="max-width: 100px; height: auto;">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="font-1-s" for="categoria-tipo-imagem">Categoria tipo da imagem <em>*</em></label>
                    <select class="form-select" name="categoria-tipo-imagem" id="categoria-tipo-imagem" value="" required>
                        <option value="" selected>Selecione uma opção</option>
                        <option value="projeto" <?php echo $categoria == 'projeto' ? 'selected' : '' ?>>Projeto</option>
                        <option value="logo" <?php echo $categoria == 'logo' ? 'selected' : '' ?>>Logo</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="font-1-s" for="imagem">Alterar imagem atual<em>*</em></label>
                    <input class="form-control" type="file" name="imagem" id="imagem" value="<?php echo $nomeOriginal ?>">
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