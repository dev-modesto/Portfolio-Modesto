<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/funcoes/funcaoImagem.php';
    include BASE_PATH . '/include/funcoes/db-queries/projeto.php';
    include BASE_PATH . '/include/funcoes/diversas/respostaJson.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $idProjeto = $_POST['id-projeto'];
        $idImagem = $_POST['id-imagem'];
        $nomeTitulo = $_POST['nome-titulo'];
        $textoAlternativo = $_POST['texto-alt'];
        $categoria = 'projeto';
        $tipoImagem = $_POST['tipo-imagem-projeto'];

        $cImagemVerifica = consultarImagens($con, $idImagem);

        try {

            foreach ($cImagemVerifica as $valor) {
                $tipoImagemVerifica = $valor['tipo_imagem'];

                if ($tipoImagemVerifica == 'logo') {

                    if ($tipoImagem !== 'logo') {
                        $cProjetoImagem = cProjetoImagem($con, $idProjeto, $categoria, 'logo');
                        $qntImgLogo = mysqli_num_rows($cProjetoImagem);

                        if ($qntImgLogo == 1) {
                            $mensagem = [
                                'mensagem' => 'Não foi possivel atualizar. O projeto deve haver ao menos uma imagem logo cadastrada.',
                                'id-projeto' => $idProjeto,
                            ];
                            throw new Exception(json_encode($mensagem));
                        }
                    } 
                }
            }

            if (!empty($_FILES['imagem-projeto']['name'])) {

                try {

                    $imagem = $_FILES['imagem-projeto'];
                    $caminhoTemp = $imagem['tmp_name'];

                    $cImagem = consultarImagens($con, $idImagem);

                    foreach ($cImagem as $valor) {
                        $caminhoRelativoImagem = $valor['caminho_original'];
                    }

                    $caminhoRelativo = "/assets/img/projetos/";
                    $caminhoAbsoluto = BASE_PATH . "/assets/img/projetos/";
                    $caminhoPasta = $caminhoAbsoluto;
                    $imagemSalva = salvarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta); 

                    if (is_string($imagemSalva)) {
                        $mensagem = ['mensagem' => $imagemSalva, 'id-projeto' => $idProjeto];
                        throw new Exception(json_encode($mensagem));
                    }

                    $caminhoAbsolutoImagem = BASE_PATH . $caminhoRelativoImagem;
                
                    if (($excluirImagemPasta = excluirImagemPasta($caminhoAbsolutoImagem)) !== true) {
                        $mensagem = ['mensagem' => $excluirImagemPasta, 'id-projeto' => $idProjeto];
                        throw new Exception(json_encode($mensagem));
                    }
                        
                    mysqli_begin_transaction($con);
                    
                    $sql = mysqli_prepare(
                        $con,
                        "UPDATE tbl_imagem 
                        SET 
                            nome_titulo = ?,
                            nome_original = ?,
                            caminho_original = ?,
                            texto_alt = ?,
                            tipo_imagem = ?
                        WHERE id_imagem = '$idImagem'
                    ");
                    
                    mysqli_stmt_bind_param(
                        $sql, 
                        "sssss",
                        $nomeTitulo,
                        $imagemSalva['nome'],
                        $imagemSalva['caminho'],
                        $textoAlternativo,
                        $tipoImagem
                    );
        
                    mysqli_stmt_execute($sql);
                    mysqli_commit($con);
                    $mensagem = ['sucesso' =>  'Imagem alterada com sucesso!', 'id-projeto' => $idProjeto];
                    respostaJson($mensagem);

                } catch (Exception $e) {
                    mysqli_rollback($con);
                    $respDecodificada = json_decode($e -> getMessage());
                    respostaJson($respDecodificada);
                    
                } finally {
                    mysqli_close($con);
                    die();
                }
            } 

            mysqli_begin_transaction($con);

            $sql = mysqli_prepare(
                $con,
                "UPDATE tbl_imagem 
                SET nome_titulo = ?, texto_alt = ?, tipo_imagem = ? 
                WHERE id_imagem = '$idImagem'
            ");
    
            mysqli_stmt_bind_param($sql, 'sss', $nomeTitulo, $textoAlternativo, $tipoImagem);
            mysqli_stmt_execute($sql);
            mysqli_commit($con);

            $mensagem = ['sucesso' => 'Imagem alterada com sucesso!', 'id-projeto' => $idProjeto];
            respostaJson($mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $respDecodificada = json_decode($e -> getMessage());
            respostaJson($respDecodificada);

        } finally {
            mysqli_close($con);
            die();
        }

    } else {
        header('location: index.php');
    }

?>