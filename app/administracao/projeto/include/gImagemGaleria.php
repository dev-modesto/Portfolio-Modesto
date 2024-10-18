<?php
    include '../../../../config/base.php';
    include BASE_PATH . '/funcoes/funcaoImagem.php';
    include BASE_PATH . '/include/funcoes/diversas/respostaJson.php';

    if (isset($_FILES['imagem-projeto'])) {
        $idProjeto = $_POST['id-projeto'];
        $nomeTitulo = $_POST['nome-titulo'];
        $textoAlternativo = $_POST['texto-alt'];
        $categoria = 'projeto';
        $tipoImagem = $_POST['tipo-imagem-projeto'];

        $caminhoRelativo = "/assets/img/projetos/";
        $caminhoAbsoluto = BASE_PATH . "/assets/img/projetos/";
        $caminhoPasta = $caminhoAbsoluto;
        $imagemProjeto = salvarImagem($_FILES['imagem-projeto'], $caminhoRelativo, $caminhoPasta);

        try {

            if (is_string($imagemProjeto)) {
                $mensagem['mensagem'] = $imagemProjeto;
                throw new Exception(json_encode($mensagem));
            } 

            $nomeImagemOriginal = $imagemProjeto['nome'];
            $caminhoImagem = $imagemProjeto['caminho'];

            mysqli_begin_transaction($con);

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
                $nomeTitulo, 
                $nomeImagemOriginal,
                $caminhoImagem,
                $textoAlternativo,
                $categoria,
                $tipoImagem
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
            mysqli_commit($con);
            $mensagem = ['sucesso' => true, 'mensagem' => 'Imagem salva com sucesso!', 'id-projeto' => $idProjeto];
            respostaJson($mensagem);

        } catch (Exception $e) {
            mysqli_rollback($con);
            $mensagem = json_decode($e->getMessage(), true);
            $mensagem['id-projeto'] = $idProjeto;
            $respDecodificada = $mensagem;
            respostaJson($respDecodificada);

        } finally {
            mysqli_close($con);
        }

    } else {
        header('location: ../index.php');
    }

?>