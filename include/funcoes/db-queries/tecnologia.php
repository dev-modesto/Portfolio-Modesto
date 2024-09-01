<?php

function cTecnologia ($con, $visibilidadeHabilidade, $categoria) {
    $sql = 
        mysqli_prepare(
        $con,
        "SELECT 
            t.nome,
            t.id_imagem,
            t.visibilidade_habilidades,
            i.nome_original,
            i.caminho_original,
            i.nome_plain,
            i.caminho_plain,
            i.categoria
        FROM tbl_tecnologia t
        INNER JOIN tbl_imagem i
        ON t.id_imagem = i.id_imagem
        WHERE t.visibilidade_habilidades = ? AND i.categoria = ?
    ");

    mysqli_stmt_bind_param($sql, 'ss', $visibilidadeHabilidade, $categoria);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}

function cTecnologiaProjeto ($con, $idProjeto) {
    $sql = 
        mysqli_prepare(
        $con,
        "SELECT 
            t.nome 
        FROM tbl_tecnologia_projeto tp
        INNER JOIN tbl_tecnologia t
        ON tp.id_tecnologia = t.id_tecnologia
        WHERE tp.id_projeto = ?
        ORDER BY tp.id_tecnologia DESC
    ");

    mysqli_stmt_bind_param($sql, 'i', $idProjeto);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}
 
?>