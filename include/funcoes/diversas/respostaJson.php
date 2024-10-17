<?php

function respostaJson($mensagem) {
    header('Content-Type: application/json', true);
    echo json_encode($mensagem);
    // die();
}

?>