<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    ARQUIVO_CONEXAO;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nomeAutor = trim($_POST['nome-autor']);
        $linkLinkedin = trim($_POST['link-linkedin']);
        $linkGithub = trim($_POST['link-github']);

        mysqli_begin_transaction($con);

        try {
            $sql = 
                mysqli_prepare(
                $con, 
                "UPDATE tbl_autor
                SET 
                    nome = ?,
                    link_linkedin = ?,
                    link_github = ?
                WHERE id_autor = '$id'
            ");

            mysqli_stmt_bind_param($sql, 'sss', $nomeAutor, $linkLinkedin, $linkGithub);
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