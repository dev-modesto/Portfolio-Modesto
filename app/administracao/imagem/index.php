<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';

    $tituloPaginaHead = 'Imagens | Administração | devModesto';
    $tituloPagina = 'Imagens';
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

    <div class="container-principal">

        <div class="container-button logos">
            <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar img Instituição</button>
        </div>

        <div class="container-imagem">
            <?php
                $categoriaImagem = ['instituicao'];
                $consultaImagens = cImagens($con, null, $categoriaImagem);
                $arrayImagem = mysqli_fetch_all($consultaImagens, MYSQLI_ASSOC);
                foreach ($arrayImagem as $valorImg) {
                    $idImagem = $valorImg['id_imagem'];
                    $nomeTitulo = $valorImg['nome_titulo'];
                    $nomeImagem = $valorImg['nome_original'];
                    $caminhoOriginal = $valorImg['caminho_original'];
                    $categoriaImgagem = $valorImg['categoria'];
                    $caminhoAbsolutoImagem = BASE_PATH . $caminhoOriginal;

                ?>
                    <div class="card card-imagem-view"  style="width: 18rem;">
                        <div class="card-titulo">
                            <h6 class="titulo-imagem"><?= $nomeTitulo?></h6>
                        </div>
                        <div class="card-body imagem">
                            <div class="card-container-imagem">
                                <img src="<?= BASE_URL . $caminhoOriginal?>" alt="">
                            </div>
                            <div class="gap-2 container-button-imagem" data-id-imagem="<?= $idImagem ?>">
                                <a class="btn-editar-imagem icone-controle-editar" href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                <a class="btn-excluir-imagem icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                            </div>
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>
           
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar imagem</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="form-container" action="include/gImagem.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="font-1-s" for="imagem">Img logo <em>*</em></label>
                        <input class="form-control" type="file" name="imagem" id="imagem" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="font-1-s" for="titulo-imagem">Título img logo<em>*</em></label>
                        <input class="form-control" type="text" name="titulo-imagem" id="titulo-imagem" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="categoria-tipo-imagem">Categoria tipo da imagem <em>*</em></label>
                        <select class="form-select" name="categoria-tipo-imagem" id="categoria-tipo-imagem" value="" required>
                            <option value="" selected>Selecione uma opção</option>
                            <option value="instituicao">Instituição</option>
                        </select>
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

    <div class="modalExcluir modalEditarImagem">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>