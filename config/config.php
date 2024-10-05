<?php

    $caminhoProjetoLocal = "/portfolio-modesto";
    $protocolo = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $caminhoProjeto = isset($_SERVER['HTTPS']) ? '/' : $caminhoProjetoLocal;
    $url = $protocolo . $host . $caminhoProjeto;

    if ($host === 'localhost') {
        define('PASTA_CONFIG', $_SERVER['DOCUMENT_ROOT'] . $caminhoProjetoLocal . '/config');
        define('ARQUIVO_CONEXAO', PASTA_CONFIG . '/conexao.php');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . $caminhoProjetoLocal);
        
    } else {
        define('PASTA_CONFIG', $_SERVER['DOCUMENT_ROOT'] . '/config');
        define('ARQUIVO_CONEXAO', PASTA_CONFIG . '/conexao.php');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);
        $caminhoProjetoLocal = '';
    }
    
    define('BASE_URL', $url);
  
    define('FUNCAO_DATA', $_SERVER['DOCUMENT_ROOT'] . $caminhoProjetoLocal ."/funcoes/funcaoData.php");
    
?>