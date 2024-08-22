<?php

    function processarImagem($file, $caminhoRelativo, $caminhoPasta) {
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
            move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar);

            return [
                'nome' => $nomeImagem,
                'caminho' => $caminhoRelativoImagem
            ];
        }
        return null;
    }

?>