<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/funcoes/funcaoImagem.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $idProjeto = $_POST['id-projeto'];
        $idImagem = $_POST['id-imagem'];
        $nomeTitulo = $_POST['nome-titulo'];
        $textoAlternativo = $_POST['texto-alt'];
        $categoria = 'projeto';
        $tipoImagem = $_POST['tipo-imagem-projeto'];

        if (!empty($_FILES['imagem-projeto']['name'])) {
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
                $mensagem['mensagem'] = $imagemSalva;
                header('Content-Type: application/json');
                echo json_encode($mensagem);
                die();
            }

            $caminhoAbsolutoImagem = BASE_PATH . $caminhoRelativoImagem;
           
            if (($excluirImagemPasta = excluirImagemPasta($caminhoAbsolutoImagem)) !== true) {
                $mensagem['sucesso'] = false;
                $mensagem['mensagem'] = $excluirImagemPasta;
                header('Content-Type: application/json');
                echo json_encode($mensagem);
                die();
            }
                
            mysqli_begin_transaction($con);

            try {
                
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
                $mensagem['id-projeto'] = $idProjeto;
                $mensagem['sucesso'] = "Imagem alterada com sucesso!";
                $mensagem['id-projeto'] = $idProjeto;
                header('Content-Type: application/json');
                echo json_encode($mensagem);

            } catch (Exception $e) {
                mysqli_rollback($con);
                $mensagem['mensagem'] = 'Ocorreu um error: ' . $e->getMessage();
                $mensagem['id-projeto'] = $idProjeto;
                header('Content-Type: application/json');
                echo json_encode($mensagem);

            } finally {
                mysqli_close($con);
                die();
            }
        } 

        mysqli_begin_transaction($con);

        try {

            $sql = mysqli_prepare(
                $con,
                "UPDATE tbl_imagem 
                SET nome_titulo = ?, texto_alt = ?, tipo_imagem = ? 
                WHERE id_imagem = '$idImagem'
            ");
    
            mysqli_stmt_bind_param($sql, 'sss', $nomeTitulo, $textoAlternativo, $tipoImagem);
            mysqli_stmt_execute($sql);
            mysqli_commit($con);
            $mensagem['sucesso'] = "Imagem alterada com sucesso!";
            $mensagem['id-projeto'] = $idProjeto;
            header('Content-Type: application/json');
            echo json_encode($mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem['mensagem'] = 'Ocorreu um error: ' . $e->getMessage();
            $mensagem['id-projeto'] = $idProjeto;
            header('Content-Type: application/json');
            echo json_encode($mensagem);
        }

    } else {
        header('location: index.php');
    }

?>