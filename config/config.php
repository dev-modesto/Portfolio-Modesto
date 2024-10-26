<?php

    $caminhoProjetoLocal = "/portfolio-modesto";
    $protocolo = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';

    if ($host === 'localhost') {
        define('PASTA_CONFIG', $_SERVER['DOCUMENT_ROOT'] . $caminhoProjetoLocal . '/config');
        define('ARQUIVO_CONEXAO', PASTA_CONFIG . '/conexao.php');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . $caminhoProjetoLocal);
        $caminhoProjeto = $caminhoProjetoLocal;
        
    } else {
        define('PASTA_CONFIG', $_SERVER['DOCUMENT_ROOT'] . '/config');
        define('ARQUIVO_CONEXAO', PASTA_CONFIG . '/conexao.php');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);
        $caminhoProjetoServer = '';
        $caminhoProjeto = $caminhoProjetoServer;
    }

    $url = $protocolo . $host . $caminhoProjeto;
    
    define('BASE_URL', $url);
    define('SEGURANCA', BASE_PATH . '/config/seguranca.php');
?>