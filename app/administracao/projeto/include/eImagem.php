<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/projeto.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $idImagem = $_POST['id-imagem'];

        $sql = mysqli_prepare($con, "SELECT * FROM tbl_imagem_projeto WHERE id_imagem = ?");
        mysqli_stmt_bind_param($sql, "i", $idImagem);
        mysqli_stmt_execute($sql);
        $resultado = mysqli_stmt_get_result($sql);
        $arrayImagemProjeto = mysqli_fetch_assoc($resultado);
        $idProjeto = $arrayImagemProjeto['id_projeto'];

        if(is_numeric($idImagem)) {
            $idImagem = intval($idImagem);

        } else {
            $mensagem = 'Ocorreu um erro. Não foi possível prosseguir com a exclusão.';
            header('location: ../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=' . $idProjeto . '&msg=' . $mensagem);
            die();
        }

        $sqlImagemConsulta = mysqli_prepare(
            $con, 
            "SELECT 
                id_imagem,
                caminho_original
            FROM tbl_imagem
            WHERE id_imagem = ? 
            ");

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
        header('location: ../include/galeriaProjeto.php?click-galeria-projeto=true&id-projeto=' . $idProjeto . '&msg=' . $mensagem);

    } else {
        header('location: ../index.php');
    }

?>