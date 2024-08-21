<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idPost = $_POST['id-projeto'];
        $idSessao = $_SESSION['idSessao'];

        if ($idPost !== $idSessao) {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }   
        
        if(is_numeric($idPost)) {
            $idProjeto = intval($idPost);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            die();
        }

        $sql = mysqli_prepare($con, "DELETE FROM tbl_projeto WHERE id_projeto = ? ");
        mysqli_stmt_bind_param($sql, "i", $idProjeto);
        mysqli_stmt_execute($sql);

        $mensagem = 'Excluído com sucesso!';
        header('location: ../index.php?msg=' . $mensagem);

    } else {
        header('Location: ../index.php');
    }

?>



