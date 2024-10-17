<?php 
    include '../../../../config/base.php';
    include BASE_PATH . "/funcoes/funcaoImagem.php";
    include BASE_PATH . "/include/funcoes/db-queries/projeto.php";
    include BASE_PATH . "/include/funcoes/db-queries/autor.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $idProjeto = intval($id);
    
        $nomeProjeto = trim($_POST['nome-projeto']);
        $projetoDestaque = $_POST['projeto-destaque'];
        $statusProjeto = $_POST['status-progresso-projeto'];
        $projetoEquipe = $_POST['projeto-equipe-editar'];
        $statusGeralProjeto = $_POST['status-geral-projeto-editar'];

        $tipoProjeto = $_POST['tipo-projeto'];
        $descricaoProjeto = $_POST['descricao-projeto'];
        $descricaoTipoProjeto = $_POST['descricao-tipo-projeto'];

        $idCategoria = $_POST['id-categoria-projeto'];

        if (is_numeric($idCategoria)) {
            $idCategoria = intval($idCategoria);
        
        } else {
            $mensagem['mensagem'] = 'Ocorreu um erro. Não foi possível prosseguir com o cadastro do projeto.';
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
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
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        } 
        
        $idGabriel = cIdgabriel($con);
        
        if($idGabriel === false) {
            $mensagem['mensagem'] = 'O autor Gabriel Modesto não foi encontrado.';
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
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
            $resultadoImagens['logo-projeto'] = salvarImagem($_FILES['logo-projeto'], $caminhoRelativo, $caminhoPasta); 

            $detalhesImagensProjeto['logo-projeto'] = [
                'nome-titulo' => $nomeTituloImgLogo,
                'nome' => $resultadoImagens['logo-projeto']['nome'],
                'caminho' => $resultadoImagens['logo-projeto']['caminho'],
                'texto-alternativo' => $textoAltImgLogo,
                'categoria' => 'projeto',
                'tipo-imagem' => 'logo',
            ];
        } 

        foreach ($resultadoImagens as $chave => $valor) {

            if (is_string($valor)) {

                foreach ($resultadoImagens as $imagem) {
                    if (isset($imagem['caminho'])) {

                        $caminhoImagem = $imagem['caminho'];
                        $caminhoAbsolutoImgSemErro = BASE_PATH . $caminhoImagem;

                        echo $caminhoAbsolutoImgSemErro;
                        excluirImagemPasta($caminhoAbsolutoImgSemErro);
                    } 
                }

                $mensagem['mensagem'] = $valor;
                header('Content-Type: application/json');
                echo json_encode($mensagem);
                die();
            }
        }

        if (!empty($detalhesImagensProjeto)) {
    
            foreach ($detalhesImagensProjeto as $imagem) {
    
                $cProjetoImagem = cProjetoImagem($con, $idProjeto, $imagem['categoria'], $imagem['tipo-imagem']);
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
    
                $cProjetoImagem = cProjetoImagem($con, $idProjeto, $imagem['categoria'], $imagem['tipo-imagem']);
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

        try {

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
                    descricao_tipo_projeto = ?, 
                    id_categoria = ?, 
                    tipo_projeto = ?,
                    dt_desenvolvimento = ?, 
                    id_imagem = ?, 
                    link_deploy = ?, 
                    link_figma = ?,
                    link_repositorio = ?,
                    destaque = ?,
                    status_geral = ?,
                    projeto_equipe = ?,
                    status = ?
                WHERE id_projeto = '$idProjeto'
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "sssissssssssss", 
                $nomeProjeto, 
                $descricaoProjeto, 
                $descricaoTipoProjeto,
                $idCategoria, 
                $tipoProjeto, 
                $dataDesenvolvimento, 
                $idImagem, 
                $linkDeploy,
                $linkFigma, 
                $linkRepositorio,
                $projetoDestaque,
                $statusGeralProjeto,
                $projetoEquipe,
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