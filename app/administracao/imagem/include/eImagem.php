<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include BASE_PATH . '/funcoes/funcaoImagem.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idPost = $_POST['id-imagem'];
        $idSessao = $_SESSION['idSessao'];

        if ($idPost !== $idSessao) {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }   
        
        if(is_numeric($idPost)) {
            $idImagem = intval($idPost);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            die();
        }

        $sqlImagemConsulta = mysqli_prepare(
            $con, 
            "SELECT 
                id_imagem,
                caminho_original
            FROM tbl_imagem
            WHERE id_imagem = ? "
        );

        mysqli_stmt_bind_param($sqlImagemConsulta, "i", $idImagem);
        mysqli_stmt_execute($sqlImagemConsulta);
        $result = mysqli_stmt_get_result($sqlImagemConsulta);
        $array = mysqli_fetch_assoc($result);

        $caminhoImagemOriginalRelativo = $array['caminho_original'];
        $caminhoImagemOriginalAbsoluto = BASE_PATH . $caminhoImagemOriginalRelativo;

        $sql = mysqli_prepare($con, "DELETE FROM tbl_imagem WHERE id_imagem = ?");
        mysqli_stmt_bind_param($sql, "i", $idImagem);
        mysqli_stmt_execute($sql);

        excluirImagemPasta($caminhoImagemOriginalAbsoluto);
        $mensagem = 'Excluído com sucesso!';
        header('location: ../index.php?msg=' . $mensagem);

    } else {
        header('location: ../index.php');
    }

?>