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

    function cImagens($con, $idImagem = null, $categoriaImagem = []){
        
        $where = "WHERE 1=1";
        $types = '';
        $vars = [];

        if (!empty($idImagem)) {
            $where .= " AND id_imagem = ?";
            $types .= 'i';
            $vars[] = $idImagem;
        }

        if (!empty($categoriaImagem)) {
            $placeholders = str_repeat('?,', count($categoriaImagem) -1) . '?';
            $where .= " AND categoria IN($placeholders)";
            $types .= str_repeat('s', count($categoriaImagem));
            $vars = array_merge($vars, $categoriaImagem);
        }

        $sql = mysqli_prepare($con, "SELECT * FROM tbl_imagem $where order by nome_titulo asc");

        if ($vars) {
            mysqli_stmt_bind_param($sql, $types, ...$vars);
        }

        mysqli_stmt_execute($sql);
        $consulta = mysqli_stmt_get_result($sql);

        return $consulta;
    }