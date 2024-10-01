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

?>