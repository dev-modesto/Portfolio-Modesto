<?php

    function verificaTipoArquivoEnvio($camminhoArquivo) {
        $tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
        $tipoVerificado = mime_content_type($camminhoArquivo);

        if (!in_array($tipoVerificado, $tiposPermitidos)) {
            $mensagem = 'Tipo de arquivo inválido. Somente os tipos JPG, PNG e SVG são permitidos.';
            return $mensagem;
        }

        return true;
    }

    function salvarImagem($file, $caminhoRelativo, $caminhoPasta) {
        if (isset($file)) {
            $nomeImagemOriginal = $file['name'];
            $caminhoTemporario = $file['tmp_name'];
            $erroUpload = $file['error'];

            if ($erroUpload !== 0) {
                $mensagem = 'Ocorreu um erro com o upload da imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                return false;
            }

            if (($verificaTipo = verificaTipoArquivoEnvio($caminhoTemporario)) !== true) {
                return $verificaTipo;
            }

            $path = pathinfo($nomeImagemOriginal);
            $extensao = $path['extension'];
            date_default_timezone_set('America/Sao_Paulo');
            $data = new DateTime();
            $dataFormatada = date_format($data, 'dmyHms');
            
            $nomeUnico = uniqid() . '_' . $dataFormatada . '.' . $extensao;

            $caminhoPastaSalvar = $caminhoPasta . $nomeUnico;
            $caminhoRelativoImagem = $caminhoRelativo . $nomeUnico;
           
            if (!move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar)) {
                $mensagem = 'Ocorreu um erro ao salvar a imagem.';
                header('Location: ../index.php?msgInvalida=' . $mensagem);
                return false;
            
            } else {
                move_uploaded_file($caminhoTemporario, $caminhoPastaSalvar);
            }

            return [
                'nome' => $nomeUnico,
                'caminho' => $caminhoRelativoImagem
            ];
        }
    }

    function excluirImagemPasta($caminhoImagemAbsoluto) {

        if(!file_exists($caminhoImagemAbsoluto)) {
            $mensagem = "O arquivo não foi localizado. Não foi possível prosseguir com a exclusão.";
            return $mensagem;
        }
        unlink($caminhoImagemAbsoluto);
        return true;
    }

    function consultarImagens($con, $idImagem = null, $categoriaImagem1 = null, $categoriaImagem2 = null){
        
        $where = "";

        if (!empty($categoriaImagem1) || !empty($categoriaImagem2) || !empty($idImagem)) {
            $where .= "WHERE ";
            $condicao = [];

            if (!empty($idImagem)) {
                $condicao[] = "id_imagem = '$idImagem'";
            }
    
            if (!empty($categoriaImagem1)) {
                $condicao[] = "categoria = '$categoriaImagem1'";
            }

            if (!empty($categoriaImagem2)) {
                $condicao[] = "categoria = '$categoriaImagem2'";
            }
    
            $where .= implode(' OR ', $condicao);
        }
        
        $sql = "SELECT * FROM tbl_imagem $where";
        $consulta = mysqli_query($con, $sql);
        $array = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        return $array;
    }

?>