<?php

function cProjeto ($con, $destaque, $statusGeral) {
    $sql = 
        mysqli_prepare(
        $con, 
        "SELECT 
            id_projeto, 
            nome_projeto, 
            descricao, 
            descricao_tipo_projeto,
            tipo_projeto, 
            dt_desenvolvimento, 
            link_deploy,
            link_figma,
            link_repositorio
        FROM tbl_projeto  
        WHERE destaque = ? AND status_geral = ?
    ");

    mysqli_stmt_bind_param($sql, 'ss', $destaque, $statusGeral);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}

function cProjetoEspecifico ($con, $idProjeto) {
    $sql = 
        mysqli_prepare(
        $con, 
        "SELECT 
            id_projeto,
            nome_projeto, 
            descricao, 
            descricao_tipo_projeto,
            tipo_projeto, 
            dt_desenvolvimento, 
            link_deploy,
            link_figma,
            link_repositorio,
            destaque,
            status_geral,
            projeto_equipe,
            status
        FROM tbl_projeto  
        WHERE id_projeto = ?
    ");

    mysqli_stmt_bind_param($sql, 's', $idProjeto);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}

function cProjetoImagem ($con, $idProjeto, $categoria = null) {

    $sql = 
        "SELECT 
            ip.id_projeto,
            ip.id_imagem,
            i.nome_original,
            i.caminho_original,
            i.texto_alt,
            i.categoria
        FROM tbl_imagem_projeto ip
        INNER JOIN tbl_imagem i
        ON ip.id_imagem = i.id_imagem
        WHERE ip.id_projeto = ?
    ";

    if ($categoria !== null) {
        $sql .= 'AND i.categoria = ?';
    }

    $sqlPrepare = mysqli_prepare($con, $sql);

    if ($categoria !== null) {
        mysqli_stmt_bind_param($sqlPrepare, 'is', $idProjeto, $categoria);

    } else {
        mysqli_stmt_bind_param($sqlPrepare, 'i', $idProjeto);
    }
   
    mysqli_stmt_execute($sqlPrepare);
    $consulta = mysqli_stmt_get_result($sqlPrepare);
    return $consulta;
}


?>