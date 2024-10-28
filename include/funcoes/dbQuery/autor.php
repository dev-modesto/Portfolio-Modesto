<?php
function cIdgabriel($con) {
    $sql = "SELECT id_autor FROM tbl_autor WHERE nome LIKE '%gabriel modesto%'";
    $consulta = mysqli_query($con, $sql);
    $resultado = mysqli_num_rows($consulta);

    if ($resultado == 0) {
        return false;
    }

    $array = mysqli_fetch_assoc($consulta);
    $id = $array['id_autor'];
    
    return $id;
}

function cAutorDiferenteGabriel($con) {
    $sqlAutor = "SELECT * FROM tbl_autor WHERE NOT nome LIKE '%gabriel modesto%' ORDER BY nome ASC";
    $consultaAutor = mysqli_query($con, $sqlAutor);
    $arrayAutores = mysqli_fetch_all($consultaAutor, MYSQLI_ASSOC);
    return $arrayAutores;
}

function cAutor($con, $idAutor = null) {

    $where = 'WHERE 1=1';
    $types = '';
    $vars = [];

    if (!empty($idAutor)) {
        $where .= ' AND id_autor = ?';
        $types .= 'i';
        $vars[] = $idAutor;
    }

    $sql = mysqli_prepare($con, "SELECT * FROM tbl_autor $where");

    if ($vars) {
        mysqli_stmt_bind_param($sql, $types, ...$vars);
    }

    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);
    return $consulta;

}

function cAutorProjeto($con, $idProjeto, $naoIncluirGabriel = null) {
    $where = " WHERE ap.id_projeto = ?";
    $types = 'i';
    $vars = [$idProjeto];

    if ($naoIncluirGabriel == 'sim') {
        $where .= " AND NOT a.nome LIKE '%gabriel modesto%'";
    }

    $sql = mysqli_prepare(
        $con, 
        "SELECT 
            ap.id_projeto, 
            ap.id_autor,
            a.nome,
            a.link_linkedin,
            a.link_github
        FROM tbl_autor_projeto ap
        INNER JOIN tbl_autor a
        ON ap.id_autor = a.id_autor
        $where
    ");
    
    mysqli_stmt_bind_param($sql, $types, ...$vars);
    mysqli_stmt_execute($sql);
    $consulta = mysqli_stmt_get_result($sql);

    return $consulta;
}

?>