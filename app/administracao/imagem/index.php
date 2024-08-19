<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/include/menu/sidebar.php";

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
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@200;300;400;500;600;700&family=Roboto:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css"/>
</head>
<body>

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

    <div class="container-button">
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar imagem</button>
    </div>

    <div class="container-principal">
        <div class="container-tabela">
            <table id="myTable" class="table nowrap order-column table-hover text-left">
                <thead class="">
                    <tr>
                        <th scope="col">Nome imagem</th>
                        <th scope="col">Caminho</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Controle</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                        $nroLinha = 1;
                        while($exibe = mysqli_fetch_array($consultaImagem)){
                                $idImagem = $exibe['id_imagem'];

                            ?>
                            <tr data-id-imagem="<?php echo $idImagem ?>">
                                <td><?php echo $exibe['nome']?></td>
                                <td><?php echo $exibe['caminho']?></td>
                                <td><?php echo $exibe['categoria']?></td>
                                <td class="td-icons">
                                    <a class="btn-visualizar-info-imagem icone-controle-visualizar " href="#"><span class="icon-btn-controle material-symbols-rounded">visibility</span></a>
                                    <a class="btn-editar-imagem icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                    <a class="btn-excluir-imagem icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
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
                            <option value="projeto">Projeto</option>
                            <option value="logo">Logo</option>
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