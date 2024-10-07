<?php 
    include '../../../../config/base.php';

    if (isset($_POST['nome-categoria'])) {
        $nomeCategoria = trim($_POST['nome-categoria']);

        if(preg_match('/\d/', $nomeCategoria)) {
            $mensagem = 'Error. Não é possível o envio de caracteres com númericos.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        } 

        mysqli_begin_transaction($con);

        try {
  
            $sql = mysqli_prepare($con, "INSERT INTO tbl_categoria_projeto (nome) VALUES (?)");
            mysqli_stmt_bind_param($sql, 's', $nomeCategoria);
            mysqli_stmt_execute($sql);
            
            mysqli_commit($con);
            $mensagem = 'Categoria de projeto gravada com sucesso!';
            header('location: ../index.php?msg=' . $mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = 'Ocorreu um error: ' . $e->getMessage();

        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }

?>