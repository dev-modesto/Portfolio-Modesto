<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/config/base.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Portfolio-Modesto/funcoes/funcaoImagem.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeTecnologia = $_POST['nome-tecnologia'];
        $categoriaTipoImagem = $_POST['categoria-tecnologia'];
        $habilidade = $_POST['habilidade'];
        $imagens = [
            'imagem-original' => [],
            'imagem-plain' => []
        ];
        
        try {
            $caminhoRelativo = "/assets/img/tecnologias/";
            $caminhoAbsoluto = "/Portfolio-Modesto/assets/img/tecnologias/";
            $caminhoPasta = $_SERVER['DOCUMENT_ROOT'] . $caminhoAbsoluto;

            $imagens['imagem-original'] = salvarImagem($_FILES['imagem-original'], $caminhoRelativo, $caminhoPasta);
            $imagens['imagem-plain'] = salvarImagem($_FILES['imagem-plain'], $caminhoRelativo, $caminhoPasta);

            mysqli_begin_transaction($con);

            $sqlImagem = mysqli_prepare(
                $con,
                "INSERT INTO tbl_imagem (
                    nome_original, 
                    caminho_original, 
                    nome_plain, 
                    caminho_plain, 
                    categoria)
                VALUES (?, ?, ?, ?, ?)"
            );
    
            mysqli_stmt_bind_param(
                $sqlImagem, 
                "sssss", 
                $imagens['imagem-original']['nome'], 
                $imagens['imagem-original']['caminho'], 
                $imagens['imagem-plain']['nome'], 
                $imagens['imagem-plain']['caminho'], 
                $categoriaTipoImagem
            );
    
            mysqli_stmt_execute($sqlImagem);
            $idImagem = mysqli_insert_id($con);

            $sqlTecnologia = mysqli_prepare(
                $con,
                "INSERT INTO tbl_tecnologia(
                    nome, 
                    id_imagem,
                    visibilidade_habilidades)
                VALUES (?, ?, ?)
            ");
                
            mysqli_stmt_bind_param(
                $sqlTecnologia, 
                "sss", 
                $nomeTecnologia, 
                $idImagem,
                $habilidade
            );

            mysqli_stmt_execute($sqlTecnologia);
    
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
        $mensagem = "";
    }
?>
