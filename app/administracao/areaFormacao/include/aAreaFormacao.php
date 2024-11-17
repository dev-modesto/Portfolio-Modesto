<?php 
    include '../../../../config/base.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nomeAreaFormacao = $_POST['area-formacao'];
        isset($_POST['exibir-filtro']) == null ? $exibirFiltro = 'Nao' : $exibirFiltro = 'Sim'; 

        mysqli_begin_transaction($con);

        try {
            $sql = 
                mysqli_prepare(
                $con, 
                "UPDATE tbl_area_formacao
                SET 
                    nome = ?,
                    exibir_filtro = ?
                WHERE id_area_formacao = '$id'
            ");

            mysqli_stmt_bind_param($sql, 'ss', $nomeAreaFormacao, $exibirFiltro);
            mysqli_stmt_execute($sql);
            mysqli_commit($con);
            $mensagem = 'Alterado com sucesso!';
            header('Location: ../index.php?msg=' . $mensagem);
            
        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = "Não foi possível realizar a alteração. Ocorreu um erro: " . $e->getMessage();
            header('Location: ../index.php?msgInvalida=' . $mensagem);
            
        } finally {
            mysqli_close($con);
        }

    } else {
        header('Location: ../index.php');
    }

?>