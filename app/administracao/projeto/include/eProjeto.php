<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/funcoes/funcaoImagem.php";
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
                FROM tbl_projeto p
                INNER JOIN tbl_imagem i
                ON p.id_imagem = i.id_imagem 
                WHERE id_projeto = ? "
            );

            mysqli_stmt_bind_param($sqlImagemProjeto, "i", $idProjeto);
            mysqli_stmt_execute($sqlImagemProjeto);
            $result = mysqli_stmt_get_result($sqlImagemProjeto);
            $array = mysqli_fetch_assoc($result);

            $idImagemProjeto = $array['id_imagem'];
            $caminhoImagemRelativo = $array['caminho_original'];
            $caminhoImagemAbsoluto = BASE_PATH . $caminhoImagemRelativo;

            excluirImagemPasta($caminhoImagemAbsoluto);

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



