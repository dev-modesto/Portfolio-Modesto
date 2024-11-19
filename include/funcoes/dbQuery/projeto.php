<?php

function cProjeto ($con, $idProjeto = null, $idCategoria = null, $tipoProjeto = null, $destaque = null, $visibilidade = null, $statusGeral = null) {
    $where = 'WHERE 1=1';
    $types = '';
    $vars = [];

    if (!empty($idProjeto)) {
        $where .= " AND p.id_projeto = ?";
        $types .= 'i';
        $vars[] = $idProjeto;
    }

    if (!empty($idCategoria)) {
        $where .= " AND p.id_categoria = ?";
        $types .= 'i';
        $vars[] = $idCategoria;
    }

    if (!empty($tipoProjeto)) {
        $where .= " AND p.tipo_projeto = ?";
        $types .= 's';
        $vars[] = $tipoProjeto;
    }

    if (!empty($destaque)) {
        $where .= " AND p.destaque = ?";
        $types .= 's';
        $vars[] = $destaque;
    }

    if (!empty($visibilidade)) {
        $where .= " AND p.visibilidade = ?";
        $types .= 's';
        $vars[] = $visibilidade;
    }

    if (!empty($statusGeral)) {
        $where .= " AND p.status_geral = ?";
        $types .= 's';
        $vars[] = $statusGeral;
    }

    $sql = mysqli_prepare(
        $con, 
        "SELECT p.*, c.nome as nome_categoria_projeto
        FROM tbl_projeto p 
        INNER JOIN tbl_categoria_projeto c ON p.id_categoria = c.id_categoria
        $where
        ORDER BY p.dt_desenvolvimento DESC
    ");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);

    return $consulta;

}

function cProjetoImagem ($con, $idProjeto, $categoria = null, $tipoImagem = []) {

    $where = " WHERE 1=1";
    $types = '';
    $vars = [];

    if ($idProjeto) {
        $where .= ' AND ip.id_projeto = ?';
        $types .= 'i';
        $vars[] = $idProjeto;
    }

    if ($categoria !== null) {
        $where .= ' AND i.categoria = ?';
        $types .= 's';
        $vars[] = $categoria;
    }

    if (!empty($tipoImagem)) {
        $placeholder = str_repeat('?,', count($tipoImagem) - 1) . '?';
        $where .= " AND i.tipo_imagem IN ($placeholder)";
        $types .= str_repeat('s', count($tipoImagem));
        $vars = array_merge($vars, $tipoImagem);
    }

    $sql = 
        "SELECT 
            ip.id_projeto,
            ip.id_imagem,
            i.nome_titulo,
            i.nome_original,
            i.caminho_original,
            i.texto_alt,
            i.categoria,
            i.tipo_imagem
        FROM tbl_imagem_projeto ip
        INNER JOIN tbl_imagem i
        ON ip.id_imagem = i.id_imagem
        $where
    ";

    $sqlPrepare = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($sqlPrepare, $types, ...$vars);
    mysqli_stmt_execute($sqlPrepare);
    $consulta = mysqli_stmt_get_result($sqlPrepare);
    return $consulta;
}

function cCategoriaProjeto($con, $idCategoria = null){
    $where = "WHERE 1=1";
    $types = '';
    $vars = [];

    if (!empty($idCategoria)) {
        $where .= " AND id_categoria = ?";
        $types .= 's';
        $vars[] = $idCategoria;
    }
    
    $sql = mysqli_prepare($con, "SELECT * FROM tbl_categoria_projeto $where order by nome asc");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;
};


?>