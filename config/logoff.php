<?php
    include_once 'base.php';
    session_start();

    if(session_status() == PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
        header('location: ' . BASE_URL .'/login/');
        exit(); 
    } 
?>
