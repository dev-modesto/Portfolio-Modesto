<?php

function cFormacaoAcademica ($con, $idAreaFormacao = null, $categoriaFormacao = []) {
    $where = 'WHERE 1=1';
    $types = '';
    $vars = [];

    if (!empty($idAreaFormacao)) {
        $where .= " AND f.id_area_formacao = ?";
        $types .= 'i';
        $vars[] = $idAreaFormacao;
    }

    if (!empty($categoriaFormacao)) {
        $placeholders = str_repeat('?,', count($categoriaFormacao) -1) . '?';
        $where .= " AND f.categoria_curso IN($placeholders)";
        $types .= str_repeat('s', count($categoriaFormacao));
        $vars = array_merge($vars, $categoriaFormacao);
    }

    $sql = mysqli_prepare(
        $con,
        "SELECT 
            f.id_formacao, 
            f.nome,
            f.id_area_formacao,
            f.instituicao, 
            f.categoria_curso,
            f.dt_inicio, 
            f.dt_fim, 
            f.id_imagem,
            f.total_horas,
            i.caminho_original,
            f.link_certificado,
            f.status
        FROM tbl_formacao f 
        INNER JOIN tbl_imagem i
        ON f.id_imagem = i.id_imagem
        INNER JOIN tbl_area_formacao a
        ON f.id_area_formacao = a.id_area_formacao
        $where
        ORDER BY dt_fim DESC
    ");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}
 
function cAreaFormacao ($con, $idAreaFormacao = null) {
    $where = 'WHERE 1=1';
    $types = '';
    $vars = [];

    if (!empty($idAreaFormacao)) {
        $where .= ' AND id_area_formacao = ?';
        $types .= 'i';
        $vars[] = $idAreaFormacao; 
    }

    $sql = mysqli_prepare($con, "SELECT * FROM tbl_area_formacao $where");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
}

?>