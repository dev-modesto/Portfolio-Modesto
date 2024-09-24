<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include BASE_PATH . '/funcoes/funcaoImagem.php';

    $sql = "SELECT * FROM tbl_imagem";
    $consultaImagem = mysqli_query($con, $sql);

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

    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/componentes.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/global/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/global/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/navbar/navbar-lateral.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/navbar/navbar-top.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/tabela.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/modal.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/pre-loader.css">
</head>
<body>
<?php
    include BASE_PATH . '/include/pre-load/pre-load.php';
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/include/menu/sidebar.php";
?>

<div class="conteudo">

    <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> '. $msg .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        if(isset($_GET['msgInvalida'])){
            $msg = $_GET['msgInvalida'];
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> '. $msg .' 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>

    <div class="container-principal">
 
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="logos-tab" data-bs-toggle="tab" data-bs-target="#logos" type="button" role="tab" aria-controls="logos" aria-selected="true">Instituições</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tecnologias-ferramentas-tab" data-bs-toggle="tab" data-bs-target="#tecnologias-ferramentas" type="button" role="tab" aria-controls="tecnologias-ferramentas" aria-selected="false">Tec./Ferramentas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="projetos-logos-tab" data-bs-toggle="tab" data-bs-target="#projetos-logos" type="button" role="tab" aria-controls="projetos-logos" aria-selected="false">Projetos/logos</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="logos" role="tabpanel" aria-labelledby="logos-tab" tabindex="0">

                <div class="container-button logos">
                    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar img Instituição</button>
                </div>

                <div class="container-imagem">
                    <?php
                        $arrayImagem = consultarImagens($con, 'instituicao');
                        foreach ($arrayImagem as $valorImg) {
                            $idImagem = $valorImg['id_imagem'];
                            $nomeImagem = $valorImg['nome_original'];
                            $caminhoOriginal = $valorImg['caminho_original'];
                            $categoriaImgagem = $valorImg['categoria'];
                            $caminhoAbsolutoImagem = BASE_PATH . $caminhoOriginal;

                        ?>
                            <div class="card card-imagem-view"  style="width: 18rem;">
                                <div class="card-titulo">
                                    <h6 class="titulo-imagem"><?php echo $nomeImagem?></h6>
                                </div>
                                <div class="card-body imagem">
                                    <div class="card-container-imagem">
                                        <img src="<?php echo BASE_URL . $caminhoOriginal?>" alt="">
                                    </div>
                                    <div class="gap-2 container-button-imagem" data-id-imagem="<?php echo $idImagem ?>">
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

            <div class="tab-pane" id="tecnologias-ferramentas" role="tabpanel" aria-labelledby="tecnologias-ferramentas-tab" tabindex="0">
                <div class="container-imagem">
                    <?php
                        $arrayImagem = consultarImagens($con, 'tecnologia', 'ferramenta');
                        foreach ($arrayImagem as $valorImg) {
                            $idImagem = $valorImg['id_imagem'];
                            $nomeImagem = $valorImg['nome_original'];
                            $caminhoOriginal = $valorImg['caminho_original'];
                            $categoriaImgagem = $valorImg['categoria'];
                            $caminhoAbsolutoImagem = BASE_PATH . $caminhoOriginal;

                        ?>
                            <div class="card card-imagem-view"  style="width: 18rem;">
                                <div class="card-titulo">
                                    <h6 class="titulo-imagem"><?php echo $nomeImagem?></h6>
                                </div>
                                <div class="card-body imagem">
                                    <div class="card-container-imagem">
                                        <img src="<?php echo BASE_URL . $caminhoOriginal?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            
            <div class="tab-pane" id="projetos-logos" role="tabpanel" aria-labelledby="projetos-logos-tab" tabindex="0">
                <div class="container-imagem">
                    <?php
                        $arrayImagem = consultarImagens($con, 'projeto', 'logo');
                        foreach ($arrayImagem as $valorImg) {
                            $idImagem = $valorImg['id_imagem'];
                            $nomeImagem = $valorImg['nome_original'];
                            $caminhoOriginal = $valorImg['caminho_original'];
                            $categoriaImgagem = $valorImg['categoria'];
                            $caminhoAbsolutoImagem = BASE_PATH . $caminhoOriginal;

                        ?>
                            <div class="card card-imagem-view"  style="width: 18rem;">
                                <div class="card-titulo">
                                    <h6 class="titulo-imagem"><?php echo $nomeImagem?></h6>
                                </div>
                                <div class="card-body imagem">
                                    <div class="card-container-imagem">
                                        <img src="<?php echo BASE_URL . $caminhoOriginal?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
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
    include BASE_PATH . '/include/footer/footer-administracao.php';
?>