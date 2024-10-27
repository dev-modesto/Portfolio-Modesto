<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/dbQuery/imagem.php';
    include BASE_PATH . '/include/funcoes/diversas/respostaJson.php';
    
    if(isset($_POST['tecnologias'])) {

        $sqlMeuIdAutor = "SELECT id_autor FROM tbl_autor WHERE nome LIKE '%gabriel modesto%'";
        $consultaMeuId = mysqli_query($con, $sqlMeuIdAutor);
        $resultadoConsultaMeuId = mysqli_num_rows($consultaMeuId);
        
        try {

            if ($resultadoConsultaMeuId == 0) {
                $mensagem['mensagem'] = 'O autor Gabriel Modesto não foi encontrado.';
                throw new Exception(json_encode($mensagem));
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
            $idCategoria = $_POST['id-categoria-projeto'];

            if (is_numeric($idCategoria)) {
                $idCategoria = intval($idCategoria);
            
            } else {
                $mensagem['mensagem'] = 'Ocorreu um erro. Não foi possível prosseguir com o cadastro do projeto.';
                throw new Exception(json_encode($mensagem));
            }

            $tipoProjeto = $_POST['tipo-projeto'];
            $descricaoProjeto = $_POST['descricao-projeto'];
            $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];
            $dataDesenvolvimento = trim($_POST['data-desenvolvimento']);
            $nomeTituloImgThumbnail = trim($_POST['nome-titulo-img-thumbnail']);
            $nomeTituloImgLogo = trim($_POST['nome-titulo-img-logo']);
            $textoAltImgLogo = trim($_POST['texto-alt-logo']);
            $textoAltImgThumbnail = trim($_POST['texto-alt-thumbnail']);

            $statusGeralProjeto = $_POST['status-geral-projeto'];
            $projetoDestaque = $_POST['projeto-destaque'];
            $statusProjeto = $_POST['status-progresso-projeto'];
            $projetoEquipe = $_POST['projeto-equipe'];

            $caminhoRelativo = "/assets/img/projetos/";
            $caminhoAbsoluto = BASE_PATH . "/assets/img/projetos/";
            $caminhoPasta = $caminhoAbsoluto;
            
            $resultadoImagens = []; 
            $resultadoImagens['logo'] = salvarImagem($_FILES['logo-projeto'], $caminhoRelativo, $caminhoPasta);
            $resultadoImagens['projeto'] = salvarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta);
        
            $mensagem = [];
            foreach ($resultadoImagens as $chave => $valor) {

                if (is_string($valor)) {

                    foreach ($resultadoImagens as $imagem) {
                        if (isset($imagem['caminho'])) {
                            $caminhoImagem = $imagem['caminho'];
                            $caminhoAbsolutoImgSemErro = BASE_PATH . $caminhoImagem;
                            excluirImagemPasta($caminhoAbsolutoImgSemErro);
                        } 
                    }

                    $mensagem['mensagem'] = $valor;
                    throw new Exception(json_encode($mensagem));
                }
            }

            $imagens = [
                [
                    'nome-titulo' => $nomeTituloImgThumbnail,
                    'nome' => $resultadoImagens['projeto']['nome'],
                    'caminho' => $resultadoImagens['projeto']['caminho'],
                    'texto-alternativo' => $textoAltImgThumbnail,
                    'categoria' => 'projeto',
                    'tipo-imagem' => 'thumbnail',
                ],
                [
                    'nome-titulo' => $nomeTituloImgLogo,
                    'nome' => $resultadoImagens['logo']['nome'],
                    'caminho' => $resultadoImagens['logo']['caminho'],
                    'texto-alternativo' => $textoAltImgLogo,
                    'categoria' => 'projeto',
                    'tipo-imagem' => 'logo',
                ]
            ];

            $linkDeploy = trim($_POST['link-deploy']);
            $linkFigma = trim($_POST['link-figma']);
            $linkRepositorio = trim($_POST['link-repositorio']);
            
            mysqli_begin_transaction($con);
        

            $sqlProjeto = mysqli_prepare(
                $con,
                "INSERT INTO tbl_projeto (
                    nome_projeto, 
                    descricao, 
                    descricao_tipo_projeto, 
                    id_categoria,
                    tipo_projeto, 
                    dt_desenvolvimento, 
                    link_deploy, 
                    link_figma,
                    link_repositorio,
                    destaque,
                    status_geral,
                    projeto_equipe,
                    status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
    
            mysqli_stmt_bind_param(
                $sqlProjeto, 
                "sssisssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoTipoProjeto, 
                $idCategoria,
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
                        nome_titulo,
                        nome_original,
                        caminho_original,
                        texto_alt,
                        categoria,
                        tipo_imagem)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");

                mysqli_stmt_bind_param(
                    $sqlImagem, 
                    "ssssss",
                    $imagem['nome-titulo'],
                    $imagem['nome'],
                    $imagem['caminho'],
                    $imagem['texto-alternativo'],
                    $imagem['categoria'],
                    $imagem['tipo-imagem'],
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

            foreach ($arrayAutores as $idAutor) {
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
            $mensagem = ['sucesso' => true, 'mensagem' => 'Projeto gravado com sucesso!'];
            respostaJson($mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            $respDecodificada = json_decode($e -> getMessage(), true);
            respostaJson($respDecodificada);
        
        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }
?>
    