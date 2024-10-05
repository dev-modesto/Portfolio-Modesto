<?php 
    include '../../../../config/base.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeFormacao = trim($_POST['nome-formacao']);
        $idAreaFormacao = $_POST['area-formacao'];
        $instituicaoEnsino = trim($_POST['instituicao-ensino']);
        $dataInicio = trim($_POST['data-inicio']);
        $dataFim = trim($_POST['data-fim']);
        $categoriaCurso = trim($_POST['categoria-curso']);
        $totalHoras = trim($_POST['total-horas']);
        $idImagem = trim($_POST['img-formacao']);
        $linkCertificado = trim($_POST['link-certificado']);
        $statusCurso = trim($_POST['status']);
    
        $idAreaFormacaoConvertido = intval($idAreaFormacao);
    
        mysqli_begin_transaction($con);
        try {

            $sql = mysqli_prepare(
                $con,
                "INSERT INTO tbl_formacao (
                    nome, 
                    id_area_formacao, 
                    instituicao, 
                    dt_inicio, 
                    dt_fim, 
                    categoria_curso, 
                    total_horas, 
                    id_imagem,
                    link_certificado, 
                    status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "sisssssiss", 
                $nomeFormacao, 
                $idAreaFormacao, 
                $instituicaoEnsino, 
                $dataInicio, 
                $dataFim, 
                $categoriaCurso, 
                $totalHoras,
                $idImagem, 
                $linkCertificado, 
                $statusCurso
            );
    
            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem = "Formação gravada com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "Ocorreu um erro: " . $e->getMessage();
        }
    }
    ?>
    