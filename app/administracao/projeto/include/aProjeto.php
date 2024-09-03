<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    ARQUIVO_CONEXAO;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $idProjeto = intval($id);
    
        $nomeProjeto = trim($_POST['nome-projeto']);
        $projetoDestaque = $_POST['projeto-destaque'];
        $statusProjeto = $_POST['status-progresso-projeto'];
        $statusGeralProjeto = $_POST['status-geral-projeto-editar'];

        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
        $dataDesenvolvimento = $_POST['data-desenvolvimento'];
        $textoAlternativo = trim($_POST['texto-alt']);
        $imagemProjeto = $_FILES['imagem-projeto'];
        $logoProjeto = $_FILES['logo-projeto'];

        $linkDeploy = trim($_POST['link-deploy']);
        $linkFigma = trim($_POST['link-figma']);
        $linkRepositorio = trim($_POST['link-repositorio']);

        $tecnologias = explode(',', $_POST['tecnologias-editar']);
        $tecnologias = array_filter($tecnologias);

        if (empty($tecnologias)) {
            $mensagem['mensagem'] = "Não foi possível atualizar. Nenhuma tecnologia foi selecionada.";
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        } 

        mysqli_begin_transaction($con);

        try {

            $sqlRemoverTecnologias = mysqli_prepare($con, "DELETE FROM tbl_tecnologia_projeto WHERE id_projeto = ? ");
            mysqli_stmt_bind_param($sqlRemoverTecnologias, "i", $idProjeto);
            mysqli_stmt_execute($sqlRemoverTecnologias);

            foreach ($tecnologias as $id) {
                $idTecnologia = intval($id);

                $sqlTecnologiaProjeto =
                mysqli_prepare($con,
                    "INSERT INTO tbl_tecnologia_projeto(
                        id_projeto, 
                        id_tecnologia) 
                    VALUES(?, ?)
                ");

                mysqli_stmt_bind_param($sqlTecnologiaProjeto, 'ii', $idProjeto, $idTecnologia);
                mysqli_stmt_execute($sqlTecnologiaProjeto);

            }

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
                    link_repositorio = ?,
                    destaque = ?,
                    status_geral = ?,
                    status = ?
                WHERE id_projeto = '$idProjeto'
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "ssssssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoTipoProjeto, 
                $tipoProjeto, 
                $dataDesenvolvimento, 
                $idImagem, 
                $linkDeploy,
                $linkFigma, 
                $linkRepositorio,
                $projetoDestaque,
                $statusGeralProjeto,
                $statusProjeto
            );

            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem['sucesso'] = true;
            $mensagem['mensagem'] = "Alterado com sucesso!";
            header('Content-Type: application/json');
            echo json_encode($mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem['mensagem'] = "Ocorreu um erro: " . $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($mensagem);

        }
    } else {
        $mensagem['mensagem'] = "Nenhum post realizado.";
        header('Content-Type: application/json');
        echo json_encode($mensagem);
    }

?>