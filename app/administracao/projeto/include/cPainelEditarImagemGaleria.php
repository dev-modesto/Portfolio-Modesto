<?php
    include '../../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    include BASE_PATH . '/include/funcoes/db-queries/imagem.php';

    if(isset($_POST['click-editar-imagem-galeria'])) {
        $idProjeto = $_POST['idProjeto'];
        $idImagem = $_POST['idImagem'];

        $consultaImagens = cImagens($con, $idImagem);

        foreach ($consultaImagens as $valor) {
            $nomeTitulo = $valor['nome_titulo'];
            $textoAlternativo = $valor['texto_alt'];
            $tipoImagem = $valor['tipo_imagem'];
        }
?>

    <form class="form-container" id="form-img-galeria-editar" method="post" enctype="multipart/form-data">
        <input type="text" name="id-imagem" id="id-imagem" value="<?= $idImagem ?>" hidden>
        <input type="text" name="id-projeto" id="id-projeto" value="<?= $idProjeto ?>" hidden>
        <div class="">
            <h1 class="fs-4 mb-4">Editar imagem</h1>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <label class="font-1-s" for="imagem-projeto">Carregar nova imagem</label>
                <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <label class="font-1-s" for="nome-titulo">Título<em>*</em></label><br>
                <input class="form-control" type="text" name="nome-titulo" id="nome-titulo" value="<?= $nomeTitulo ?>" required>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <label class="font-1-s" for="texto-alt">Texto alt.<em>*</em></label><br>
                <input class="form-control" type="text" name="texto-alt" id="texto-alt" value="<?= $textoAlternativo ?>" required>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <label class="font-1-s" for="tipo-imagem-projeto">Tipo <em>*</em></label><br>
                <div class="container-check">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo-imagem-projeto-thumbnail">Thumbnail</label>
                        <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-thumbnail" value="thumbnail" <?= $tipoImagem == 'thumbnail' ? 'checked' : '' ?>>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo-imagem-projeto-logo">Logo</label>
                        <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-logo" value="logo" <?= $tipoImagem == 'logo' ? 'checked' : '' ?> >
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo-imagem-projeto-extra">Extra</label>
                        <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-extra" value="extra" <?= $tipoImagem == 'extra' ? 'checked' : '' ?>>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-button-galeria form-container-button">
            <button type="button" class="col btn btn-secondary btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
            <button class='col btn btn-primary btn-salvar' type="submit">Salvar</button>
        </div>
    </form>

<?php
    
    } else {
        header('location: ../index.php');
    }
?>

<script>

    $('#form-img-galeria-editar').submit(function (e) { 
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "aImagemGaleria.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                const idProjeto = response['id-projeto'];

                if (response.sucesso) {
                    window.location.href = `../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=${idProjeto}&msg=`+ encodeURIComponent(response.sucesso);

                } else {
                    window.location.href = `../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=${idProjeto}&msgInvalida=`+ encodeURIComponent(response.mensagem);
                }
            },
            error: function (response) {
                window.location.href = `../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=${idProjeto}&msgInvalida=Ocorreu um error. Não foi possível atualizar a imagem.`;
            }
        });

    });

</script>