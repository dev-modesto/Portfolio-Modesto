<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
    
    if (isset($_POST['click-editar-imagem'])) {
        $id = $_POST['idPrincipal'];

        $consultaImagens = cImagens($con, $id);
        $arrayImagens = mysqli_fetch_assoc($consultaImagens);
        $nomeTitulo = $arrayImagens['nome_titulo'];
        $nomeOriginal = $arrayImagens['nome_original'];
        $caminhoOriginal = $arrayImagens['caminho_original'];
        $textoAlt = $arrayImagens['texto_alt'];
        $categoria = $arrayImagens['categoria'];

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
                    <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                    
                    <div class="mb-4">
                        <label class="font-1-s" for="imagem">Imagem atual <em>*</em></label>
                        <div>
                            <img src="<?= BASE_URL . $caminhoOriginal; ?>" alt="<?= $textoAlt; ?>" style="max-width: 100px; height: auto;">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="categoria-tipo-imagem-editar">Categoria tipo da imagem <em>*</em></label>
                        <select class="form-select" name="categoria-tipo-imagem" id="categoria-tipo-imagem-editar" value="" required>
                            <option value="instituicao" <?= $categoria == 'instituicao' ? 'selected' : '' ?>>Instituição</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="titulo-imagem-editar">Título img logo<em>*</em></label>
                        <input class="form-control" type="text" name="titulo-imagem" id="titulo-imagem-editar" value="<?= $nomeTitulo ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="imagem-editar">Alterar imagem atual<em>*</em></label>
                        <input class="form-control" type="file" name="imagem" id="imagem-editar" value="<?= $nomeOriginal ?>">
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