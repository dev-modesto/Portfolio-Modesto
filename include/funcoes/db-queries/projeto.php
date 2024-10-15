<?php

function cProjeto ($con, $idProjeto = null, $idCategoria = null, $tipoProjeto = null, $destaque = null, $statusGeral = null) {
    $where = '';
    $types = '';
    $vars = [];

    if (!empty($idProjeto) || !empty($idCategoria) || !empty($tipoProjeto) || !empty($destaque) || !empty($statusGeral)) {
        $where .= " WHERE 1=1";
    }

    if (!empty($idProjeto)) {
        $where .= " AND prj.id_projeto = ?";
        $types .= 'i';
        $vars[] = $idProjeto;
    }

    if (!empty($idCategoria)) {
        $where .= " AND prj.id_categoria = ?";
        $types .= 'i';
        $vars[] = $idCategoria;
    }

    if (!empty($tipoProjeto)) {
        $where .= " AND prj.tipo_projeto = ?";
        $types .= 's';
        $vars[] = $tipoProjeto;
    }

    if (!empty($destaque)) {
        $where .= " AND prj.destaque = ?";
        $types .= 's';
        $vars[] = $destaque;
    }

    if (!empty($statusGeral)) {
        $where .= " AND prj.status_geral = ?";
        $types .= 's';
        $vars[] = $statusGeral;
    }

    $sql = 
     
      mysqli_prepare(
        $con,
        "SELECT 
            prj.id_projeto, 
            prj.nome_projeto, 
            prj.descricao, 
            prj.descricao_tipo_projeto,
            prj.tipo_projeto, 
            prj.dt_desenvolvimento, 
            prj.link_deploy,
            prj.link_figma,
            prj.link_repositorio
        FROM tbl_projeto prj
        $where
    ");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

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
            id_categoria,
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
            i.nome_titulo,
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

function cCategoriaProjeto($con){
    $sql = "SELECT * FROM tbl_categoria_projeto";
    $consulta = mysqli_query($con, $sql);
    $array = mysqli_fetch_all($consulta, MYSQLI_ASSOC); 
    return $array;
};


?>