<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeProjeto = trim($_POST['nome-projeto']);
        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
        $dataDesenvolvimento = trim($_POST['data-desenvolvimento']);
        $idImagem = trim($_POST['img-formacao']);
        $linkDeploy = trim($_POST['link-deploy']);
        $linkFigma = trim($_POST['link-figma']);
        $linkRepositorio = trim($_POST['link-repositorio']);
    
        $formacaoDados = array(
            'nome do projeto' => $nomeProjeto,
            'tipo projeto' => $tipoProjeto,
            'descricao projeto' => $descricaoProjeto,
            'descricao tipo projeto' => $descricaoTipoProjeto,
            'data desenvolvimento' => $dataDesenvolvimento,
            'id imagem' => $idImagem,
            'link deploy' => $linkDeploy,
            'link figma' => $linkFigma,
            'link repositorio' => $linkRepositorio,
        );
    
        echo '<pre>';
        print_r($formacaoDados);
        echo '</pre>';

        var_dump($tipoProjeto);

        mysqli_begin_transaction($con);
        try {

            $sql = mysqli_prepare(
                $con,
                "INSERT INTO tbl_projeto (
                    nome_projeto, 
                    descricao, 
                    descricao_tipo_projeto, 
                    tipo_projeto, 
                    dt_desenvolvimento, 
                    id_imagem, 
                    link_deploy, 
                    link_figma,
                    link_repositorio)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
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
            $mensagem = "Projeto gravado com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "Ocorreu um erro: " . $e->getMessage();
        }
    }
?>
    