<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/portfolio-modesto/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
    // echo 'conexao estabelecida com sucesso!';

    header("Content-Type:text/html; charset=utf-8");
    mysqli_query($con,"SET NAMES 'utf8'");
    mysqli_query($con,"SET character_set_connection = utf8");
    mysqli_query($con,"SET character_set_client = utf8");
    mysqli_query($con,"SET character_set_results = utf8");

?>