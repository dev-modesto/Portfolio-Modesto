<?php
function cIdentidadePerfil($con) {
    $sql = "SELECT * FROM tbl_identidade_perfil LIMIT 1";
    $consulta = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($consulta);
}

?>