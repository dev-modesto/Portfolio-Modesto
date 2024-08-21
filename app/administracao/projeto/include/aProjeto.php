<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    ARQUIVO_CONEXAO;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nomeProjeto = trim($_POST['nome-projeto']);
        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
        $dataDesenvolvimento = trim($_POST['data-desenvolvimento']);
        $idImagem = trim($_POST['img-formacao']);
        $linkDeploy = trim($_POST['link-deploy']);
        $linkFigma = trim($_POST['link-figma']);
        $linkRepositorio = trim($_POST['link-repositorio']);
    
        mysqli_begin_transaction($con);
        try {

            $sql = mysqli_prepare(
                $con,
                "UPDATE tbl_projeto
                SET 
                    nome_projeto = ?, 
                    descricao = ?, 
                    descricao_tipo_projeto = ?, 
                    tipo_projeto = ?, 
                    dt_desenvolvimento = ?, 
                    id_imagem = ?, 
                    link_deploy = ?, 
                    link_figma = ?,
                    link_repositorio = ?
                WHERE id_projeto = '$id'
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "sssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoTipoProjeto, 
                $tipoProjeto, 
                $dataDesenvolvimento, 
                $idImagem, 
                $linkDeploy,
                $linkFigma, 
                $linkRepositorio
            );

            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem = "Alterado com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = "Não foi possível realizar a alteração. Ocorreu um erro: " . $e->getMessage();
            header('Location: ../index.php?msgInvalida=' . $mensagem);

        }
    } else {
        header('Location: ../index.php');
    }

?>