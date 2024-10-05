<?php

function mensagemInvalida() {
    if(isset($_GET['msgInvalida'])) {
        $msg = $_GET['msgInvalida'];

        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $msg .'                        
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';

    } else {
        echo '';
    }
}

?>