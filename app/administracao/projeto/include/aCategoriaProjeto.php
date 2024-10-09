<?php 
    include '../../../../config/base.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idCategoria = $_POST['id'];

        if(is_numeric($idCategoria)) {
            $idCategoria = intval($idCategoria);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }
       
        $nomeCategoria = trim($_POST['nome-categoria']);

        if(preg_match('/\d/', $nomeCategoria)) {
            $mensagem = 'Error. Não é possível o envio de caracteres com númericos.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        } 

        mysqli_begin_transaction($con);

        try {
  
            $sql = mysqli_prepare($con, "UPDATE tbl_categoria_projeto SET nome = ? WHERE id_categoria = ?");
            mysqli_stmt_bind_param($sql, 'si', $nomeCategoria, $idCategoria);
            mysqli_stmt_execute($sql);
            
            mysqli_commit($con);
            $mensagem = 'Categoria de projeto atualizada com sucesso!';
            header('location: ../index.php?msg=' . $mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = 'Ocorreu um error: ' . $e->getMessage();
            header('location: ../index.php?msgInvalida=' . $mensagem);

        } finally {
            mysqli_close($con);
        }

    } else {
        header('Location: ../index.php');
    }

?>