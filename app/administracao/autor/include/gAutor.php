<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = trim($_POST['nome-autor']);
        $linkLinkedin = trim($_POST['link-linkedin']);
        $linkGithub = trim($_POST['link-github']);

        $formacaoDados = array(
            'Nome autor' => $nome,
            'Linkedin' => $linkLinkedin,
            'Github' => $linkGithub,
        );
    
        mysqli_begin_transaction($con);

        try {

            $sql = mysqli_prepare(
                $con,
                "INSERT INTO tbl_autor (
                    nome, 
                    link_linkedin, 
                    link_github)
                VALUES (?, ?, ?)
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "sss", 
                $nome, 
                $linkLinkedin, 
                $linkGithub 
            );
    
            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem = "Informações do autor salvas com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "Ocorreu um erro: " . $e->getMessage();
        }
    }
?>
    