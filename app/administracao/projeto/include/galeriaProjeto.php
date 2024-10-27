<?php
    include '../../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';

    if(isset($_GET['click-galeria-projeto'])) {
        $idProjeto = $_GET['id-projeto'];

        $cProjeto = cProjeto($con, $idProjeto);
        $arrayProjeto = mysqli_fetch_assoc($cProjeto);
        $nomeProjeto = $arrayProjeto['nome_projeto'];

    } else {
        header('location: ../index.php');
    }

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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/componentes.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/global.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/global/navbar.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-lateral.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/navbar/navbar-top.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/projetos/projetos.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/projetos/galeriaImagemProjeto.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/tabela.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/modal.css">
    <link rel="stylesheet" href="<?=BASE_URL?>/css/componentes/pre-loader.css">
</head>
<body>
<?php
    include BASE_PATH . '/include/preLoad/preLoad.php';
    include_once BASE_PATH . "/include/menu/sidebar.php";
?>

<div class="conteudo">

    <?php
        mensagemValida();
        mensagemInvalida();
    ?>

    <div class="container-header-titulo-galeria">
        <h1 class="font-1-titulo-adm peso-semi-bold">Galeria do projeto - <?=$nomeProjeto?> </h1>
    </div>
    <div class="container-galeria">
        <div class="conteudo-imagem">
            <?php
        
                $cImagemProjeto = cProjetoImagem($con, $idProjeto);

                foreach ($cImagemProjeto as $valor) {
                    $nomeImagem = $valor['nome_titulo'];
                    $caminhoOriginal = $valor['caminho_original'];
                    $idImagem = $valor['id_imagem'];

                    ?>
                        <div class="card card-imagem-view"  style="width: 18rem;">
                            <div class="card-titulo">
                                <h6 class="titulo-imagem"><?= $nomeImagem?></h6>
                            </div>
                            <div class="card-body imagem">
                                <div class="card-container-imagem galeria">
                                    <img src="<?= BASE_URL . $caminhoOriginal?>" alt="">
                                </div>
                                <div class="gap-2 container-button-imagem" data-id-imagem="<?= $idImagem ?>" data-id-projeto="<?= $idProjeto ?>">
                                    <a class="btn-visualizar-imagem-galeria icone-controle-visualizar " href="#"><span class="icon-btn-controle material-symbols-rounded">visibility</span></a>
                                    <a class="btn-editar-imagem-galeria icone-controle-editar" href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                    <a class="btn-excluir-imagem-galeria icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>

        <div class="container-info">
            <form class="form-container" id="form-img-galeria-cadastro" method="post" enctype="multipart/form-data">
                <input type="text" name="id-projeto" id="id-projeto" value="<?= $idProjeto ?>" hidden>
                <div class="">
                    <h1 class="fs-4 mb-4">Cadastrar imagem</h1>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <label class="font-1-s" for="imagem-projeto">Imagem<em>*</em></label>
                        <input class="form-control" type="file" name="imagem-projeto" id="imagem-projeto" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <label class="font-1-s" for="nome-titulo">Título<em>*</em></label><br>
                        <input class="form-control" type="text" name="nome-titulo" id="nome-titulo" required>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <label class="font-1-s" for="texto-alt">Texto alt.<em>*</em></label><br>
                        <input class="form-control" type="text" name="texto-alt" id="texto-alt" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <label class="font-1-s" for="tipo-imagem-projeto">Tipo<em>*</em></label><br>
                        <div class="container-check">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="tipo-imagem-projeto-thumbnail">Thumbnail</label>
                                <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-thumbnail" value="thumbnail" checked>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="tipo-imagem-projeto-logo">Logo</label>
                                <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-logo" value="logo">
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="tipo-imagem-projeto-extra">Extra</label>
                                <input class="form-check-input" type="radio" name="tipo-imagem-projeto" id="tipo-imagem-projeto-extra" value="extra">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-button-galeria form-container-button">
                    <button class='col btn btn-primary cadastrar' type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modalExcluirImagemGaleria">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>

<script>
    
    $(document).ready(function () {
        $('#form-img-galeria-cadastro').submit(function (e) { 
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "gImagemGaleria.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    const idProjeto = response['id-projeto'];

                    if (response.sucesso) {
                        window.location.href = `../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=${idProjeto}&msg=`+ encodeURIComponent(response.mensagem);

                    } else {
                         window.location.href = `../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=${idProjeto}&msgInvalida=`+ encodeURIComponent(response.mensagem);
                    }
                }
            });
        });

        $('.btn-editar-imagem-galeria').click(function (e) { 
            e.preventDefault();

            const idImagem = $(this).closest('div').data('id-imagem');
            const idProjeto = $(this).closest('div').data('id-projeto');

            $.ajax({
                type: "POST",
                url: "cPainelEditarImagemGaleria.php",
                data: {
                    'click-editar-imagem-galeria':true,
                    'idImagem': idImagem,
                    'idProjeto': idProjeto                 
                },
                success: function (response) {
                    $('.container-info').html(response);
                }
            });
        });
    });

</script>