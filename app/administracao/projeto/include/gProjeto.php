<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/funcoes/funcaoImagem.php";
    
    if(isset($_POST['tecnologias'])) {
        $tecnologias = explode(',', $_POST['tecnologias']);

        $nomeProjeto = trim($_POST['nome-projeto']);
        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
        $dataDesenvolvimento = trim($_POST['data-desenvolvimento']);

        $caminhoRelativo = "/assets/img/projetos/";
        $caminhoAbsoluto = "/Portfolio-Modesto/assets/img/projetos/";
        $caminhoPasta = $_SERVER['DOCUMENT_ROOT'] . $caminhoAbsoluto;
        
        $imagemProjeto = processarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta);
        
        $nomeImagemProjeto = $imagemProjeto['nome'];
        $caminhoImagemProjeto = $imagemProjeto['caminho'];
        $categoriaTipoImagem = 'projeto';
        
        $linkDeploy = trim($_POST['link-deploy']);
        $linkFigma = trim($_POST['link-figma']);
        $linkRepositorio = trim($_POST['link-repositorio']);
        
        mysqli_begin_transaction($con);
        try {

            $sqlImagem = mysqli_prepare(
                $con,
                "INSERT INTO tbl_imagem(
                    nome_original,
                    caminho_original,
                    categoria)
                VALUES (?, ?, ?)
            ");

            mysqli_stmt_bind_param(
                $sqlImagem, 
                "sss", 
                $nomeImagemProjeto,
                $caminhoImagemProjeto,
                $categoriaTipoImagem
            );

            mysqli_stmt_execute($sqlImagem);

            $idImagem = mysqli_insert_id($con);

            $sqlProjeto = mysqli_prepare(
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
                $sqlProjeto, 
                "sssssisss", 
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

            mysqli_stmt_execute($sqlProjeto);
            $idProjeto = mysqli_insert_id($con);

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
    
            mysqli_commit($con);
            $mensagem['sucesso'] = true;
            $mensagem['mensagem'] = "Projeto gravado com sucesso!";
            header('Content-Type: application/json');
            echo json_encode($mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem['mensagem'] = "Ocorreu um erro: " . $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($mensagem);
        
        } finally {
            mysqli_close($con);
        }

    } else {
        $mensagem['mensagem'] = 'Nenhuma tecnologia foi escolhida.';
        header('Content-Type: application/json');
        echo json_encode($mensagem);
        mysqli_close($con);
    }
?>
    