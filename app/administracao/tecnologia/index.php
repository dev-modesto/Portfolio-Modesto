<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/funcoes/funcaoImagem.php';
    include BASE_PATH . '/include/funcoes/db-queries/tecnologia.php';
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@200;300;400;500;600;700&family=Roboto:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"/>

    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/componentes.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/global.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/navbar.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-lateral.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-top.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/tabela.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/modal.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/pre-loader.css">
</head>
<body>
<?php
    include BASE_PATH . '/include/pre-load/pre-load.php';
    include BASE_PATH . "/include/menu/sidebar.php";
?>

<div class="conteudo">

    <?php
        mensagemValida();
        mensagemInvalida();
    ?>

    <div class="container-button">
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar tecnologia</button>
    </div>

    <div class="container-tecnologias">
        <?php
            
            $cTecnologia = cTecnologia($con);
            $cTecnologiaArray = mysqli_fetch_all($cTecnologia, MYSQLI_ASSOC);

            foreach ($cTecnologiaArray as $valor) {
                $idTecnologia = $valor['id_tecnologia'];
                $idImagem = $valor['id_imagem'];
                $nomeTecnologia = $valor['nome'];
                $visibilidadeHabilidades = $valor['visibilidade_habilidades'];
                $indicadorClass = $visibilidadeHabilidades === 'visivel' ? 'sim' : '';
                
                $consultaImagem = cImagens($con, $idImagem);
                foreach ($consultaImagem as $valor) {
                    $caminhoOriginal = $valor['caminho_original'];
                }

                ?>
                <div class="card card-imagem-view"  style="width: 18rem;">
                    <div class="card-titulo">
                        <h6 class="titulo-imagem"><?= $nomeTecnologia?></h6>
                    </div>
                    <div class="card-body imagem">
                        <div class="card-container-imagem">
                            <img src="<?= BASE_URL . $caminhoOriginal?>" alt="">
                        </div>
                        <div class="rodape-button-imagem">
                            <p><span class="indicador-skill <?= $indicadorClass ?>"></span>Skill</p>
                            <div class="gap-2 container-button-imagem" data-id-tecnologia="<?= $idTecnologia ?>">
                                <a class="btn-editar-tecnologia icone-controle-editar" href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                <a class="btn-excluir-tecnologia icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        ?>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar tec. ou ferramenta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="form-container" action="include/gTecnologia.php" method="post" enctype="multipart/form-data">

                    <div class="mb-4">
                        <label class="font-1-s" for="nome-tecnologia">Nome <em>*</em></label>
                        <input class="form-control" type="text" name="nome-tecnologia" id="nome-tecnologia" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="habilidade">Exibir em Habilidades?<em>*</em></label><br>
                        <div class="container-check">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="habilidade-nao">Não</label>
                                <input class="form-check-input" type="radio" name="habilidade" id="habilidade-nao" value="oculto" checked>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="habilidade-sim">Sim</label>
                                <input class="form-check-input" type="radio" name="habilidade" id="habilidade-sim" value="visivel">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="categoria-tecnologia">Categoria<em>*</em></label><br>
                        <div class="container-check">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="categoria-tecnologia-tec">Tecnologia</label>
                                <input class="form-check-input" type="radio" name="categoria-tecnologia" id="categoria-tecnologia-tec" value="tecnologia" checked>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="categoria-tecnologia-ferramenta">Ferramenta</label>
                                <input class="form-check-input" type="radio" name="categoria-tecnologia" id="categoria-tecnologia-ferramenta" value="ferramenta">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="font-1-s" for="imagem-original">Img. Original <em>*</em></label>
                        <input class="form-control" type="file" name="imagem-original" id="imagem-original" required>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="imagem-plain">Img. Plain (simplificada) <em>*</em></label>
                        <input class="form-control" type="file" name="imagem-plain" id="imagem-plain" required>
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

    <div class="modalExcluir modalEditarTecnologia">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footer-administracao.php';
?>