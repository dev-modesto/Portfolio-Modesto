<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    include BASE_PATH . '/include/funcoes/db-queries/tecnologia.php';
    
    if (isset($_POST['click-editar-tecnologia'])) {
        $idTecnologia = $_POST['idPrincipal'];
        $cTecnologiaImagem = cTecnologiaInfoImagem($con, $idTecnologia);
        $array = mysqli_fetch_assoc($cTecnologiaImagem);

        $nomeTecnologia = $array['nome'];
        $idImagem = $array['id_imagem'];
        $visibilidadeHabilidade = $array['visibilidade_habilidades'];
        $caminhoOriginal = $array['caminho_original'];
        $nomePlain = $array['nome_plain'];
        $caminhoPlain = $array['caminho_plain'];
        $categoria = $array['categoria'];
        $textoAlt = 'imagem da tecnologia/ferramenta: ' . $nomeTecnologia;

    } else {
        header('Location: ../index.php');
    }
?>

<div class="modal fade" id="modalEditarTecnologia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarTecnologia" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditarTecnologia">Editar tec. ou ferramenta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form class="form-container" id="form-tecnologia-editar" enctype="multipart/form-data">
                <input type="text" name="id-tecnologia" id="id-tecnologia" value="<?php echo $idTecnologia ?>" hidden>
                <input type="text" name="id-imagem" id="id-imagem" value="<?php echo $idImagem ?>" hidden>
                <div class="mb-4">
                    <label class="font-1-s" for="nome-tecnologia">Nome <em>*</em></label>
                    <input class="form-control" type="text" name="nome-tecnologia" id="nome-tecnologia" value="<?php echo $nomeTecnologia ?>" required>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="habilidade">Exibir em Habilidades?<em>*</em></label><br>
                    <div class="container-check">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="habilidade-nao-editar">Não</label>
                            <input class="form-check-input" type="radio" name="habilidade-editar" id="habilidade-nao-editar" value="oculto" <?php echo $visibilidadeHabilidade == 'oculto' ? 'checked' : '' ?>>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="habilidade-sim-editar">Sim</label>
                            <input class="form-check-input" type="radio" name="habilidade-editar" id="habilidade-sim-editar" value="visivel" <?php echo $visibilidadeHabilidade == 'visivel' ? 'checked' : '' ?>>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="categoria-tecnologia">Categoria<em>*</em></label><br>
                    <div class="container-check">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="categoria-tecnologia-tec-editar">Tecnologia</label>
                            <input class="form-check-input" type="radio" name="categoria-tecnologia-editar" id="categoria-tecnologia-tec-editar" value="tecnologia" <?php echo $categoria == 'tecnologia' ? 'checked' : '' ?>>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="categoria-tecnologia-ferramenta-editar">Ferramenta</label>
                            <input class="form-check-input" type="radio" name="categoria-tecnologia-editar" id="categoria-tecnologia-ferramenta-editar" value="ferramenta" <?php echo $categoria == 'ferramenta' ? 'checked' : '' ?>>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="font-1-s" for="imagem">Img. Original atual  <em>*</em></label>
                        <div>
                            <img src="<?php echo BASE_URL . $caminhoOriginal; ?>" alt="<?php echo $textoAlt; ?>" style="max-width: 100px; height: auto;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="font-1-s" for="imagem">Img. Plain atual<em>*</em></label>
                        <div>
                            <img src="<?php echo BASE_URL . $caminhoPlain; ?>" alt="<?php echo $textoAlt; ?>" style="max-width: 100px; height: auto;">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="imagem-original">Img. Original</label>
                    <input class="form-control" type="file" name="imagem-original" id="imagem-original">
                </div>

                <div class="mb-4">
                    <label class="font-1-s" for="imagem-plain">Img. Plain (simplificada)</label>
                    <input class="form-control" type="file" name="imagem-plain" id="imagem-plain">
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

<script>

    $(document).ready(function () {

        $('#form-tecnologia-editar').submit(function (e) { 
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "include/aTecnologia.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (response.sucesso) {
                        window.location.href = '../tecnologia/index.php?msg=' + encodeURIComponent(response.mensagem);
                    } else {
                        window.location.href = '../tecnologia/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                    }          
                },

                error: function(response) {
                    window.location.href = '../tecnologia/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                }
            });
        });
        
    });
</script>