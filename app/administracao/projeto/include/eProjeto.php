<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
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

            $sqlImagemProjeto = mysqli_prepare(
                $con, 
                "SELECT 
                    p.id_imagem,
                    i.caminho_original
                FROM tbl_imagem_projeto p 
                INNER JOIN tbl_imagem i
                ON p.id_imagem = i.id_imagem 
                WHERE id_projeto = ? "
            );

            mysqli_stmt_bind_param($sqlImagemProjeto, "i", $idProjeto);
            mysqli_stmt_execute($sqlImagemProjeto);
            $result = mysqli_stmt_get_result($sqlImagemProjeto);
            $arrayImagens = mysqli_fetch_all($result, MYSQLI_ASSOC);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            die();
        }

        mysqli_begin_transaction($con);
        try {

            $sql = mysqli_prepare($con, "DELETE FROM tbl_projeto WHERE id_projeto = ? ");
            mysqli_stmt_bind_param($sql, "i", $idProjeto);
            mysqli_stmt_execute($sql);

            foreach ($arrayImagens as $caminho) {
                $idImagemProjeto = $caminho['id_imagem'];
                $caminhoImagemRelativo = $caminho['caminho_original'];
                $caminhoImagemAbsoluto = BASE_PATH . $caminhoImagemRelativo;

                $sqlImagem = mysqli_prepare($con, "DELETE FROM tbl_imagem WHERE id_imagem = ? ");
                mysqli_stmt_bind_param($sqlImagem, "i", $idImagemProjeto);
                mysqli_stmt_execute($sqlImagem);
    
                excluirImagemPasta($caminhoImagemAbsoluto);
            }

            $mensagem = 'Excluído com sucesso!';
            header('location: ../index.php?msg=' . $mensagem);
            mysqli_commit($con);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = "Ocorreu um erro. Não foi possível excluir." . $e->getMessage();
            header('location: ../index.php?msgInvalida=' . $mensagem);

        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }

?>



