<?php 
    include '../../../../config/base.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idPost = $_POST['id-autor'];
        $idSessao = $_SESSION['idSessao'];

        if ($idPost !== $idSessao) {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }   
        
        if(is_numeric($idPost)) {
            $idAutor = intval($idPost);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            die();
        }

        $sql = mysqli_prepare($con, "DELETE FROM tbl_autor WHERE id_autor = ? ");
        mysqli_stmt_bind_param($sql, "i", $idAutor);
        mysqli_stmt_execute($sql);

        $mensagem = 'Excluído com sucesso!';
        header('location: ../index.php?msg=' . $mensagem);

    } else {
        header('Location: ../index.php');
    }

?>



