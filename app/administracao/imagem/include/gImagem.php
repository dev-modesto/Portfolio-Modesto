<?php 
    include '../../../../config/base.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoriaTipoImagem = trim($_POST['categoria-tipo-imagem']);
        $nomeTitulo = trim($_POST['titulo-imagem']);
    
        if (isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];
            $nomeImagem = $imagem['name'];
            $caminhoTemporario = $imagem['tmp_name'];
            $tamanhoArquivo = $imagem['size'];
            $erroUpload = $imagem['error'];

            if ($categoriaTipoImagem == 'projeto') {
                $caminhoRelativo = "/assets/img/projetos/";
                $caminhoPasta = BASE_PATH . "/assets/img/projetos/";
                
            } else {
                $caminhoRelativo = "/assets/img/instituicoes/";
                $caminhoPasta = BASE_PATH . "/assets/img/instituicoes/";
            }
            
            $caminhoPastaSalvar = $caminhoPasta . $nomeImagem ;
            $nomeCaminhoRelativo = $caminhoRelativo . $nomeImagem ;

            $salvarImg = move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar);

        } else {
            $mensagem = 'Nenhuma imagem enviada.';
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }

        mysqli_begin_transaction($con);
    
        try {

            $sql = mysqli_prepare(
                $con,
                "INSERT INTO tbl_imagem (
                    nome_titulo,
                    nome_original, 
                    caminho_original, 
                    categoria)
                VALUES (?, ?, ?, ?)
            ");
    
            mysqli_stmt_bind_param(
                $sql, 
                "ssss", 
                $nomeTitulo,
                $nomeImagem, 
                $nomeCaminhoRelativo, 
                $categoriaTipoImagem
            );
    
            mysqli_stmt_execute($sql);
    
            mysqli_commit($con);
            $mensagem = "Imagem salva com sucesso!";
            header('location: ../index.php?msg=' . $mensagem);
        
        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "Ocorreu um erro: " . $e->getMessage();

        } finally {
            mysqli_close($con);
        }

    } else {
        header('Location: ../index.php');
    }
?>
    