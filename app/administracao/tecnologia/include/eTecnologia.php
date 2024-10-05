<?php 
    include '../../../../config/base.php';
    include BASE_PATH . "/funcoes/funcaoImagem.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idPost = $_POST['id-tecnologia'];
        $idSessao = $_SESSION['idSessao'];

        if ($idPost !== $idSessao) {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }   

        if(is_numeric($idPost)) {
            $idTecnologia = intval($idPost);

            $sqlImagemTecnologia = mysqli_prepare(
                $con, 
                "SELECT 
                    t.id_imagem,
                    i.caminho_original,
                    i.caminho_plain
                FROM tbl_tecnologia t
                INNER JOIN tbl_imagem i
                ON t.id_imagem = i.id_imagem 
                WHERE id_tecnologia = ? "
            );

            mysqli_stmt_bind_param($sqlImagemTecnologia, "i", $idTecnologia);
            mysqli_stmt_execute($sqlImagemTecnologia);
            $result = mysqli_stmt_get_result($sqlImagemTecnologia);
            $array = mysqli_fetch_assoc($result);

            $idImagemTecnologia = $array['id_imagem'];
            $caminhoImagemOriginalRelativo = $array['caminho_original'];
            $caminhoImagemPlainRelativo = $array['caminho_plain'];

            $caminhoImagemOriginalAbsoluto = BASE_PATH . $caminhoImagemOriginalRelativo;
            $caminhoImagemPlainAbsoluto = BASE_PATH . $caminhoImagemPlainRelativo;
            
        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            die();
        }

        mysqli_begin_transaction($con);

        try {

            $sql = mysqli_prepare($con, "DELETE FROM tbl_tecnologia WHERE id_tecnologia = ? ");
            mysqli_stmt_bind_param($sql, "i", $idTecnologia);
            mysqli_stmt_execute($sql);

            $sqlImagem = mysqli_prepare($con, "DELETE FROM tbl_imagem WHERE id_imagem = ? ");
            mysqli_stmt_bind_param($sqlImagem, "i", $idImagemTecnologia);
            mysqli_stmt_execute($sqlImagem);

            excluirImagemPasta($caminhoImagemOriginalAbsoluto);
            excluirImagemPasta($caminhoImagemPlainAbsoluto);

            $mensagem = 'Excluído com sucesso!';
            header('location: ../index.php?msg=' . $mensagem);
            mysqli_commit($con);
            die();

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



