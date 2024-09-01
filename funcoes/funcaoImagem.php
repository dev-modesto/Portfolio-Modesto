<?php

    function salvarImagem($file, $caminhoRelativo, $caminhoPasta) {
        if (isset($file)) {
            $nomeImagem = $file['name'];
            $caminhoTemporario = $file['tmp_name'];
            $erroUpload = $file['error'];

            if ($erroUpload !== 0) {
                $mensagem = 'Ocorreu um erro com o upload da imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                die();
            }

            $caminhoPastaSalvar = $caminhoPasta . $nomeImagem;
            $caminhoRelativoImagem = $caminhoRelativo . $nomeImagem;
           
            if (!move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar)) {
                $mensagem = 'Ocorreu um erro ao salvar a imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                die();
            
            } else {
                move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar);
            }

            return [
                'nome' => $nomeImagem,
                'caminho' => $caminhoRelativoImagem
            ];
        }
        return null;
    }

    function excluirImagemPasta($caminhoImagemAbsoluto) {

        if(!file_exists($caminhoImagemAbsoluto)) {
            $mensagem = "O arquivo não foi localizado. Não foi possível prosseguir com a exclusão.";
            header('location: ../index.php?msgInvalida=' . $mensagem);
            die();
        }
        unlink($caminhoImagemAbsoluto);
        return true;
    }

?>