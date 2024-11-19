<?php 
    include '../../../../config/base.php';
    include BASE_PATH . "/include/funcoes/dbQuery/imagem.php";
    include BASE_PATH . "/include/funcoes/dbQuery/projeto.php";
    include BASE_PATH . "/include/funcoes/dbQuery/autor.php";
    include BASE_PATH . '/include/funcoes/diversas/respostaJson.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $idProjeto = intval($id);
    
        $nomeProjeto = trim($_POST['nome-projeto']);
        $projetoDestaque = $_POST['projeto-destaque'];
        $statusProjeto = $_POST['status-progresso-projeto'];
        $projetoEquipe = $_POST['projeto-equipe-editar'];
        $visibilidade = $_POST['visibilidade-projeto-editar'];

        $statusGeralProjeto = $_POST['status-geral-projeto-editar'];

        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];

        $radioDescFuncionalides = $_POST['radio-desc-funcionalidades-editar'];
        $descricaoFuncionalidades = '';

        if ($radioDescFuncionalides == 'Sim') {
            $descricaoFuncionalidades = trim($_POST['descricao-funcionalidades-editar']);
        }

        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];

        $idCategoria = $_POST['id-categoria-projeto'];

        try {

            if (is_numeric($idCategoria)) {
                $idCategoria = intval($idCategoria);
            
            } else {
                $mensagem['mensagem'] = 'Ocorreu um erro. Não foi possível prosseguir com o cadastro do projeto.';
                throw new Exception(json_encode($mensagem));
            }
        
            $dataDesenvolvimento = $_POST['data-desenvolvimento'];
            $imagemProjeto = $_FILES['imagem-projeto'];
            $logoProjeto = $_FILES['logo-projeto'];

            $nomeTituloImgThumbnail = trim($_POST['nome-titulo-img-thumbnail']);
            $nomeTituloImgLogo = trim($_POST['nome-titulo-img-logo']);
            $textoAltImgLogo = trim($_POST['texto-alt-logo']);
            $textoAltImgThumbnail = trim($_POST['texto-alt-thumbnail']);

            $linkDeploy = trim($_POST['link-deploy']);
            $linkFigma = trim($_POST['link-figma']);
            $linkRepositorio = trim($_POST['link-repositorio']);

            $tecnologias = explode(',', $_POST['tecnologias-editar']);
            $tecnologias = array_filter($tecnologias);

            if (empty($tecnologias)) {
                $mensagem['mensagem'] = "Não foi possível atualizar. Nenhuma tecnologia foi selecionada.";
                throw new Exception(json_encode($mensagem));
            } 
            
            $idGabriel = cIdgabriel($con);
            
            if($idGabriel === false) {
                $mensagem['mensagem'] = 'O autor Gabriel Modesto não foi encontrado.';
                throw new Exception(json_encode($mensagem));
            } 
            
            $idAutores = $_POST['autores-editar'];
            $arrayAutores = explode(',', $idAutores);
            
            array_unshift($arrayAutores, $idGabriel);
            $arrayFiltrado = array_filter($arrayAutores, function($array){
                return !empty($array);
            });
            
            $caminhoRelativo = "/assets/img/projetos/";
            $caminhoAbsoluto = BASE_PATH . "/assets/img/projetos/";
            $caminhoPasta = $caminhoAbsoluto;

            $resultadoImagens = []; 
            
            if (!empty($_FILES['imagem-projeto']['name'])) {
                $resultadoImagens['imagem-projeto'] = salvarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta);
            } 
        
            if (!empty($_FILES['logo-projeto']['name'])) {
                $resultadoImagens['logo-projeto'] = salvarImagem($_FILES['logo-projeto'], $caminhoRelativo, $caminhoPasta); 
            } 

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

            if (!empty($_FILES['imagem-projeto']['name'])) {
                $detalhesImagensProjeto['imagem-projeto'] = [
                    'nome-titulo' => $nomeTituloImgThumbnail,
                    'nome' => $resultadoImagens['imagem-projeto']['nome'],
                    'caminho' => $resultadoImagens['imagem-projeto']['caminho'],
                    'texto-alternativo' => $textoAltImgThumbnail,
                    'categoria' => 'projeto',
                    'tipo-imagem' => 'thumbnail'
                ];
            } 

            if (!empty($_FILES['logo-projeto']['name'])) {
                $detalhesImagensProjeto['logo-projeto'] = [
                    'nome-titulo' => $nomeTituloImgLogo,
                    'nome' => $resultadoImagens['logo-projeto']['nome'],
                    'caminho' => $resultadoImagens['logo-projeto']['caminho'],
                    'texto-alternativo' => $textoAltImgLogo,
                    'categoria' => 'projeto',
                    'tipo-imagem' => 'logo',
                ];
                
            } 

            if (!empty($detalhesImagensProjeto)) {
        
                foreach ($detalhesImagensProjeto as $imagem) {
                    $tipoImagemProjeto = [$imagem['tipo-imagem']];
                    $cProjetoImagem = cProjetoImagem($con, $idProjeto, $imagem['categoria'], $tipoImagemProjeto);
                    $qntImagemEncontrada = mysqli_num_rows($cProjetoImagem);

                    if ($qntImagemEncontrada !== 0) {
                        $arrayImagem = mysqli_fetch_assoc($cProjetoImagem);
                        $idImagem = $arrayImagem['id_imagem'];
                        $caminhoRelativoImagem = $arrayImagem['caminho_original'];
                        $caminhoAbsolutoImagem = BASE_PATH . $caminhoRelativoImagem;
                        excluirImagemPasta($caminhoAbsolutoImagem);

                        $sql = mysqli_prepare(
                            $con, 
                            "UPDATE tbl_imagem 
                            SET 
                                nome_titulo = ?,
                                nome_original = ?,
                                caminho_original = ?,
                                texto_alt = ?,
                                categoria = ?,
                                tipo_imagem = ?
                            WHERE id_imagem = '$idImagem'
                        ");
                            
                        mysqli_stmt_bind_param(
                            $sql, 
                            'ssssss', 
                            $imagem['nome-titulo'],
                            $imagem['nome'],
                            $imagem['caminho'],
                            $imagem['texto-alternativo'],
                            $imagem['categoria'],
                            $imagem['tipo-imagem']
                        );
                        mysqli_stmt_execute($sql);

                    } else {

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
                }

            } else {

                $detalhesImagensProjeto = [
                    'imagem-projeto' => [
                        'nome-titulo' => $nomeTituloImgThumbnail,
                        'texto-alternativo' => $textoAltImgThumbnail,
                        'categoria' => 'projeto',
                        'tipo-imagem' => 'thumbnail'
                    ],
                    
                    'logo-projeto' => [
                        'nome-titulo' => $nomeTituloImgLogo,
                        'texto-alternativo' => $textoAltImgLogo,
                        'categoria' => 'projeto',
                        'tipo-imagem' => 'logo',
                    ]
                ];

                foreach ($detalhesImagensProjeto as $imagem) {
                    $tipoImagemProjeto = [$imagem['tipo-imagem']];
        
                    $cProjetoImagem = cProjetoImagem($con, $idProjeto, $imagem['categoria'], $tipoImagemProjeto);

                    $qntImagemEncontrada = mysqli_num_rows($cProjetoImagem);

                    if ($qntImagemEncontrada !== 0) {
                        $arrayImagem = mysqli_fetch_assoc($cProjetoImagem);
                        $idImagem = $arrayImagem['id_imagem'];
    
                        $sql = mysqli_prepare(
                            $con, 
                            "UPDATE tbl_imagem 
                            SET 
                                nome_titulo = ?,
                                texto_alt = ?,
                                categoria = ?,
                                tipo_imagem = ?
                            WHERE id_imagem = '$idImagem'
                        ");
                        
                        mysqli_stmt_bind_param(
                            $sql, 
                            'ssss', 
                            $imagem['nome-titulo'], 
                            $imagem['texto-alternativo'], 
                            $imagem['categoria'], 
                            $imagem['tipo-imagem']
                        );
                        mysqli_stmt_execute($sql);
                    }
                }
            }

            $sqlRemoverAutores = mysqli_prepare($con, "DELETE FROM tbl_autor_projeto WHERE id_projeto = ?");
            mysqli_stmt_bind_param($sqlRemoverAutores, "i", $idProjeto);
            mysqli_stmt_execute($sqlRemoverAutores);
    
            foreach ($arrayFiltrado as $id) {
                $idAutor = intval($id);
    
                $sql =
                mysqli_prepare($con,
                    "INSERT INTO tbl_autor_projeto(
                        id_projeto, 
                        id_autor) 
                    VALUES(?, ?)
                ");
    
                mysqli_stmt_bind_param($sql, 'ii', $idProjeto, $idAutor);
                mysqli_stmt_execute($sql);
            }

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
                    descricao_funcionalidades = ?,
                    descricao_tipo_projeto = ?, 
                    id_categoria = ?, 
                    tipo_projeto = ?,
                    dt_desenvolvimento = ?, 
                    id_imagem = ?, 
                    link_deploy = ?, 
                    link_figma = ?,
                    link_repositorio = ?,
                    destaque = ?,
                    visibilidade = ?,
                    status_geral = ?,
                    projeto_equipe = ?,
                    status = ?
                WHERE id_projeto = '$idProjeto'
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "ssssisssssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoFuncionalidades,
                $descricaoTipoProjeto,
                $idCategoria, 
                $tipoProjeto, 
                $dataDesenvolvimento, 
                $idImagem, 
                $linkDeploy,
                $linkFigma, 
                $linkRepositorio,
                $projetoDestaque,
                $visibilidade,
                $statusGeralProjeto,
                $projetoEquipe,
                $statusProjeto
            );

            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem['sucesso'] = true;
            $mensagem['mensagem'] = "Alterado com sucesso!";
            respostaJson($mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            $respDecodificada = json_decode($e -> getMessage());
            respostaJson($respDecodificada);
        
        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }

?>