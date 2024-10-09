<?php 
    include '../../../../config/base.php';

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idPost = $_POST['id-categoria-projeto'];
        
        if(is_numeric($idPost)) {
            $idCategoriaProjeto = intval($idPost);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }

        mysqli_begin_transaction($con);

        try {

            $sql = mysqli_prepare($con, "DELETE FROM tbl_categoria_projeto WHERE id_categoria = ?");
            mysqli_stmt_bind_param($sql, "i", $idCategoriaProjeto);
            mysqli_stmt_execute($sql);
            mysqli_commit($con);
            $mensagem = 'Excluído com sucesso!';
            header('location: ../index.php?msg=' . $mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = 'Ocorreu um error: ' . $e->getMessage();
            header('location: ../index.php?msgInvalida=' . $mensagem);
        
        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }

?>