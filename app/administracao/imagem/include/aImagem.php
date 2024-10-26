<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/funcoes/funcaoImagem.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $categoriaTipoImagem = trim($_POST['categoria-tipo-imagem']);
        $nomeTitulo = trim($_POST['titulo-imagem']);
        $imagemEnvio = $_FILES['imagem'];
        $nomeImagemEnvio = $imagemEnvio['name'];

        $consultaImagens = cImagens($con, $id);

        $arrayImagem = mysqli_fetch_assoc($consultaImagens);
        $nomeOriginal = $arrayImagem['nome_original'];
        $caminhoImagemOriginalRelativo = $arrayImagem['caminho_original'];
        $caminhoImagemOriginalAbsoluto = BASE_PATH . $caminhoImagemOriginalRelativo;

        if ($nomeImagemEnvio == "") {

            mysqli_begin_transaction($con);
                
            try {

                $sql = mysqli_prepare(
                    $con,
                    "UPDATE tbl_imagem 
                    SET nome_titulo = ?, categoria = ? 
                    WHERE id_imagem = '$id'
                ");
        
                mysqli_stmt_bind_param(
                    $sql, 
                    "ss", 
                    $nomeTitulo,
                    $categoriaTipoImagem
                );
        
                mysqli_stmt_execute($sql);

                mysqli_commit($con);
                $mensagem = "Informações alteradas com sucesso!";
                header('location: ../index.php?msg=' . $mensagem);
                die();

            } catch (Exception $e) {
                mysqli_rollback($con);
                echo "Ocorreu um erro: " . $e->getMessage();
                die();

            }  finally {
                mysqli_close($con);
                die();
            }
        }

        if ($nomeImagemEnvio !== "") {

            if ($nomeImagemEnvio == $nomeOriginal) {
                echo 'nome da imagem é igual. Imagem ja cadastrada!';
                $mensagem = 'Não foi possível alterar. Esta imagem já foi cadastrada.';
                header("location: ../index.php?msgInvalida=" . $mensagem);
                die();

            } else {

                if (!file_exists($caminhoImagemOriginalAbsoluto)) {
                    echo 'Imagem não foi encontrada.';
                    $mensagem = 'Não foi possível alterar. A imagem não foi encontrada.';
                    header('location: ../index.php?msgInvalida=' . $mensagem);
                    die();
                } 

                $caminhoRelativo = "/assets/img/instituicoes/";
                $caminhoAbsoluto = BASE_PATH . "/assets/img/instituicoes/";
                $caminhoPasta = $caminhoAbsoluto;

                $infoImagemSalva = salvarImagem($imagemEnvio, $caminhoRelativo, $caminhoPasta);
                $nomeImagemSalva = $infoImagemSalva['nome'];
                $caminhoRelativoImagemSalva = $infoImagemSalva['caminho'];

                mysqli_begin_transaction($con);
                
                try {

                    $sql = mysqli_prepare(
                        $con,
                        "UPDATE tbl_imagem 
                        SET 
                            nome_titulo = ?,
                            nome_original = ?, 
                            caminho_original = ?, 
                            categoria = ?
                        WHERE id_imagem = '$id'
                    ");
            
                    mysqli_stmt_bind_param(
                        $sql, 
                        "ssss", 
                        $nomeTitulo,
                        $nomeImagemSalva, 
                        $caminhoRelativoImagemSalva, 
                        $categoriaTipoImagem
                    );
            
                    mysqli_stmt_execute($sql);

                    excluirImagemPasta($caminhoImagemOriginalAbsoluto);

                    mysqli_commit($con);
                    $mensagem = "Informações alteradas com sucesso!";
                    header('location: ../index.php?msg=' . $mensagem);

                } catch (Exception $e) {
                    mysqli_rollback($con);
                    echo "Ocorreu um erro: " . $e->getMessage();

                } finally {
                    mysqli_close($con);
                }
            }

        } 
        
    } else {
        header('location: ../index.php');
    }
?>
    