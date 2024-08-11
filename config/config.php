<?php
    $pastaProjeto = '/portfolio-modesto';

    // Pastas
    define('PASTA_CONFIG', $_SERVER['DOCUMENT_ROOT'] . $pastaProjeto . '/config');
    
    // Arquivos
    define('ARQUIVO_CONEXAO', PASTA_CONFIG . '/conexao.php');
    define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . $pastaProjeto);
    define('BASE_URL', $pastaProjeto);
    define('FUNCAO_DATA', $_SERVER['DOCUMENT_ROOT'] . "/portfolio-modesto/funcoes/funcaoData.php");

?>