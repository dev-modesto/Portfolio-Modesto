<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/funcoes/funcaoImagem.php";
    
    if(isset($_POST['tecnologias'])) {

        $sqlMeuIdAutor = "SELECT id_autor FROM tbl_autor WHERE nome LIKE '%gabriel modesto%'";
        $consultaMeuId = mysqli_query($con, $sqlMeuIdAutor);
        $resultadoConsultaMeuId = mysqli_num_rows($consultaMeuId);

        if ($resultadoConsultaMeuId == 0) {
            $mensagem['mensagem'] = 'O autor Gabriel Modesto não foi encontrado.';
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        }

        $tecnologias = explode(',', $_POST['tecnologias']);
        $autores = explode(',', $_POST['autores']);

        $arrayConsultaMeuId = mysqli_fetch_assoc($consultaMeuId);
        $meuIdAutor = $arrayConsultaMeuId['id_autor'];

        array_unshift($autores, $meuIdAutor);
        $arrayAutores = array_filter($autores, function($array) {
            return !empty($array);
        });

        $nomeProjeto = trim($_POST['nome-projeto']);
        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
        $dataDesenvolvimento = trim($_POST['data-desenvolvimento']);
        $textoAlternativo = trim($_POST['texto-alt']);

        $statusGeralProjeto = $_POST['status-geral-projeto'];
        $projetoDestaque = $_POST['projeto-destaque'];
        $statusProjeto = $_POST['status-progresso-projeto'];
        $projetoEquipe = $_POST['projeto-equipe'];

        $caminhoRelativo = "/assets/img/projetos/";
        $caminhoAbsoluto = "/Portfolio-Modesto/assets/img/projetos/";
        $caminhoPasta = $_SERVER['DOCUMENT_ROOT'] . $caminhoAbsoluto;

        $imagemLogoProjeto = salvarImagem($_FILES['logo-projeto'], $caminhoRelativo, $caminhoPasta);
        $imagemProjeto = salvarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta);
        
        $imagens = [
            [
                'nome' => $imagemProjeto['nome'],
                'caminho' => $imagemProjeto['caminho'],
                'texto-alternativo' => $textoAlternativo,
                'categoria' => 'projeto',
            ],
            [
                'nome' => $imagemLogoProjeto['nome'],
                'caminho' => $imagemLogoProjeto['caminho'],
                'texto-alternativo' => '',
                'categoria' => 'logo',
            ]
        ];

        $linkDeploy = trim($_POST['link-deploy']);
        $linkFigma = trim($_POST['link-figma']);
        $linkRepositorio = trim($_POST['link-repositorio']);
        
        mysqli_begin_transaction($con);
        try {

            $sqlProjeto = mysqli_prepare(
                $con,
                "INSERT INTO tbl_projeto (
                    nome_projeto, 
                    descricao, 
                    descricao_tipo_projeto, 
                    tipo_projeto, 
                    dt_desenvolvimento, 
                    link_deploy, 
                    link_figma,
                    link_repositorio,
                    destaque,
                    status_geral,
                    projeto_equipe,
                    status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
    
            mysqli_stmt_bind_param(
                $sqlProjeto, 
                "ssssssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoTipoProjeto, 
                $tipoProjeto, 
                $dataDesenvolvimento, 
                $linkDeploy,
                $linkFigma, 
                $linkRepositorio,
                $projetoDestaque,
                $statusGeralProjeto,
                $projetoEquipe,
                $statusProjeto
            );

            mysqli_stmt_execute($sqlProjeto);
            $idProjeto = mysqli_insert_id($con);

            foreach ($imagens as $imagem) {
                $sqlImagem = mysqli_prepare(
                    $con,
                    "INSERT INTO tbl_imagem(
                        nome_original,
                        caminho_original,
                        texto_alt,
                        categoria)
                    VALUES (?, ?, ?, ?)
                ");

                mysqli_stmt_bind_param(
                    $sqlImagem, 
                    "ssss", 
                    $imagem['nome'],
                    $imagem['caminho'],
                    $imagem['texto-alternativo'],
                    $imagem['categoria']
                );

                mysqli_stmt_execute($sqlImagem);
                $idImagem = mysqli_insert_id($con);

                $sqlImagemProjeto = mysqli_prepare(
                    $con, 
                    "INSERT INTO tbl_imagem_projeto(
                        id_projeto,
                        id_imagem)
                    VALUES (?, ?)
                ");

                mysqli_stmt_bind_param($sqlImagemProjeto, "ii", $idProjeto, $idImagem);
                mysqli_stmt_execute($sqlImagemProjeto);
            }

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

            foreach ($autores as $idAutor) {
                $idAutor = intval($idAutor);

                $sqlAutoresProjeto =
                    mysqli_prepare($con,
                    "INSERT INTO tbl_autor_projeto(
                        id_projeto, 
                        id_autor) 
                    VALUES(?, ?)
                ");
        
                mysqli_stmt_bind_param($sqlAutoresProjeto, 'ii', $idProjeto, $idAutor);
                mysqli_stmt_execute($sqlAutoresProjeto);
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
    