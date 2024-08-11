<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";

    if ($_POST['area-formacao']) {
        $nomeAreaFormacao = trim($_POST['area-formacao']);

        mysqli_begin_transaction($con);

        try {

            $sql = mysqli_prepare(
                $con,
                "INSERT INTO tbl_area_formacao(nome)
                VALUES(?)
            ");

            mysqli_stmt_bind_param($sql, "s", $nomeAreaFormacao);
            mysqli_stmt_execute($sql);
            mysqli_commit($con);
            $mensagem = "Gravado com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "Ocorreu um error: " . $e->getMessage();
        }

    }
?>