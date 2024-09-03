<?php

function cProjeto ($con, $destaque) {
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
        WHERE destaque = ?
    ");

    mysqli_stmt_bind_param($sql, 's', $destaque);
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
            status
        FROM tbl_projeto  
        WHERE id_projeto = ?
    ");

    mysqli_stmt_bind_param($sql, 's', $idProjeto);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}

function cProjetoImagem ($con, $idProjeto, $categoria) {
    $sql = 
        mysqli_prepare(
        $con, 
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
        WHERE ip.id_projeto = ? AND i.categoria = ?
    ");

    mysqli_stmt_bind_param($sql, 'is', $idProjeto, $categoria);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}
 

?>