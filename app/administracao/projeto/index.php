<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/include/menu/sidebar.php";

    $sql = "SELECT * FROM tbl_projeto";
    $consultaProjeto = mysqli_query($con, $sql);
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
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
        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Cadastrar projeto</button>
    </div>

    <div class="container-principal">
        <div class="container-tabela">
            <table id="myTable" class="table nowrap order-column table-hover text-left">
                <thead class="">
                    <tr>
                        <th scope="col">Nome Projeto</th>
                        <th scope="col">Tipo projeto</th>
                        <th scope="col">Data lançamento</th>
                        <th scope="col">Controle</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                        $nroLinha = 1;
                        while($exibe = mysqli_fetch_array($consultaProjeto)){
                                $idProjeto = $exibe['id_projeto'];

                            ?>
                            <tr data-id-projeto="<?php echo $idProjeto ?>">
                                <td><?php echo $exibe['nome_projeto']?></td>
                                <td><?php echo $exibe['tipo_projeto']?></td>
                                <td><?php echo $exibe['dt_desenvolvimento']?></td>
                                <td class="td-icons">
                                    <a class="btn-visualizar-info-projeto icone-controle-visualizar " href="#"><span class="icon-btn-controle material-symbols-rounded">visibility</span></a>
                                    <a class="btn-editar-projeto icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                    <a class="btn-excluir-projeto icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

    <div class="modal modal-lg fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar projeto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form class="form-container" action="include/gProjeto.php" method="post">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s nome-projeto" for="nome-formacao">Nome projeto <em>*</em></label><br>
                            <input class="form-control" type="text" name="nome-projeto" id="nome-projeto" required>
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" class="font-1-s" for="tipo-projeto">Tipo projeto <em>*</em></label>
                            <select class="form-select" name="tipo-projeto" id="tipo-projeto" required>
                                <option value="" selected>Escolha o tipo de projeto</option>
                                <option value="livre">Livre</option>
                                <option value="academico">Acadêmico</option>
                                <option value="profissional">Profissional</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="data-desenvolvimento">Data desenvolvimento <em>*</em></label><br>
                            <input class="form-control" type="date" name="data-desenvolvimento" id="data-desenvolvimento">
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" for="img-formacao">Imagem <em>*</em></label>
                            <select class="form-select" name="img-formacao" id="img-formacao">
                                <option value="" selected>Escolha a imagem</option>
                                <?php 
                                    $sql = "SELECT * FROM tbl_imagem WHERE categoria = 'projeto'";
                                    $consulta = mysqli_query($con, $sql);
                                    
                                    while($row = mysqli_fetch_assoc($consulta)){
                                        echo "<option value='" . $row['id_imagem'] . "'>" . $row['nome'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="descricao-projeto">Descrição <em>*</em></label>
                        <textarea class="form-control descricao-projeto" name="descricao-projeto" id="descricao-projeto"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="descricao-tipo-projeto">Descrição tipo de projeto <em>*</em></label>
                        <textarea class="form-control" name="descricao-tipo-projeto" id="descricao-tipo-projeto"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-deploy">Link Deploy</label>
                        <input class="form-control" type="text" name="link-deploy" id="link-deploy">
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-figma">Link Figma</label>
                        <input class="form-control" type="text" name="link-figma" id="link-figma">
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-repositorio">Link repositório Github</label>
                        <input class="form-control" type="text" name="link-repositorio" id="link-repositorio">
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

    <div class="modalExcluir modalEditarProjeto">
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footer-administracao.php';
?>