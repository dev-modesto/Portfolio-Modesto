<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/config/base.php";
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nomeFormacao = trim($_POST['nome-formacao']);
        $idAreaFormacao = $_POST['area-formacao'];
        $instituicaoEnsino = trim($_POST['instituicao-ensino']);
        $dtInicio = $_POST['data-inicio'];
        $dtConclusao = $_POST['data-fim'];
        $categoriaCurso = trim($_POST['categoria-curso']);
        $totalHoras = trim($_POST['total-horas']);
        $idImgFormacao = $_POST['img-formacao'];
        $linkCertificado = trim($_POST['link-certificado']);
        $statusCurso = trim($_POST['status']);

        mysqli_begin_transaction($con);

        try {
            $sql = 
                mysqli_prepare(
                $con, 
                "UPDATE tbl_formacao
                SET nome = ?,
                    id_area_formacao = ?,
                    instituicao = ?, 
                    dt_inicio = ?, 
                    dt_fim = ?, 
                    categoria_curso = ?, 
                    total_horas = ?, 
                    id_imagem = ?,
                    link_certificado = ?,
                    status = ?
                WHERE id_formacao = '$id'
            ");

            mysqli_stmt_bind_param($sql, 'sisssssiss', $nomeFormacao, $idAreaFormacao, $instituicaoEnsino, $dtInicio, $dtConclusao, $categoriaCurso, $totalHoras, $idImgFormacao, $linkCertificado, $statusCurso);
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