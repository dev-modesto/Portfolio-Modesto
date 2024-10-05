<?php
    include_once 'base.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['login'])) {
        $mensagem = 'Área restrita. Informe seu Login e Senha.';
        header('location: ' . BASE_URL . '/login/index.php?msgInvalida=' . $mensagem);
    }

?>