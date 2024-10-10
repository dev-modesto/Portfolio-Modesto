<?php

function cTecnologia ($con, $idTecnologia = null, $visibilidadeHabilidade = null, $categoria = null) {

    $where = '';
    $types = '';
    $vars = [];

    if (!empty($idTecnologia)) {
        $where .= "AND t.id_tecnologia = ?";
        $types .= 's';
        $vars[] = $idTecnologia;
    }

    if (!empty($visibilidadeHabilidade)) {
        $where .= " AND t.visibilidade_habilidades = ?";
        $types .= 's';
        $vars[] = $visibilidadeHabilidade;
    }

    if (!empty($categoria)) {
        $where .= " AND I.categoria = ?";
        $types .= 's';
        $vars[] = $categoria;
    }

    $sql = 
        mysqli_prepare(
        $con,
        "SELECT 
            t.id_tecnologia,
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
        $where
    ");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

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

function cTecnologiaInfoImagem($con, $idTecnologia) {
            
    $sql = mysqli_prepare(
        $con, 
        "SELECT 
            t.id_tecnologia,
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
        WHERE t.id_tecnologia = ?
    ");

    mysqli_stmt_bind_param($sql, 'i', $idTecnologia);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}
 
?>