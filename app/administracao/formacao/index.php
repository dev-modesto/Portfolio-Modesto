<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/include/menu/sidebar.php";

    $sql = "SELECT * FROM tbl_formacao";
    $consultaFormacao = mysqli_query($con, $sql);
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
        <button type="button" class="cadastrar-cliente btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="material-symbols-rounded">add</span>Adicionar formação</button>
    </div>

    <div class="container-principal">

        <div class="container-tabela">
            <table id="myTable" class="table nowrap order-column table-hover text-left">
                <thead class="">
                    <tr>
                        <th scope="col">Nome Formação</th>
                        <th scope="col">Institutição</th>
                        <th scope="col">Categoria curso</th>
                        <th scope="col">Total horas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Controle</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                        $nroLinha = 1;
                        while($exibe = mysqli_fetch_array($consultaFormacao)){
                                $idFormacao = $exibe['id_formacao'];

                            ?>
                            <tr data-id-formacao="<?php echo $idFormacao ?>">
                                <td><?php echo $exibe['nome']?></td>
                                <td><?php echo $exibe['instituicao']?></td>
                                <td><?php echo $exibe['categoria_curso']?></td>
                                <td><?php echo $exibe['total_horas']?></td>
                                <td><?php echo $exibe['status']?></td>
                                <td class="td-icons" data-id-formacao="222">
                                    <a class="btn-visualizar-info-cliente icone-controle-visualizar " href="#"><span class="icon-btn-controle material-symbols-rounded">visibility</span></a>
                                    <a class="btn-editar-cliente icone-controle-editar " href="#"><span class="icon-btn-controle material-symbols-rounded">edit</span></a>
                                    <a class="btn-excluir-formacao icone-controle-excluir" href="#"><span class="icon-btn-controle material-symbols-rounded">delete</span></a>
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
                <form class="form-container" action="include/gFormacao.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="nome-formacao">Nome formação <em>*</em></label><br>
                            <input class="form-control" type="text" name="nome-formacao" id="nome-formacao" required>
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" class="font-1-s" for="area-formacao">Área formação <em>*</em></label><br>
                            <select class="form-select" name="area-formacao" id="area-formacao" required>
                                <option value="" selected>Escolha a area de formacao</option>
                                <?php 
                                    $sql = "SELECT * FROM tbl_area_formacao";
                                    $consulta = mysqli_query($con, $sql);
                                    
                                    while($row = mysqli_fetch_assoc($consulta)){
                                        echo "<option value='" . $row['id_area_formacao'] . "'>" . $row['nome'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="instituicao-ensino">Instituição de ensino <em>*</em></label><br>
                        <input class="form-control" type="text" name="instituicao-ensino" id="instituicao-ensino" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="data-inicio">Data Inicio</label><br>
                            <input class="form-control" type="date" name="data-inicio" id="data-inicio">
                        </div>

                        <div class="col-md-6">
                            <label class="font-1-s" for="data-fim">Data Fim</label><br>
                            <input class="form-control" type="date" name="data-fim" id="data-fim">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                            <label class="font-1-s" for="categoria-curso">Categoria do Curso <em>*</em></label><br>
                            <select class="form-select" name="categoria-curso" id="">
                                <option value="" selected>Escolha a area de formacao</option>
                                <option value="Curso Livre">Curso Livre</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Tecnólogo">Tecnólogo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="font-1-s" for="total-horas">Total horas <em>*</em></label><br>
                            <input class="form-control" type="text" name="total-horas" id="total-horas" required>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="img-formacao">Imagem <em>*</em></label><br>
                        <select class="form-select" name="img-formacao" id="img-formacao">
                            <option value="" selected>Escolha a imagem</option>
                            <?php 
                                $sql = "SELECT * FROM tbl_imagem";
                                $consulta = mysqli_query($con, $sql);
                                
                                while($row = mysqli_fetch_assoc($consulta)){
                                    echo "<option value='" . $row['id_imagem'] . "'>" . $row['nome'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="link-certificado">Link Certificado</label><br>
                        <input class="form-control" type="text" name="link-certificado" id="link-certificado">
                    </div>

                    <div class="mb-4">
                        <label class="font-1-s" for="status-curso">Status <em>*</em></label><br>
                        <select class="form-select" name="status" id="" required>
                            <option value="" selected>Defina um status</option>
                            <option value="Concluído">Concluído</option>
                            <option value="Andamento">Andamento</option>
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

    <div class="modalExcluir">
    </div>

</div>

<?php 
    include BASE_PATH . '/include/footer/footer-administracao.php';
?>


<script>

    $(document).ready(function () {
        container = $('.dt-search')[0];
        var label = $(container).find('label')[0];
        var inputElement = $(container).find('input')[0];
        $(label).text('Pesquisar: ');

        $('.btn-excluir-formacao').click(function (e) { 
            e.preventDefault();
            idFormacao = $(this).closest('tr').data('id-formacao');

            $.ajax({
                type: "POST",
                url: "include/eModalExcluirFormacao.php",
                data: {
                    'click-excluir-formacao':true,
                    'idPrincipal':idFormacao
                },
                success: function (response) {
                    $('.modalExcluir').html(response);
                    $('#modalExcluir').modal('show');
                }
            });
        });
    });

</script>