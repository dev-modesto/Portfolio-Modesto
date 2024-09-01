<?php

function cFormacaoCurso ($con) {
    $sql = 
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
        WHERE f.categoria_curso = 'Curso Livre'
    ";

    $consulta = mysqli_query($con, $sql);
    return $consulta;
}
 
function cFormacaoAcademico ($con) {
    $sql = 
        "SELECT 
            f.id_formacao, 
            f.nome, 
            f.instituicao, 
            f.categoria_curso,
            f.dt_inicio, 
            f.dt_fim, 
            f.id_imagem,
            i.caminho_original,
            f.link_certificado,
            f.status
        FROM tbl_formacao f 
        INNER JOIN tbl_imagem i
        ON f.id_imagem = i.id_imagem
        WHERE categoria_curso != 'Curso Livre' 
        ORDER BY id_formacao DESC
    ";

    $consulta = mysqli_query($con, $sql);
    return $consulta;
}

function cAreaFormacao ($con) {
    $sql = "SELECT * FROM tbl_area_formacao";
    $consulta = mysqli_query($con, $sql);
    return $consulta;
}

?>