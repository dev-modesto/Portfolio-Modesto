<?php

    function salvarImagem($file, $caminhoRelativo, $caminhoPasta) {
        if (isset($file)) {
            $nomeImagem = $file['name'];
            $caminhoTemporario = $file['tmp_name'];
            $erroUpload = $file['error'];

            if ($erroUpload !== 0) {
                $mensagem = 'Ocorreu um erro com o upload da imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                return false;
            }

            $caminhoPastaSalvar = $caminhoPasta . $nomeImagem;
            $caminhoRelativoImagem = $caminhoRelativo . $nomeImagem;
           
            if (!move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar)) {
                $mensagem = 'Ocorreu um erro ao salvar a imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                return false;
            
            } else {
                move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar);
            }

            return [
                'nome' => $nomeImagem,
                'caminho' => $caminhoRelativoImagem
            ];
        }
    }

    function excluirImagemPasta($caminhoImagemAbsoluto) {

        if(!file_exists($caminhoImagemAbsoluto)) {
            $mensagem = "O arquivo não foi localizado. Não foi possível prosseguir com a exclusão.";
            header('location: ../index.php?msgInvalida=' . $mensagem);
            return false;
        }
        unlink($caminhoImagemAbsoluto);
        return true;
    }

    function consultarImagens($con){
        $sql = "SELECT * FROM tbl_imagem";
        $consulta = mysqli_query($con, $sql);
        $array = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        return $array;
    }

?>