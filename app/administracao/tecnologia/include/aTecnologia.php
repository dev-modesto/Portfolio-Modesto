<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include BASE_PATH . "/funcoes/funcaoImagem.php";
    include BASE_PATH . "/include/funcoes/db-queries/projeto.php";
    include BASE_PATH . "/include/funcoes/db-queries/tecnologia.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id-tecnologia'];
        $idTecnologia = intval($id);
        $idImagem = $_POST['id-imagem'];
        $idImagem = intval($idImagem);

        $nomeTecnologia = $_POST['nome-tecnologia'];
        $habilidade = $_POST['habilidade-editar'];
        $categoria = $_POST['categoria-tecnologia-editar'];

        $imagemOriginal = $_FILES['imagem-original'];
        $imagemPlain = $_FILES['imagem-plain'];

        $caminhoRelativo = "/assets/img/tecnologias/";
        $caminhoAbsoluto = "/Portfolio-Modesto/assets/img/tecnologias/";
        $caminhoPasta = $_SERVER['DOCUMENT_ROOT'] . $caminhoAbsoluto;

        mysqli_begin_transaction($con);
        try {

            if (!empty($imagemOriginal['name'])) {

                $cTecnologiaInfoImagem = cTecnologiaInfoImagem($con, $idTecnologia);
                $array = mysqli_fetch_assoc($cTecnologiaInfoImagem);
                $caminhoOriginalRelativo = $array['caminho_original'];
                $nomeOriginal = $array['nome_original'];
                $caminhoOriginalAbsoluto = BASE_PATH . $caminhoOriginalRelativo;

                if (excluirImagemPasta($caminhoOriginalAbsoluto) == false) {
                    $mensagem['sucesso'] = false;
                    $mensagem['mensagem'] = 'O arquivo não foi localizado. Não foi possível prosseguir com a exclusão.';
                    header('Content-Type: application/json');
                    echo json_encode($mensagem);
                    die();
                }

                $imagemSalvaOriginal = salvarImagem($imagemOriginal, $caminhoRelativo, $caminhoPasta);

                if ($imagemSalvaOriginal == false) {
                    $mensagem['sucesso'] = false;
                    $mensagem['mensagem'] = 'Ocorreu um erro ao salvar a imagem.';
                    header('Content-Type: application/json');
                    echo json_encode($mensagem);
                    die();
                }

                $nomeImagemSalvaOriginal = $imagemSalvaOriginal['nome'];
                $caminhoImgSalvaOriginal = $imagemSalvaOriginal['caminho'];

                $sqlUpdateImagemOriginal = mysqli_prepare(
                    $con, 
                    "UPDATE tbl_imagem 
                    SET 
                        nome_original = ?,
                        caminho_original = ?,
                        categoria = ?
                    WHERE id_imagem = '$idImagem'
                ");

                mysqli_stmt_bind_param(
                    $sqlUpdateImagemOriginal, 
                    'sss',
                    $nomeImagemSalvaOriginal,
                    $caminhoImgSalvaOriginal,
                    $categoria    
                );
                
                mysqli_stmt_execute($sqlUpdateImagemOriginal);
            }

            if (!empty($imagemPlain['name'])) {
                $cTecnologiaInfoImagemPlain = cTecnologiaInfoImagem($con, $idTecnologia);
                $arrayPlain = mysqli_fetch_assoc($cTecnologiaInfoImagemPlain);
                $caminhoPlainRelativo = $arrayPlain['caminho_plain'];
                $nomePlain = $arrayPlain['nome_plain'];
                $caminhoPlainAbsoluto = BASE_PATH . $caminhoPlainRelativo;

                excluirImagemPasta($caminhoPlainAbsoluto);
                $imagemSalvaPlain = salvarImagem($imagemPlain, $caminhoRelativo, $caminhoPasta);
                $nomeImagemSalvaPlain = $imagemSalvaPlain['nome'];
                $caminhoImgSalvaPlain = $imagemSalvaPlain['caminho'];

                $sqlUpdateImagemPlain = mysqli_prepare(
                    $con, 
                    "UPDATE tbl_imagem 
                    SET 
                        nome_plain = ?,
                        caminho_plain = ?,
                        categoria = ?
                    WHERE id_imagem = '$idImagem'
                ");

                mysqli_stmt_bind_param(
                    $sqlUpdateImagemPlain, 
                    'sss',
                    $nomeImagemSalvaPlain,
                    $caminhoImgSalvaPlain,
                    $categoria    
                );
                
                mysqli_stmt_execute($sqlUpdateImagemPlain);
            }

            if (empty($imagemOriginal['name'] || $imagemPlain['name'])) {
                $sqlUpdateCategoria = mysqli_prepare($con, "UPDATE tbl_imagem SET categoria = ? WHERE id_imagem = '$idImagem' ");
                mysqli_stmt_bind_param($sqlUpdateCategoria, 's', $categoria);
                mysqli_stmt_execute($sqlUpdateCategoria);
            }

            $sqlUpdateTecnologia = mysqli_prepare(
                $con, 
                "UPDATE tbl_tecnologia 
                SET nome = ?, visibilidade_habilidades = ?
                WHERE id_tecnologia = '$idTecnologia'
            ");

            mysqli_stmt_bind_param($sqlUpdateTecnologia, 'ss', $nomeTecnologia, $habilidade);
            mysqli_stmt_execute($sqlUpdateTecnologia);
            mysqli_commit($con);

            $mensagem['sucesso'] = true;
            $mensagem['mensagem'] = 'Tecnologia atualizada com sucesso!';
            header('Content-Type: application/json');
            echo json_encode($mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem['mensagem'] = "Ocorreu um erro: " . $e->getMessage();

        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }